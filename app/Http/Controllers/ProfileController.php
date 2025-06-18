<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan halaman profil penjual
    public function penjual()
    {
        $user = Auth::user();
        $profil = $user->profil;
        return view('profile.penjual', compact('user', 'profil'));
    }

    // Menampilkan halaman profil pembeli
    public function pembeli()
    {
        $user = Auth::user();
        $profil = $user->profil;
        return view('profile.pembeli', compact('user', 'profil'));
    }

    // Memperbarui data profil
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // Update data user (name & email)
        $user->fill($request->only('name', 'email'));
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        // Update data profil (nama lengkap, alamat, foto)
        $dataProfil = $request->only('nama_lengkap', 'alamat', 'no_hp');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->profil && $user->profil->foto) {
                Storage::disk('public')->delete($user->profil->foto);
            }

            // Simpan foto baru
            $dataProfil['foto'] = $request->file('foto')->store('foto-profil', 'public');
        }

        // Simpan atau update profil
        $user->profil()->updateOrCreate(['users_id' => $user->id], $dataProfil);

        // Redirect ke halaman profil sesuai role
        return redirect()->route(
            $user->role === 'seller' ? 'profile.penjual' : 'profile.pembeli'
        )->with('status', 'Profil berhasil diperbarui.');
    }

    // Menghapus akun pengguna
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        // Hapus user & profil
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
