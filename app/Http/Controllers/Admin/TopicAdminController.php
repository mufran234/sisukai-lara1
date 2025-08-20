<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Domain;
use App\Models\Certification;
use Illuminate\Http\Request;

class TopicAdminController extends Controller
{
    public function index()
    {
        $topics = Topic::with('domain.certification')->latest()->paginate(25);
        return view('admin.topics.index', compact('topics'));
    }

    public function create()
    {
        $domains = Domain::with('certification')->orderBy('name')->get();
        return view('admin.topics.create', compact('domains'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'domain_id' => ['required','exists:domains,id'],
            'name' => ['required','max:120'],
        ]);
        Topic::create($data);
        return redirect()->route('admin.topics.index')->with('status','Topic created.');
    }

    public function edit(Topic $topic)
    {
        $domains = Domain::with('certification')->orderBy('name')->get();
        return view('admin.topics.edit', compact('topic','domains'));
    }

    public function update(Request $request, Topic $topic)
    {
        $data = $request->validate([
            'domain_id' => ['required','exists:domains,id'],
            'name' => ['required','max:120'],
        ]);
        $topic->update($data);
        return back()->with('status','Topic updated.');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return back()->with('status','Topic deleted.');
    }
}
