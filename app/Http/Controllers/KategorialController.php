<?php

namespace App\Http\Controllers;

use App\Models\Kategorial;
use Illuminate\Http\Request;

class KategorialController extends Controller
{
    public function index()
    {
        $kategorials = Kategorial::all();
        return view('kategorials.index', compact('kategorials'));
    }

    public function create()
    {
        return view('kategorials.create');
    }

    public function store(Request $request)
    {
        Kategorial::create($request->all());
        return redirect()->route('kategorials.index')->with('success', 'Kategorial berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategorial = Kategorial::find($id);
        return view('kategorials.show', compact('kategorial'));
    }

    public function edit($id)
    {
        $kategorial = Kategorial::find($id);
        return view('kategorials.edit', compact('kategorial'));
    }

    public function update(Request $request, $id)
    {
        $kategorial = Kategorial::find($id);
        $kategorial->update($request->all());
        return redirect()->route('kategorials.index')->with('success', 'Kategorial berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategorial = Kategorial::find($id);
        $kategorial->delete();
        return redirect()->route('kategorials.index')->with('success', 'Kategorial berhasil dihapus.');
    }
}
