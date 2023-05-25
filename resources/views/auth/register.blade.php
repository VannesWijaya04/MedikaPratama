<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mt-4">
            <label for="">Jenis Kelamin</label><br>
            <input class="form__inputradio" type="radio" name="jenis_kelamin" value="Pria"
                {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }}> Pria
            <input class="form__inputradio" type="radio" name="jenis_kelamin" value="Wanita"
                {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }}> Wanita
        </div>

        {{-- Jabatan --}}
        <div class="mt-4">
            <x-input-label for="jabatan" :value="__('Jabatan')" />
            <select name="jabatan" id="">
                @foreach ($jabatans as $item)
                    <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <style>
        .form__inputradio[type="radio"] {
            display: inline-block;
            vertical-align: middle;
            /* add this property to align the radio button */
            margin-right: 5px;
        }
    </style>
</x-guest-layout>
