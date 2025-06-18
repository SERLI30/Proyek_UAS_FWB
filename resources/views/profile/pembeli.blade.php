@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Profil Pembeli</h2>
     <a href="{{ route('pembeli.dashboard_pembeli') }}" class="btn btn-secondary mb-3">← Kembali</a>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="row">
        <!-- Kolom Kiri: Info Profil -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if ($profil && $profil->foto)
                        <img src="{{ asset('storage/'.$profil->foto) }}" class="img-thumbnail mb-3" width="150">
                    @else
                        <img src="{{ asset('utama') }}/assets/img/wanita/gauncream2.jpeg" class="img-thumbnail mb-3" width="150">
                    @endif

                    <h5>{{ $user->name }}</h5>
                    <p>{{ $user->email }}</p>
                    <p><strong>No HP:</strong> {{ $profil->no_hp ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $profil->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Edit -->
        <div class="col-md-8">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $profil->no_hp ?? '') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Foto Profil</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <button class="btn btn-primary">Simpan Perubahan</button>
            </form>

            <hr>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <label>Password untuk konfirmasi hapus:</label>
                <input type="password" name="password" class="form-control" required>

                <button type="submit" class="btn btn-danger mt-2">Hapus Akun</button>
            </form>
        </div>
    </div>
</div>
@endsection
