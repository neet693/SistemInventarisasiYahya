<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class SettingUser extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('settings.index', compact('users'));
    }

    public function edit(User $user)
    {
        $units = Unit::all();
        $levels = Level::all();
        return view('settings.edit', compact('user', 'units', 'levels'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('settings.index')->with('success', 'Data level berhasil diperbarui.');
    }
}
