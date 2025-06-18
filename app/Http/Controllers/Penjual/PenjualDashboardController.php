<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenjualDashboardController extends Controller
{
    public function index()
    {
        // Validasi role user
        if (!Auth::check() || Auth::user()->role !== 'seller') {
            abort(403, 'Akses hanya untuk penjual.');
        }

        // Jika role cocok, tampilkan view dashboard penjual
        return view('penjual.produkPenjual.dashboard_penjual');
    }
}
