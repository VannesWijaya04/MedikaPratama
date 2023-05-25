<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='status'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="TambahStatusKehadiran"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- main content -->
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tambah Status Kehadiran</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <form action="{{ route('statusKehadirans.store') }}" method="post" class="form mx-3 pt-4 pb-3">
                    @csrf
                    <br>
                    <h5 class="centered-text">Tambah Status Kehadiran</h5>
                    <br>

                    <label for="" class="form__label">Status Kehadiran</label>
                    <input required name="statushadir" class="form__input" type="text" placeholder="Status Kehadiran">

                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary color:white">Tambah Status Kehadiran</button>
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
        <!-- end main content -->
    </main>
</x-layout>
