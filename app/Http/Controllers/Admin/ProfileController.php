<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->paginate(10);
        return view('admin.profile.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        Profile::create($request->all());
        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil ditambahkan');
    }

    public function edit(Profile $profile)
    {
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        $profile->update($request->all());
        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diupdate');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil dihapus');
    }
} 