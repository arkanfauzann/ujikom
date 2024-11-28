<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    public function index()
    {
        $galeris = Galery::with(['post', 'fotos'])
            ->whereHas('post', function($query) {
                $query->where('kategori_id', 3);
            })
            ->latest()
            ->get();

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        $posts = Post::where('kategori_id', 3)->get();
        return view('admin.galeri.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'nullable|integer',
            'status' => 'required|in:0,1'
        ]);

        Galery::create([
            'post_id' => $request->post_id,
            'position' => $request->position ?? 0,
            'status' => $request->status
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dibuat');
    }

    public function edit($id)
    {
        $galeri = Galery::findOrFail($id);
        $posts = Post::where('kategori_id', 3)->get();
        return view('admin.galeri.edit', compact('galeri', 'posts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'nullable|integer',
            'status' => 'required|in:0,1'
        ]);

        $galeri = Galery::findOrFail($id);
        $galeri->update([
            'post_id' => $request->post_id,
            'position' => $request->position ?? 0,
            'status' => $request->status
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            $galeri = Galery::findOrFail($id);
            
            // Hapus semua foto dalam galeri
            foreach($galeri->fotos as $foto) {
                // Hapus file fisik
                Storage::disk('public')->delete($foto->file);
            }
            
            // Hapus galeri (foto akan terhapus otomatis karena ON DELETE CASCADE)
            $galeri->delete();
            
            return redirect()->route('admin.galeri.index')
                ->with('success', 'Galeri dan semua fotonya berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus galeri: ' . $e->getMessage());
        }
    }
} 