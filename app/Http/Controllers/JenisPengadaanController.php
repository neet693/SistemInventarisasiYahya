<?php

namespace App\Http\Controllers;

use App\Models\JenisPengadaan;
use Illuminate\Http\Request;

class JenisPengadaanController extends Controller
{
    public function index()
    {
        $jenisPengadaans = JenisPengadaan::all();
        return view('jenis_pengadaans.index', compact('jenisPengadaans'));
    }

    public function create()
    {
        return view('jenis_pengadaans.create');
    }

    public function store(Request $request)
    {
        JenisPengadaan::create($request->all());
        return redirect()->route('jenis_pengadaans.index')->with('success', 'Data jenis pengadaan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jenisPengadaan = JenisPengadaan::find($id);
        return view('jenis_pengadaans.show', compact('jenisPengadaan'));
    }

    public function edit($id)
    {
        $jenisPengadaan = JenisPengadaan::find($id);
        return view('jenis_pengadaans.edit', compact('jenisPengadaan'));
    }

    public function update(Request $request, $id)
    {
        $jenisPengadaan = JenisPengadaan::find($id);
        $jenisPengadaan->update($request->all());
        return redirect()->route('jenis_pengadaans.index')->with('success', 'Data jenis pengadaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisPengadaan = JenisPengadaan::find($id);
        $jenisPengadaan->delete();
        return redirect()->route('jenis_pengadaans.index')->with('success', 'Data jenis pengadaan berhasil dihapus.');
    }
}
