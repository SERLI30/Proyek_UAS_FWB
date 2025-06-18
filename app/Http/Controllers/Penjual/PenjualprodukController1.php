<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class PenjualProdukController1 extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        // FIX: Tambahkan eager loading 'kategori'
        $produks = Produk::with('kategori')->where('seller_id', Auth::id())->get();
        return view('penjual.produkPenjual.index', compact('produks'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        $kategoris = Kategori::all();
        return view('penjual.produkPenjual.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'stok', 'kategori_id', 'deskripsi']);
        $data['seller_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('penjual.produkPenjual.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        $produk = Produk::where('id', $id)->where('seller_id', Auth::id())->firstOrFail();
        $kategoris = Kategori::all();
        return view('penjual.produkPenjual.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        $produk = Produk::where('id', $id)->where('seller_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'stok', 'deskripsi', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('penjual.produkPenjual.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        $produk = Produk::where('id', $id)->where('seller_id', Auth::id())->firstOrFail();
        $produk->delete();

        return redirect()->route('penjual.produkPenjual.index')->with('success', 'Produk berhasil dihapus');
    }

    public function transaksiMasuk()
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        $sellerId = Auth::id();

        $transaksis = Transaksi::whereHas('produk', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->with([
            'produk' => function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            },
            'customer'
        ])->get();

        return view('penjual.transaksi.masuk', compact('transaksis'));
    }
}
