@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detail Transaksi #{{ $transaksi->id }}</h2>
    <a href="{{ route('admin.dashboard_admin') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <p><strong>Nama Pembeli:</strong> {{ optional($transaksi->customer)->name ?? '-' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ strtoupper($transaksi->payment_method) }}</p>
    <p><strong>Lokasi Temu:</strong> {{ $transaksi->lokasi_temu }}</p>
    <p><strong>Total Harga:</strong> Rp{{ number_format($transaksi->total_price, 0, ',', '.') }}</p>

    <hr>

    <h4>Detail Produk:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->detailTransaksi as $detail)
            <tr>
                <td>{{ $detail->produk->name ?? '-' }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
