<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='lemburs'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Lembur"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Absensi</h6>
                </div>
            </div>
            <br>
            <br>
            @if (Auth::user()->level == 'U')
                <div class="card-body px-0 pb-2">
                    <a href="{{ route('lemburs.create') }}" class="btn btn-primary mx-3 pt-4 pb-3 color:white">Lembur</a>


                    <form method="GET" action="{{ route('lemburs.index') }}" class="mx-3 pt-4 pb-3">
                        <div class="form__group">
                            <label for="bulan" class="form__label">Bulan:</label>
                            <div class="custom-select form__input">
                                <select name="bulan" class="form-control" id="bulan">
                                    <option value="">Pilih Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="form__group">
                            <label for="tahun" class="form__label">Tahun:</label>
                            <div class="custom-select form__input">
                                <select name="tahun" class="form-control" id="tahun">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary">Tampilkan Data Lembur</button>
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



                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Lembur</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal dan Waktu </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lemburs as $items)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->lembur }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->created_at }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <!-- end main content -->

        {{-- Modal delete --}}
        <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form action="" id="form-del" method="post">
                        @method('DELETE')
                        @csrf

                        <div class="modal-header">
                            <h4 class="modal-title">Peringatan!</h4>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                        </div>
                        <div class="modal-body" id="mb-konfirmasi">
                            {{-- <p>One fine body&hellip;</p> --}}
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary">Iya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="../../plugins/jquery/jquery.min.js"></script>

        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script>
            // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
            // id disini adalah id jabatan
            $('.btn-hapus').click(function() {
                let namaKaryawan = $(this).attr('data-namakaryawan');
                let id = $(this).attr('data-id');
                $('#form-del').attr('action', '/karyawans/' + id);
                //let namaJabatan = $(this).attr('data-namajabatan');
                $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data karyawan : " + namaKaryawan + " ?")
            })
            // jika tombol Ya, hapus ditekan, submit form hapus
            $('#form-del [type="submit"]').click(function() {
                $('#formDelete').submit();
            })
        </script>

    </main>
</x-layout>
