<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Post::where('kategori_id', 2)
            ->with(['galery.fotos', 'petugas'])
            ->latest()
            ->paginate(10);
            
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'isi' => 'required',
        ]);

        $post = Post::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => 2, // Kategori Agenda
            'status' => 'draft',
            'petugas_id' => session('petugas_id'),
            'tanggal' => Carbon::parse($request->tanggal)->format('Y-m-d')
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dibuat');
    }

    public function edit($id)
    {
        $agenda = Post::findOrFail($id);
        // Convert string date to Carbon instance
        if ($agenda->tanggal) {
            $agenda->tanggal = Carbon::parse($agenda->tanggal);
        }
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi' => 'required',
            'status' => 'required|in:draft,published'
        ]);

        $post = Post::findOrFail($id);
        
        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
            'tanggal' => Carbon::parse($request->tanggal)->format('Y-m-d')
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diupdate');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }
} 