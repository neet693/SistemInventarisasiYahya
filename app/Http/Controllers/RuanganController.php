<?php

namespace App\Http\Controllers;

use App\Models\JenisRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('ruangans.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangans.create');
    }

    public function store(Request $request)
    {
        Ruangan::create($request->all());
        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show($kode_ruangan)
    {
        $ruangan = Ruangan::find($kode_ruangan);
        return view('ruangans.show', compact('ruangan'));
    }

    public function edit($kode_ruangan)
    {
        $ruangan = Ruangan::find($kode_ruangan);
        // $jenisRuangans = JenisRuangan::all();
        return view('ruangans.edit', compact('ruangan',));
    }

    public function update(Request $request, $kode_ruangan)
    {
        $ruangan = Ruangan::find($kode_ruangan);
        $ruangan->update($request->all());
        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy($kode_ruangan)
    {
        $ruangan = Ruangan::find($kode_ruangan);
        $ruangan->delete();
        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
