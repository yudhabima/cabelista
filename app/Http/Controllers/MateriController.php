<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    /**
     * INDEX → menampilkan semua data
     */
    public function index()
{
    $materis = Materi::all();
    return view('admin.materi.index', compact('materis'));
}

    /**
     * CREATE → form tambah
     */
    public function create()
    {
        return view('admin.materi.create');
    }

    /**
     * STORE → simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'thumbnail' => 'required|image',
            'deskripsi' => 'required'
        ]);

        // Upload gambar
        $file = $request->file('thumbnail');
        $file->storeAs('public/materi', $file->hashName());

        Materi::create([
            'judul' => $request->judul,
            'thumbnail' => $file->hashName(),
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('materi.index')
            ->with('success','Materi berhasil ditambahkan');
    }

    /**
     * SHOW → preview
     */
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.materi.show', compact('materi'));
    }

    /**
     * EDIT → form edit
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.materi.edit', compact('materi'));
    }

    /**
     * UPDATE → update data
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('materi.index')
            ->with('success','Materi berhasil diupdate');
    }

    /**
     * DESTROY → hapus
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()
            ->route('materi.index')
            ->with('success','Materi berhasil dihapus');
    }
}
