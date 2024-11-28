<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Galery;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $galeris = Galery::with(['post', 'fotos'])->get();
        $fotos = Foto::with('galery.post')->latest()->paginate(10);
        
        return view('admin.foto.index', compact('fotos', 'galeris'));
    }

    public function create()
    {
        return view('admin.foto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat post baru dengan status draft
        $post = Post::create([
            'judul' => $request->judul,
            'kategori_id' => 3, // Kategori Galeri
            'isi' => $request->judul, // Gunakan judul sebagai isi default
            'status' => 'draft',
            'petugas_id' => session('petugas_id')
        ]);

        // Buat galeri baru
        $galery = $post->galery()->create([
            'position' => 0,
            'status' => 1
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');

            // Buat foto baru
            $foto = $galery->fotos()->create([
                'judul' => $request->judul,
                'file' => $path
            ]);

            return redirect()->route('admin.posts.edit', $post->id)
                ->with('success', 'Foto berhasil diupload. Silakan edit detail post.');
        }

        return back()->with('error', 'Gagal mengupload file');
    }

    public function edit($id)
    {
        $foto = Foto::with('galery.post')->findOrFail($id);
        return view('admin.foto.edit', compact('foto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = Foto::findOrFail($id);
        $foto->judul = $request->judul;

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($foto->file);
            
            // Upload file baru
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            
            $foto->file = $path;
        }

        $foto->save();

        return redirect()->route('admin.galeri.edit', $foto->galery_id)
            ->with('success', 'Foto berhasil diupdate');
    }

    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        
        // Hapus file dari storage
        Storage::disk('public')->delete($foto->file);
        
        $foto->delete();
        return redirect()->route('admin.foto.index')->with('success', 'Foto berhasil dihapus');
    }
}