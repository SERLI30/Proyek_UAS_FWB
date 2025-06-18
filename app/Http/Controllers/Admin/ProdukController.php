<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori', 'seller')->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $sellers = User::where('role', 'seller')->get();
        return view('admin.produk.create', compact('kategoris', 'sellers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'seller_id' => 'required|exists:users,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'stok', 'deskripsi', 'kategori_id', 'seller_id']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
