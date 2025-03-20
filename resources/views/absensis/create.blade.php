@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card bg-primary py-0">
                    <h5 class="card-header text-white"><strong>Data User</strong></h5>
                </div>
                <div class="card overflow-hidden p-4">
                    <form action="{{ route('absensis.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Row 1 -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="umat_id" class="form-label">Nama Umat</label>
                                    <select class="form-control" name="umat_id" id="umat_id" required>
                                        <option value="">Pilih Umat</option>
                                        @foreach ($tausiyahs as $tausiyah)
                                            <option value="{{ $tausiyah->id }}">{{ $tausiyah->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="tanpa_keterangan">Tanpa Keterangan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="ket" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="ket" id="ket" placeholder="Opsional">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Row 2 -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pengisi" class="form-label">Pengisi</label>
                                    <input type="text" class="form-control" name="pengisi" id="pengisi" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tempat" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" name="tempat" id="tempat" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select class="form-control" name="bulan" id="bulan" required>
                                        <option value="">Pilih Bulan</option>
                                        @foreach ([
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                        ] as $key => $bulan)
                                            <option value="{{ $key }}">{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('absensis.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
