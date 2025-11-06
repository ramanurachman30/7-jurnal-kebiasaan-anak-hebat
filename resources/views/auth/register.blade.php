<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <img alt="Logo" src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" class="w-25 h-25" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input 
                    id="name" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Username --}}
            <div class="mt-4">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input 
                    id="username" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="username" 
                    :value="old('username')" 
                    required 
                />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            {{-- Email --}}
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Gender --}}
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                <select 
                    id="gender" 
                    name="gender" 
                    required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            {{-- Address --}}
            <div class="mt-4">
                <x-input-label for="address" :value="__('Alamat')" />
                <textarea 
                    id="address" 
                    name="address" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    rows="3"
                >{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            {{-- Phone Number --}}
            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
                <x-text-input 
                    id="phone_number" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="phone_number" 
                    :value="old('phone_number')" 
                    required 
                />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Confirm Password --}}
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation"
                    required 
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end mt-6">
                <a 
                    class="underline text-sm text-gray-600 hover:text-gray-900" 
                    href="{{ route('login') }}"
                >
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>
