<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='karyawans'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tambah Karyawan"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tambah Karyawan</h6>
                </div>
            </div>
            <br>
            <br>
            <div class="card-body px-0 pb-2">

                <form action="{{ route('karyawans.store') }}" method="post" class="form mx-3 pt-4 pb-3">
                    @csrf
                    <br>
                    <h5 class="centered-text">From Tambahkan Karyawan</h5>
                    <br>
                    
                    <label for="name" class="form__label">Nama Karyawan</label>
                    <input required name="name" id="name" type="text" class="form__input"
                        placeholder="Nama Karyawan">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <br>
                    <label for="email" class="form__label">Email</label>
                    <input required name="email" id="email" type="text" class="form__input"
                        placeholder="Email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <br>
                    <label for="jenis_kelamin" class="form__label">Jenis Kelamin</label>

                    <input class="form__inputradio" type="radio" name="jenis_kelamin" value="Pria"
                        {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }}> Pria
                    <input class="form__inputradio" type="radio" name="jenis_kelamin" value="Wanita"
                        {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }}> Wanita

                    <br>
                    <label for="jabatan" class="form__label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form__input">
                        @foreach ($jabatans as $item)
                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="level" class="form__label">Level</label>
                    <input class="form__inputradio" type="radio" name="level" value="A"
                        {{ old('level') == 'A' ? 'checked' : '' }}> Admin
                    <input class="form__inputradio" type="radio" name="level" value="U"
                        {{ old('level') == 'U' ? 'checked' : '' }}> User
                    <br>
                    <label for="password" class="form__label">Password</label>
                    <input required name="password" id="password" type="password" class="form__input"
                        autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    <br>
                    <label for="password_confirmation" class="form__label">Konfirmasi Password</label>
                    <input required name="password_confirmation" id="password_confirmation" type="password"
                        class="form__input" autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <br>
                    <button type="submit" class="btn btn-primary mx-3 pt-4 pb-3 color:white">Tambahkan
                        Karyawan</button>
                </form>

                <style>
                    .form__label {
                        display: inline-block;
                        width: 300px;
                        margin-bottom: 5px;
                    }

                    .form__input {
                        display: inline-block;
                        width: 500px;
                        padding: 5px;
                        margin-bottom: 10px;
                        border-radius: 5px;
                        border: 1px solid #ccc;
                    }

                    .centered-text {
                        text-align: center;
                    }

                    .form__inputradio[type="radio"] {
                        display: inline-block;
                        vertical-align: middle;
                        /* add this property to align the radio button */
                        margin-right: 5px;
                    }
                </style>

            </div>
        </div>
        <!-- end main content -->


    </main>
</x-layout>
