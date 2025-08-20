<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\Domain;
use App\Models\Topic;
use App\Models\Question;

class ImportController extends Controller
{
    /**
     * Show the import form
     */
    public function show()
    {
        return view('admin.import');
    }

    /**
     * Handle JSON upload and import
     */
    public function import(Request $request)
    {
        $request->validate([
            'certification_id' => 'required|exists:certifications,id',
            'json_file' => 'required|file|mimes:json,txt'
        ]);

        $certification = Certification::findOrFail($request->certification_id);
        $domainId = $request->domain_id ?: null;
        $topicId = $request->topic_id ?: null;

        // Read file
        $json = file_get_contents($request->file('json_file')->getRealPath());
        $data = json_decode($json, true);

        if (!$data || !is_array($data)) {
            return back()->with('error', 'Invalid JSON format.');
        }

        $count = 0;
        foreach ($data as $item) {
            if (!isset($item['question_text'], $item['options'], $item['correct_index'])) {
                continue; // skip invalid records
            }

            Question::create([
                'certification_id' => $certification->id,
                'domain_id' => $domainId,
                'topic_id' => $topicId,
                'question_text' => $item['question_text'],
                'options' => json_encode($item['options']),
                'correct_index' => $item['correct_index'],
                'explanation' => $item['explanation'] ?? null,
            ]);

            $count++;
        }

        return redirect()->route('admin.import.show')
            ->with('success', "Successfully imported {$count} questions.");
    }
}
