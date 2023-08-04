<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        Level::create($request->all());
        return redirect()->route('levels.index')->with('success', 'Data level berhasil ditambahkan.');
    }

    public function show($id)
    {
        $level = Level::find($id);
        return view('levels.show', compact('level'));
    }

    public function edit($id)
    {
        $level = Level::find($id);
        return view('levels.edit', compact('level'));
    }

    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        $level->update($request->all());
        return redirect()->route('levels.index')->with('success', 'Data level berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $level = Level::find($id);
        $level->delete();
        return redirect()->route('levels.index')->with('success', 'Data level berhasil dihapus.');
    }
}
