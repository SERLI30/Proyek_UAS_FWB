@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Produk Saya</h2>

    <a href="{{ route('produkPenjual.dashboard_penjual') }}" class="btn btn-secondary mb-3">← Kembali</a>
    <a href="{{ route('penjual.produkPenjual.create') }}" class="btn btn-primary mb-3 ms-2">Tambah Produk</a>

    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
            <tr>
                <td>{{ $produk->name }}</td>
                <td>Rp{{ number_format($produk->price, 0, ',', '.') }}</td>
                <td>{{ $produk->stok }}</td>
                <td>{{ $produk->kategori->name ?? '-' }}</td>
                <td>
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" width="80">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('penjual.produkPenjual.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('penjual.produkPenjual.destroy', $produk->id) }}" method="POST" style="display:inline;">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
