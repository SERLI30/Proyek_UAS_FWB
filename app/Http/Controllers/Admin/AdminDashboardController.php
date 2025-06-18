<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all(); // semua pengguna
        $produks = Produk::with('seller')->get(); // produk dan penjual
        $transaksis = Transaksi::with(['customer', 'detailTransaksi'])->get(); // transaksi dan detail

        return view('admin.dashboard_admin', compact('users', 'produks', 'transaksis'));
    }
    public function show($id)
{
    $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);
    return view('admin.transaksi.show', compact('transaksi'));
}

}
