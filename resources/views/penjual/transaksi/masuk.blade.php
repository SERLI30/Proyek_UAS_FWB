@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Transaksi Masuk</h2>
    <a href="{{ route('produkPenjual.dashboard_penjual') }}" class="btn btn-secondary mb-3">← Kembali</a>
    @if($transaksis->isEmpty())
        <div class="alert alert-info">Belum ada transaksi masuk.</div>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Customer</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Lokasi Temu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                    @foreach($transaksi->produk as $produk)
                        <tr>
                            <td>{{ $transaksi->customer->name ?? '-' }}</td>
                            <td>{{ $produk->name }}</td>
                            <td>{{ $produk->pivot->quantity }}</td>
                            <td>Rp{{ number_format($produk->pivot->subtotal, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->lokasi_temu ?? '-' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
