<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Certification;
use App\Models\Domain;
use App\Models\Topic;
use Illuminate\Http\Request;

class QuestionAdminController extends Controller
{
    public function index()
    {
        $questions = Question::with('certification','domain','topic')->latest()->paginate(25);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $certs = Certification::orderBy('name')->get();
        $domains = Domain::with('certification')->orderBy('name')->get();
        $topics = Topic::with('domain')->orderBy('name')->get();
        return view('admin.questions.create', compact('certs','domains','topics'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'certification_id' => ['required','exists:certifications,id'],
            'domain_id' => ['required','exists:domains,id'],
            'topic_id' => ['required','exists:topics,id'],
            'question_text' => ['required','string'],
            'explanation' => ['nullable','string'],
            'answers' => ['required','array','min:2'],
            'answers.*.text' => ['required','string'],
            'answers.*.is_correct' => ['nullable','boolean'],
        ]);

        $q = Question::create([
            'certification_id'=>$data['certification_id'],
            'domain_id'=>$data['domain_id'],
            'topic_id'=>$data['topic_id'],
            'question_type'=>'mcq',
            'question_text'=>$data['question_text'],
            'explanation'=>$data['explanation'] ?? null,
        ]);

        foreach ($data['answers'] as $ans) {
            Answer::create([
                'question_id'=>$q->id,
                'answer_text'=>$ans['text'],
                'is_correct'=>!empty($ans['is_correct']),
            ]);
        }

        return redirect()->route('admin.questions.index')->with('status','Question created.');
    }

    public function edit(Question $question)
    {
        $question->load('answers','certification','domain','topic');
        $certs = Certification::orderBy('name')->get();
        $domains = Domain::with('certification')->orderBy('name')->get();
        $topics = Topic::with('domain')->orderBy('name')->get();
        return view('admin.questions.edit', compact('question','certs','domains','topics'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'certification_id' => ['required','exists:certifications,id'],
            'domain_id' => ['required','exists:domains,id'],
            'topic_id' => ['required','exists:topics,id'],
            'question_text' => ['required','string'],
            'explanation' => ['nullable','string'],
            'answers' => ['required','array','min:2'],
            'answers.*.id' => ['nullable','integer'],
            'answers.*.text' => ['required','string'],
            'answers.*.is_correct' => ['nullable','boolean'],
        ]);

        $question->update([
            'certification_id'=>$data['certification_id'],
            'domain_id'=>$data['domain_id'],
            'topic_id'=>$data['topic_id'],
            'question_text'=>$data['question_text'],
            'explanation'=>$data['explanation'] ?? null,
        ]);

        // sync answers (simple approach: delete + recreate)
        $question->answers()->delete();
        foreach ($data['answers'] as $ans) {
            Answer::create([
                'question_id'=>$question->id,
                'answer_text'=>$ans['text'],
                'is_correct'=>!empty($ans['is_correct']),
            ]);
        }

        return back()->with('status','Question updated.');
    }

    public function destroy(Question $question)
    {
        $question->answers()->delete();
        $question->delete();
        return back()->with('status','Question deleted.');
    }
}
