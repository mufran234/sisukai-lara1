<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CertificationAdminController extends Controller
{
    public function index()
    {
        $certs = Certification::latest()->paginate(15);
        return view('admin.certifications.index', compact('certs'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','max:120'],
            'slug' => ['nullable','max:120','alpha_dash', Rule::unique('certifications','slug')],
            'description' => ['nullable','max:2000'],
            'duration' => ['nullable','integer','min:1'],
            'is_active' => ['boolean'],
        ]);
        if (empty($data['slug'])) $data['slug'] = Str::slug($data['name']);
        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('status','Certification created.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'name' => ['required','max:120'],
            'slug' => ['required','max:120','alpha_dash', Rule::unique('certifications','slug')->ignore($certification->id)],
            'description' => ['nullable','max:2000'],
            'duration' => ['nullable','integer','min:1'],
            'is_active' => ['boolean'],
        ]);
        $certification->update($data);
        return back()->with('status','Certification updated.');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();
        return back()->with('status','Certification deleted.');
    }
}
