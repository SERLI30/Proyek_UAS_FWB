@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Checkout Produk</h2>
    <a href="{{ route('pembeli.dashboard_pembeli') }}" class="btn btn-secondary mb-3">← Kembali</a>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $produk->name }}</h5>
            <p class="card-text">Harga: Rp{{ number_format($produk->price, 0, ',', '.') }}</p>

            <form action="{{ route('pembeli.produk.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                <div class="form-group">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="lokasi_temu">Lokasi Temu (Opsional):</label>
                    <input type="text" name="lokasi_temu" id="lokasi_temu" class="form-control" placeholder="Contoh: Depan kampus, rumah, dll">
                </div>

                <button type="submit" class="btn btn-primary mt-4">Konfirmasi Beli</button>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                     @endforeach
                    </ul>
                    </div>
                    @endif
            </form>
        </div>
    </div>
</div>
@endsection
