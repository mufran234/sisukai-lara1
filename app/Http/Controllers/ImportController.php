<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;

class ImportController extends Controller
{
    public function showForm(Request $request)
    {
        $certifications = Certification::with('domains.topics')->where('is_active', true)->get();
        return view('admin.import', compact('certifications'));
    }

    public function importJson(Request $request)
    {
        $data = $request->validate([
            'certification_id' => ['required','exists:certifications,id'],
            'topic_id' => ['required','exists:topics,id'],
            'json' => ['required','string'],
        ]);

        $payload = json_decode($data['json'], true);
        if (!is_array($payload)) {
            return back()->with('error', 'Invalid JSON array.');
        }

        $topic = Topic::where('id', $data['topic_id'])
            ->whereHas('domain', fn($q) => $q->where('certification_id', $data['certification_id']))
            ->firstOrFail();

        $created = 0;
        foreach ($payload as $item) {
            // Minimal validation for MVP
            if (!isset($item['question_text'], $item['options'], $item['correct_index'])) continue;
            $q = Question::create([
                'certification_id' => $data['certification_id'],
                'domain_id' => $topic->domain_id,
                'topic_id' => $topic->id,
                'question_type' => 'mcq',
                'question_text' => $item['question_text'],
                'explanation' => $item['explanation'] ?? null,
            ]);
            foreach ($item['options'] as $i => $opt) {
                Answer::create([
                    'question_id' => $q->id,
                    'answer_text' => $opt,
                    'is_correct' => ($i === (int)$item['correct_index']),
                ]);
            }
            $created++;
        }

        return back()->with('status', "Imported {$created} questions into {$topic->name}.");
    }
}
