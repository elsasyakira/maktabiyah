@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <label class="fw-bold">Edit Absensis</label>
            <div class="col-12">
                <div class="card overflow-hidden p-4">
                    <form action="{{ route('absensis.update', $absensi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        <div class="mb-3">
                            <label for="umat_id" class="form-label">Nama Umat</label>
                            <select class="form-control" name="umat_id" id="umat_id" required>
                                <option value="">Pilih Umat</option>
                                @foreach ($tausiyahs as $tausiyah)
                                    <option value="{{ $tausiyah->id }}" {{ $tausiyah->id == $absensi->umat_id ? 'selected' : '' }}>
                                        {{ $tausiyah->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                @foreach (['hadir', 'izin', 'sakit', 'tanpa_keterangan'] as $status)
                                    <option value="{{ $status }}" {{ $absensi->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="ket" id="ket" value="{{ $absensi->ket }}" placeholder="Opsional">
                        </div>
                
                        <div class="mb-3">
                            <label for="pengisi" class="form-label">Pengisi</label>
                            <input type="text" class="form-control" name="pengisi" id="pengisi" value="{{ $absensi->pengisi }}" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="tempat" class="form-label">Tempat</label>
                            <input type="text" class="form-control" name="tempat" id="tempat" value="{{ $absensi->tempat }}" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-control" name="bulan" id="bulan" required>
                                <option value="">Pilih Bulan</option>
                                @foreach ([
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ] as $key => $bulan)
                                    <option value="{{ $key }}" {{ $absensi->bulan == $key ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                let id = $('input[name="id"]').val(); // Ambil ID dari form

                $.ajax({
                    url: "/umats/" + id,
                    type: "POST", // Laravel hanya menerima POST, bukan PUT
                    data: $(this).serialize() + "&_method=PUT", // Tambah _method=PUT
                    success: function(response) {
                        alert(response.success);
                        window.location.href = "{{ route('umats.index') }}";
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan. Coba lagi!');
                    }
                });
            });
        });
    </script>
@endsection
