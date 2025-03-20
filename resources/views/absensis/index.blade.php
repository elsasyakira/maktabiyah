@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">
            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card bg-primary py-0">
                        <h5 class="card-header text-white"><strong>Data Absensi Tausiyah</strong></h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('absensis.create') }}" class="btn btn-primary col-md-2"><i
                                class="ri-user-add-line me-1"></i>Tambah Absensi</a>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Pengisi</th>
                                    <th>Tempat</th>
                                    <th>Bulan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $bulanList = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                @endphp

                                @foreach ($absensis as $absensi)
                                    <tr>
                                        <td>{{ $absensi->id }}</td>
                                        <td>{{ $absensi->tausiyah->name ?? '-' }}</td>
                                        <!-- Menampilkan nama umat dari relasi -->
                                        <td>{{ ucfirst($absensi->status) }}</td>
                                        <td>{{ $absensi->ket }}</td>
                                        <td>{{ $absensi->pengisi }}</td>
                                        <td>{{ $absensi->tempat }}</td>
                                        <td>{{ $bulanList[$absensi->bulan] }}</td>
                                        <td>
                                            <a href="{{ route('absensis.edit', $absensi->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('absensis.destroy', $absensi->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger buttonDeletion">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
