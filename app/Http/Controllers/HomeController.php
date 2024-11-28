<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Galery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function galeri()
    {
        // Ambil semua galeri yang memiliki foto dan post yang published
        $galeris = Galery::whereHas('post', function($query) {
            $query->where('status', 'published')
                  ->where('kategori_id', 3); // Kategori Galeri
        })
        ->with(['post', 'fotos'])
        ->latest()
        ->get();

        return view('galeri', compact('galeris'));
    }

    public function informasi()
    {
        $informasi = Post::where('kategori_id', 1)
            ->where('status', 'published')
            ->with(['galery.fotos'])
            ->latest()
            ->paginate(10);

        return view('informasi', compact('informasi'));
    }

    public function agenda()
    {
        $agendas = Post::where('kategori_id', 2)
            ->where('status', 'published')
            ->latest()
            ->paginate(10);

        return view('agenda', compact('agendas'));
    }
} 