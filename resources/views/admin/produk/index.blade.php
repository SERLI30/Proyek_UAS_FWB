@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h3>Kelola Data Produk</h3>
    <a href="{{ route('admin.dashboard_admin') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Penjual</th> <!-- Tambahan kolom -->
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->name }}</td>
                    <td>Rp{{ number_format($produk->price) }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->kategori->name ?? '-' }}</td>
                    <td>{{ $produk->seller->name ?? '-' }}</td> <!-- Diperbaiki -->
                    <td>{{ $produk->deskripsi }}</td>
                    <td>
                        @if ($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" width="80">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
