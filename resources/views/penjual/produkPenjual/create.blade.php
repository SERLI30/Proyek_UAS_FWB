@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    <a href="{{ route('produkPenjual.dashboard_penjual') }}" class="btn btn-secondary mb-3">← Kembali</a>
    <form action="{{ route('penjual.produkPenjual.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Gambar Produk</label>
            <input type="file" name="gambar" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penjual.produkPenjual.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
