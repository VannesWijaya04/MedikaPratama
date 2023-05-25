<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='statusKehadirans'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Status Kehadiran"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Status</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if (Auth::user()->level == 'A')
                    <a href="{{ route('statusKehadirans.create') }}">
                        <button type="submit" class="btn btn-primary mx-3 pt-4 pb-3 color:white">
                            Tambah Status Kehadiran 
                        </button>
                    </a>
                @endif
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Id</th> --}}
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status Kehadiran</th>
                                @if (Auth::user()->level == 'A')
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                @endif

                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($status as $items)
                                <tr>
                                    {{-- <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $items->id }}</h6>
                                            </div>
                                        </div>

                                    </td> --}}
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $items->status_kehadiran }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- kolom aksi --}}
                                    @if (Auth::user()->level == 'A')
                                        <td class="align-middle">
                                            {{-- button edit --}}
                                            <a href="{{ route('statusKehadirans.edit', ['statusKehadiran' => $items->id]) }}"
                                                class="btn btn-info" data-toggle="tooltip"
                                                data-original-title="Edit user"
                                                title="Edit data {{ $items->status_kehadiran }}"
                                                style="font-size: 15px; padding: 5px 5px; color:white">
                                                Edit
                                            </a>
                                            <br>
                                            {{-- Button Hapus --}}
                                            {{-- <button type="button" class="btn btn-danger btn-hapus" data-toggle="modal"
                                                style="font-size: 15px; padding: 5px 5px; color:white"
                                                data-target="#modal-sm" data-id="{{ $items->id }}"
                                                data-statuskehadiran="{{ $items->status_kehadiran }}">
                                                Hapus
                                            </button> --}}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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

        <script>
            // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
            // id disini adalah id jabatan
            $('.btn-hapus').click(function() {
                let id = $(this).attr('data-id');
                $('#form-del').attr('action', '/statusKehadirans/' + id);
                let statusKehadiran = $(this).attr('data-statuskehadiran');
                $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus status kehadiran : " + statusKehadiran +
                    " ?")
            })
            // jika tombol Ya, hapus ditekan, submit form hapus
            $('#form-del [type="submit"]').click(function() {
                $('#formDelete').submit();
            })
        </script>
    </main>
</x-layout>
