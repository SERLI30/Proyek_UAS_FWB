<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembeliProdukController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            abort(403, 'Akses hanya untuk pembeli.');
        }

        $produks = Produk::all();
        return view('pembeli.produk.index', compact('produks'));
    }

    

    public function showCheckoutForm($id)
    {
        $produk = Produk::findOrFail($id);
        return view('pembeli.checkout.index', compact('produk'));
    }

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
            'lokasi_temu' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $produk = Produk::findOrFail($request->produk_id);
            $subtotal = $produk->price * $request->quantity;

            $transaksi = Transaksi::create([
                'customer_id' => Auth::id(),
                'total_price' => $subtotal,
                'status' => 'pending',
                'payment_method' => 'cod',
                'lokasi_temu' => $request->lokasi_temu,
            ]);

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk->id,
                'quantity' => $request->quantity,
                'subtotal' => $subtotal,
            ]);

            DB::commit();
            return redirect()->route('pembeli.pesanan')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat checkout.');
        }
    }

    public function pesanan()
    {
        $pesanans = Transaksi::with(['detailTransaksi.produk'])
                    ->where('customer_id', Auth::id())
                    ->latest()
                    ->get();

        return view('pembeli.pesanan.index', compact('pesanans'));
    }
}
