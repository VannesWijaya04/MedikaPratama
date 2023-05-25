<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('assets') }}/img/user_profile.png" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $karyawan->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ $karyawan->jabatan }}
                            </p>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="mb-5 ps-3">
                                <h6 class="mb-1">Riwayat Kehadiran</h6>
                                @php
                                    $filter = null;
                                    if (isset($_GET['filter_tanggal'])) {
                                        $filter = $_GET['filter_tanggal'];
                                    }
                                @endphp
                                <form action="{{ route('karyawans.show', ['karyawan' => $karyawan->id]) }}"
                                    method="get">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-2">
                                            <input class="" type="month" name="filter_tanggal" id=""
                                                required value="{{ $filter }}">

                                        </div>

                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                    class="fas fa-filter" title="Filter berdasarkan tanggal"></i>
                                            </button>
                                            @if (isset($_GET['filter_tanggal']))
                                                <a href="{{ route('karyawans.show', ['karyawan' => $karyawan->id]) }}"
                                                    class="btn btn-secondary btn-sm" title="Hapus Filter"><i
                                                        class="fas fa-minus"></i></a>
                                            @endif

                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- tabel kehadiran --}}
                            @if (isset($_GET['filter_tanggal']))
                                @if (count($kehadirans) > 0)
                                    <div class="table-responsive p-0">
                                        <h12>Data Absensi</h12>
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tanggal</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status Kehadiran</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kehadirans as $item)
                                                    <tr>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $item->tanggal }}</p>
                                                        </td>
                                                        <td >
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $item->status_kehadiran }}</p>
                                                        </td>
                                                        <td >
                                                            <p class="text-secondary text-xs font-weight-bold">
                                                                {{ $item->keterangan }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <h12>Data Lembur</h12>
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tanggal</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lemburs as $item)
                                                    <tr>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $item->tanggal }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $item->lembur }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    Tidak ada data kehadiran
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    {{-- <x-plugins></x-plugins> --}}

</x-layout>
