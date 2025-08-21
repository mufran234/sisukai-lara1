<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Certification, Topic, Question};
use Illuminate\Http\Request;

class QuestionImportController extends Controller
{
    public function showForm()
    {
        $certs = Certification::orderBy('name')->get();
        return view('admin.questions.import', compact('certs'));
    }

    public function import(Request $request)
    {
        $data = $request->validate([
            'certification_id' => 'required|exists:certifications,id',
            'topic_name' => 'required|string|max:200',
            'file' => 'required|file|mimes:json,csv,txt',
        ]);

        $cert = Certification::findOrFail($data['certification_id']);

        // Ensure Topic
        $topic = Topic::firstOrCreate(
            ['name' => $data['topic_name'], 'domain_id' => $cert->domains()->first()->id ?? null],
            ['domain_id' => $cert->domains()->first()->id ?? null]
        );

        $count = 0;

        if ($request->file('file')->getClientOriginalExtension() === 'json') {
            $json = json_decode(file_get_contents($request->file('file')->getRealPath()), true);
            foreach ($json as $row) {
                Question::create([
                    'topic_id' => $topic->id,
                    'question' => $row['question'],
                    'options' => json_encode($row['options']),
                    'correct_answer' => $row['correct_answer'],
                    'explanation' => $row['explanation'] ?? null,
                ]);
                $count++;
            }
        } else {
            // CSV: question, option1|option2|..., correct_answer, explanation
            $fh = fopen($request->file('file')->getRealPath(), 'r');
            while (($row = fgetcsv($fh)) !== false) {
                if (count($row) < 3) { continue; }
                [$q, $opts, $correct, $exp] = [$row[0], $row[1], $row[2], $row[3] ?? null];
                Question::create([
                    'topic_id' => $topic->id,
                    'question' => $q,
                    'options' => json_encode(explode('|', $opts)),
                    'correct_answer' => $correct,
                    'explanation' => $exp,
                ]);
                $count++;
            }
            fclose($fh);
        }

        return back()->with('status', "Imported {$count} questions into topic '{$topic->name}'.");
    }
}
