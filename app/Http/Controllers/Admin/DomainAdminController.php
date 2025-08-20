<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Certification;
use Illuminate\Http\Request;

class DomainAdminController extends Controller
{
    public function index()
    {
        $domains = Domain::with('certification')->latest()->paginate(20);
        $certs = Certification::orderBy('name')->get();
        return view('admin.domains.index', compact('domains','certs'));
    }

    public function create()
    {
        $certs = Certification::orderBy('name')->get();
        return view('admin.domains.create', compact('certs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'certification_id' => ['required','exists:certifications,id'],
            'name' => ['required','max:120'],
            'weight' => ['nullable','integer','between:0,100'],
        ]);
        Domain::create($data);
        return redirect()->route('admin.domains.index')->with('status','Domain created.');
    }

    public function edit(Domain $domain)
    {
        $certs = Certification::orderBy('name')->get();
        return view('admin.domains.edit', compact('domain','certs'));
    }

    public function update(Request $request, Domain $domain)
    {
        $data = $request->validate([
            'certification_id' => ['required','exists:certifications,id'],
            'name' => ['required','max:120'],
            'weight' => ['nullable','integer','between:0,100'],
        ]);
        $domain->update($data);
        return back()->with('status','Domain updated.');
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();
        return back()->with('status','Domain deleted.');
    }
}
