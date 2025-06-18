@php
    $user = auth()->user();
    $name = $user->name;
    $role = $user->role;

    $image = match($role) {
        'admin' => asset('img/admin_welcome.png'),
        'seller' => asset('img/seller_welcome.png'),
        'customer' => asset('img/customer_welcome.png'),
        default => asset('img/default_welcome.png'),
    };

    $greeting = match($role) {
        'admin' => 'Halo Admin Hebat!',
        'seller' => 'Hai Penjual Kreatif!',
        'customer' => 'Selamat Datang, Pelanggan Setia!',
        default => 'Selamat Datang!',
    };
@endphp

<div class="card shadow mb-4 p-3 d-flex flex-row align-items-center">
    <img src="{{ $image }}" alt="Gambar Sapaan" width="100" class="me-4 rounded-circle">
    <div>
        <h5>{{ $greeting }}</h5>
        <p class="mb-0">Senang bertemu kembali, <strong>{{ $name }}</strong>.</p>
    </div>
</div>
