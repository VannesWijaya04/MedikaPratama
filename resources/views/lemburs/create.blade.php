<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='lemburs'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Absensi Lembur"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Absensi Lembur</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <form action="{{ route('lemburs.store') }}" method="post" class="form mx-3 pt-4 pb-3">
                    @csrf
                    <br>
                    <h5 class="centered-text">Absen Lembur</h5>
                    <br>

                    <label for="keterangan" class="form__label">Keterangan Lembur</label>
                    <input required name="lembur" class="form__input" type="text" placeholder="keterangan">

                    <div hidden>
                        <label for="id_karyawan">ID Karyawan</label>
                        <input required name="id_karyawan" type="text" placeholder="id_karyawan"
                            value="{{ Auth::user()->id }}" readonly>
                    </div>
                    <br>
                    <br>

                    <button type="submit" class="btn btn-primary color:white">
                        Simpan Lembur</button>
                </form>

                <style>
                    .form__label {
                        display: inline-block;
                        width: 300px;
                        margin-bottom: 5px;
                    }

                    .centered-text {
                        text-align: center;
                    }

                    .form__input {
                        display: inline-block;
                        width: 500px;
                        padding: 5px;
                        margin-bottom: 10px;
                        border-radius: 5px;
                        border: 1px solid #ccc;
                    }
                </style>
            </div>

        </div>
    </main>
</x-layout>
