<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificationController extends Controller
{
    public function index()
    {
        $certs = Certification::latest()->paginate(20);
        return view('admin.certifications.index', compact('certs'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:certifications,slug',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        Certification::create($data);

        return redirect()->route('admin.certifications.index')->with('status', 'Certification created.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:certifications,slug,'.$certification->id,
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'is_active' => 'boolean'
        ]);
        $certification->update($data);

        return redirect()->route('admin.certifications.index')->with('status', 'Certification updated.');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();
        return back()->with('status', 'Certification deleted.');
    }
}
