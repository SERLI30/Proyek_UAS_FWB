<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $transaksi = Transaksi::create([
                // 'customer_id'    => auth()->id(),
                'total_price'    => 0,
                'status'         => 'pending',
                'payment_method' => 'cod',
                'lokasi_temu'    => $request->lokasi_temu,
            ]);

            $total = 0;

            foreach ($request->items as $item) {
                $produk = Produk::findOrFail($item['produk_id']);

                if ($produk->stok < $item['quantity']) {
                    throw new \Exception("Stok tidak cukup untuk produk: " . $produk->name);
                }

                $produk->stok -= $item['quantity'];
                $produk->save();

                $subtotal = $produk->price * $item['quantity'];
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $produk->id,
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $subtotal,
                ]);
            }

            $transaksi->total_price = $total;
            $transaksi->save();
        });

        return redirect()->back()->with('success', 'Transaksi berhasil!');
    }
}
