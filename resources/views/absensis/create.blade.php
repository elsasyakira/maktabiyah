@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4>Tambah Absensi Tausiyah</h4>
            <div class="col-12">
                <div class="card overflow-hidden p-4">
                    <form action="{{ route('absensis.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status Kehadiran</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="tanpa_keterangan">Tanpa Keterangan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="ket" name="ket">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('absensis.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {
            $('#umatForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('umats.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
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
    </script> --}}
@endsection
