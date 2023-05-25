<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='karyawans'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Karyawan"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Data Karyawan</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if (Auth::user()->level == 'A')
                    <a href="{{ route('karyawans.create') }}" class="color:white">
                        <button type="submit" class="btn btn-primary mx-3 pt-4 pb-3 color:white">
                            Tambah Karyawan
                        </button>
                    </a>
                @endif
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama Karyawan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Jabatan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status Karyawan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Jenis Kelamin</th>
                                @if (Auth::user()->level == 'A')
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $items)
                                @if ($items->level != 'A')
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->nama_karyawan }}</h6>
                                                </div>
                                            </div>
                                            {{-- <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $items->nama_karyawan }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $items->id }}
                                                            </p>
                                                        </div>
                                                    </div> --}}
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->jabatan }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->status_karyawan }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->email }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $items->jenis_kelamin }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        @if (Auth::user()->level == 'A')
                                            <td class="align-middle">
                                                {{-- button edit --}}
                                                {{-- <a href="{{ route('jabatans.edit', ['jabatan' => $items->id]) }}"
                                                        class="btn btn-default" data-toggle="tooltip"
                                                        data-original-title="Edit user" title="Edit data {{ $items->jabatan }}">
                                                        Edit
                                                    </a> --}}
                                                <br>
                                                {{-- Button Hapus --}}
                                                {{-- <button type="button" class="btn btn-default btn-hapus"
                                                    data-toggle="modal" data-target="#modal-sm"
                                                    data-namakaryawan="{{ $items->nama_karyawan }}"
                                                    data-id="{{ $items->id }}">
                                                    Hapus
                                                </button> --}}

                                                {{-- Button Edit --}}
                                                <a href="{{ route('karyawans.edit', ['karyawan' => $items->id]) }}"
                                                    title="Edit {{ $items->nama_karyawan }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                {{-- button info --}}
                                                <a href="{{ route('karyawans.show', ['karyawan' => $items->id]) }}"
                                                    title="Info {{ $items->nama_karyawan }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-info"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
