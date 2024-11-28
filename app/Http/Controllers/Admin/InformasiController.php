<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Post::where('kategori_id', 1)
            ->with('petugas')
            ->latest()
            ->paginate(10);
            
        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => 1, // Kategori Informasi
            'status' => 'draft',
            'petugas_id' => session('petugas_id')
        ]);

        if ($request->hasFile('gambar')) {
            $galery = $post->galery()->create([
                'position' => 0,
                'status' => 1
            ]);

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');

            $galery->fotos()->create([
                'judul' => $post->judul,
                'file' => $path
            ]);
        }

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dibuat');
    }

    public function edit($id)
    {
        $informasi = Post::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $post = Post::findOrFail($id);
        
        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status
        ]);

        if ($request->hasFile('gambar')) {
            if (!$post->galery) {
                $galery = $post->galery()->create([
                    'position' => 0,
                    'status' => 1
                ]);
            } else {
                $galery = $post->galery;
                if ($galery->fotos->isNotEmpty()) {
                    Storage::disk('public')->delete($galery->fotos->first()->file);
                    $galery->fotos()->delete();
                }
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');

            $galery->fotos()->create([
                'judul' => $post->judul,
                'file' => $path
            ]);
        }

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Hapus post (akan otomatis menghapus galeri dan foto karena ON DELETE CASCADE)
        $post->delete();
        
        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dihapus');
    }
} 