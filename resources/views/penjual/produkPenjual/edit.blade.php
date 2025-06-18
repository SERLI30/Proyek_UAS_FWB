@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit Produk</h2>
    <a href="{{ route('produkPenjual.dashboard_penjual') }}" class="btn btn-secondary mb-3">← Kembali</a>
    <form action="{{ route('penjual.produkPenjual.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ $produk->name }}" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $produk->price }}" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Gambar Produk</label>
            <input type="file" name="gambar" class="form-control-file">
            @if($produk->gambar)
                <p>Gambar Saat Ini:</p>
                <img src="{{ asset('storage/' . $produk->gambar) }}" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('penjual.produkPenjual.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
