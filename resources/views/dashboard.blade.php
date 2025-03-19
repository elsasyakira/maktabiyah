@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <!-- Congratulations card -->
            @if (auth()->user()->role == 'mudir')
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0 flex-wrap text-nowrap">Selamat Datang {{ auth()->user()->name }} 🎉
                            </h5>
                            <p class="mb-2">Jumlah Tausiah</p>
                            <h4 class="text-primary mb-0">1</h4>
                            <p class="mb-2">Persentase kehadiran 100% 🚀</p>
                            <a href="javascript:;" class="btn btn-sm btn-primary">Lihat Absensi</a>
                        </div>
                        <img src="{{ asset('mat/assets/img/illustrations/trophy.png') }}"
                            class="position-absolute bottom-0 end-0 me-5 mb-5" width="83" alt="view sales" />
                    </div>
                </div>
                <!--/ Congratulations card -->
            @else
                <!-- Transactions -->
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header ">
                            <div class="d-flex align-items-center">
                                <span class="ri-user-line ri-36px me-4"></span>
                                <h3 class="card-title m-0 me-2">Data Pengguna</h3>
                            </div>
                            <p class="small mb-0">Jumah Data Pengguna Setiap Role</p>
                        </div>
                        <div class="card-body pt-lg-5">
                            <div class="row g-6">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded shadow-xs">
                                                <i class="ri-vip-crown-line ri-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0">Admin</p>
                                            <h5 class="mb-0">{{ $jumlahAdmin }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-info rounded shadow-xs">
                                                <i class="ri-edit-box-line ri-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0">Mudir</p>
                                            <h5 class="mb-0">{{ $jumlahMudir }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-success rounded shadow-xs">
                                                <i class="ri-computer-line ri-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0">Jamiah</p>
                                            <h5 class="mb-0">{{ $jumlahJamiah }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-warning rounded shadow-xs">
                                                <i class="ri-macbook-line ri-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0">Syubah</p>
                                            <h5 class="mb-0">{{ $jumlahSyubah }}</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            @endif

        </div>
    </div>
@endsection
