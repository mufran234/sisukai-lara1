<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Answer;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            // ... (your existing question data)
        ];

        foreach ($samples as $cert => $domains) {
            foreach ($domains as $topicName => $questions) {
                $topic = Topic::where('name', $topicName)->first();
                if ($topic) {
                    foreach ($questions as $q) {
                        $question = Question::create([
                            'certification_id' => $topic->domain->certification_id,
                            'domain_id' => $topic->domain_id,
                            'topic_id' => $topic->id,
                            'type' => 'mcq_single',
                            'question_text' => $q[0],
                            'explanation' => $q[3] ?? $q[1][$q[2]] . ' is correct.',
                        ]);

                        // Create answers for each option
                        foreach ($q[1] as $index => $answerText) {
                            Answer::create([
                                'question_id' => $question->id,
                                'answer_text' => $answerText,
                                'is_correct' => $index === $q[2],
                            ]);
                        }
                    }
                }
            }
        }
    }
}