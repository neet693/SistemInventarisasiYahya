<?php

namespace App\Http\Controllers;

use App\Models\JenisRuangan;
use Illuminate\Http\Request;

class JenisRuanganController extends Controller
{
    public function index()
    {
        $jenisRuangans = JenisRuangan::all();
        return view('jenis_ruangans.index', compact('jenisRuangans'));
    }

    public function create()
    {
        return view('jenis_ruangans.create');
    }

    public function store(Request $request)
    {
        JenisRuangan::create($request->all());
        return redirect()->route('jenis_ruangans.index')->with('success', 'Data jenis ruangan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jenisRuangan = JenisRuangan::find($id);
        return view('jenis_ruangans.show', compact('jenisRuangan'));
    }

    public function edit($id)
    {
        $jenisRuangan = JenisRuangan::find($id);
        return view('jenis_ruangans.edit', compact('jenisRuangan'));
    }

    public function update(Request $request, $id)
    {
        $jenisRuangan = JenisRuangan::find($id);
        $jenisRuangan->update($request->all());
        return redirect()->route('jenis_ruangans.index')->with('success', 'Data jenis ruangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisRuangan = JenisRuangan::find($id);
        $jenisRuangan->delete();
        return redirect()->route('jenis_ruangans.index')->with('success', 'Data jenis ruangan berhasil dihapus.');
    }
}
