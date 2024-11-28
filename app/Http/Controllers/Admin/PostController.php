<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('petugas')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $kategoris = [
            ['id' => 1, 'nama' => 'Informasi'],
            ['id' => 2, 'nama' => 'Agenda'],
            ['id' => 3, 'nama' => 'Galeri']
        ];
        
        return view('admin.posts.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'status' => 'required'
        ]);

        $post = Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => Session::get('petugas_id'),
            'status' => $request->status
        ]);

        if ($request->kategori_id == 3) {
            $galery = $post->galery()->create([
                'position' => 0,
                'status' => 1
            ]);

            return redirect()->route('admin.foto.create', ['galery_id' => $galery->id])
                ->with('success', 'Post galeri berhasil dibuat. Silakan upload foto.');
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil ditambahkan');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $kategoris = [
            ['id' => 1, 'nama' => 'Informasi'],
            ['id' => 2, 'nama' => 'Agenda'],
            ['id' => 3, 'nama' => 'Galeri']
        ];
        
        return view('admin.posts.edit', compact('post', 'kategoris'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required',
            'status' => 'required'
        ]);

        $post->update($request->all());

        if ($request->kategori_id == 3 && !$post->galery) {
            $post->galery()->create([
                'position' => 0,
                'status' => 1
            ]);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil diupdate');
    }

    public function destroy(Post $post)
    {
        if ($post->galery) {
            $post->galery->delete();
        }
        
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dihapus');
    }
} 