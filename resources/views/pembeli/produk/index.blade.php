@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Daftar Produk</h2>
    <a href="{{ route('pembeli.dashboard_pembeli') }}" class="btn btn-secondary mb-3">← Kembali</a>
    <div class="row">
        @foreach ($produks as $produk)
            <div class="col-md-4 mb-4 d-flex">
                <div class="card w-100 h-100 d-flex flex-column">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                             class="card-img-top"
                             alt="{{ $produk->name }}"
                             style="height: 250px; object-fit: cover; object-position: center;">
                    @else
                        <img src="https://via.placeholder.com/300x300"
                             class="card-img-top"
                             alt="No Image"
                             style="height: 250px; object-fit: cover; object-position: center;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produk->name }}</h5>
                        <p class="card-text">{{ $produk->deskripsi }}</p>
                        <p class="card-text"><strong>Rp{{ number_format($produk->price, 0, ',', '.') }}</strong></p>
                        <a href="{{ route('pembeli.produk.checkout.form', $produk->id) }}"
                           class="btn btn-primary mt-auto">Beli</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
