<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='kehadirans'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Absensi"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">ABSEN</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <form action="{{ route('kehadirans.store') }}" method="post" class="form mx-3 pt-4 pb-3">
                    @csrf
                    <br>
                    <h5 class="centered-text">Absensi Kehadiran</h5>
                    <br>

                    <div class="form__group">
                        <label for="status_kehadiran" class="form__label">Status Kehadiran</label>
                        <div class="custom-select form__input">
                            <select name="status_kehadiran" id="status_kehadiran">
                                @foreach ($status_kehadirans as $item)
                                    <option value="{{ $item->id }}">{{ $item->status_kehadiran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>

                    <label for="keterangan" class="form__label">Keterangan</label>
                    <input required name="keterangan" class="form_input" type="text" placeholder="keterangan">

                    <div hidden>
                        <label for="id_karyawan">ID Karyawan</label>
                        <input required name="id_karyawan" type="text" placeholder="id_karyawan"
                            value="{{ Auth::user()->id }}" readonly>
                    </div>
                    <br>
                    <br>

                    <button type="submit" class="btn btn-primary color:white">Absen</button>
                </form>

                <style>
                    .form__group {
                        display: grid;
                        grid-template-columns: 300px auto;
                        align-items: center;
                        gap: 10px;
                    }

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

                    .custom-select {
                        position: relative;
                        display: inline-block;
                        width: 200px;
                        /* Sesuaikan dengan lebar yang diinginkan */
                        height: 50px;
                        /* Sesuaikan dengan tinggi yang diinginkan */
                        background-color: #f8f9fa;
                        border-radius: 4px;
                        overflow: hidden;
                        border: 1px solid #ced4da;
                    }

                    .custom-select select {
                        width: 100%;
                        height: 100%;
                        padding: 8px;
                        outline: none;
                        border: none;
                        background-color: transparent;
                        font-size: 14px;
                        line-height: 1.5;
                        color: #495057;
                        appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                    }

                    .custom-select::after {
                        content: '\f078';
                        /* Unicode untuk ikon chevron bawah (down arrow) */
                        font-family: 'FontAwesome';
                        position: absolute;
                        top: 0;
                        right: 0;
                        padding: 9px 12px;
                        background-color: #f8f9fa;
                        color: #495057;
                        pointer-events: none;
                    }

                    .custom-select select:focus+.custom-select::after {
                        color: #007bff;
                        /* Warna ikon saat select di dalam fokus */
                    }
                </style>
            </div>

            {{-- <script>
                document.querySelector('#status_kehadiran').addEventListener('change', function() {
                    const keterangan = document.querySelector('#keterangan');
                    if (this.value === 'izin') {
                        keterangan.style.display = 'block';
                        keterangan.querySelector('textarea').setAttribute('required', 'required');
                    } else {
                        keterangan.style.display = 'none';
                        keterangan.querySelector('textarea').removeAttribute('required');
                    }
                });
            </script> --}}
        </div>
        <!-- end main content -->




    </main>
</x-layout>
