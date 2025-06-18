@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Pesanan Saya</h2>
    <a href="{{ route('pembeli.dashboard_pembeli') }}" class="btn btn-secondary mb-3">← Kembali</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $pesanan)
                @foreach($pesanan->detailTransaksi as $detail)
                    <tr>
                        <td>{{ $pesanan->id }}</td>
                        <td>{{ $detail->produk->name ?? '-' }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($pesanan->status) }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
