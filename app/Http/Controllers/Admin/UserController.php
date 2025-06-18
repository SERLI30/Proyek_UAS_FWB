<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
{
    $users = User::whereIn('role', ['customer', 'seller'])->get();
    return view('admin.user.index', compact('users'));
}

public function store(Request $request)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'role'  => 'required|in:customer,seller',
        'password' => 'required|string|min:6|confirmed'
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'role'     => $request->role,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambahkan');
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role'  => 'required|in:customer,seller',
    ]);

    $user->update([
        'name'  => $request->name,
        'email' => $request->email,
        'role'  => $request->role,
    ]);

    return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil diperbarui');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil dihapus');
}
}