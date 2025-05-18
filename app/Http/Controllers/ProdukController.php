<?php

namespace App\Http\Controllers;
use App\Models\Produk;

use Illuminate\Http\Request;

class ProdukController extends Controller
{

public function updateStok(Request $request, $id)
{
    // $produk = Produk::where('seller_id', auth()->id())->findOrFail($id);

    $request->validate([
        'stok' => 'required|integer|min:0'
    ]);

//     $produk->stok += $request->stok;
//     $produk->save();

//     return redirect()->back()->with('success', 'Stok berhasil ditambahkan.');
}
}
