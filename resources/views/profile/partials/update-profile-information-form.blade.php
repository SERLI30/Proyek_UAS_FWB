<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- USER TABLE -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- PROFIL TABLE -->
        <div>
            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
            <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full"
                :value="old('nama_lengkap', $user->profil->nama_lengkap ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
        </div>

        <div>
            <x-input-label for="alamat" :value="__('Alamat')" />
            <textarea name="alamat" id="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                {{ old('alamat', $user->profil->alamat ?? '') }}
            </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div>
            <x-input-label for="foto" :value="__('Foto Profil')" />
            @if ($user->profil && $user->profil->foto)
                <img src="{{ asset('storage/' . $user->profil->foto) }}" alt="Foto Profil" width="100" class="mb-2 rounded">
            @endif
            <x-text-input id="foto" name="foto" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
        </div>

        <!-- VERIFIKASI EMAIL -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
