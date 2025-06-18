@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Daftar Transaksi</h2>
    <a href="{{ route('admin.dashboard_admin') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pembeli</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Metode Pembayaran</th>
                <th>Lokasi Temu</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $trx)
            <tr>
                <td>{{ $trx->id }}</td>
                <td>{{ $trx->customer->name ?? '-' }}</td>
                <td>Rp{{ number_format($trx->total_price, 0, ',', '.') }}</td>
                <td>{{ ucfirst($trx->status) }}</td>
                <td>{{ strtoupper($trx->payment_method) }}</td>
                <td>{{ $trx->lokasi_temu }}</td>
                <td>
                    <a href="{{ route('admin.transaksi.show', $trx->id) }}" class="btn btn-sm btn-info">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Jika kamu menggunakan pagination --}}
    {{-- <div class="d-flex justify-content-center">
        {{ $transaksis->links() }}
    </div> --}}
</div>
@endsection
