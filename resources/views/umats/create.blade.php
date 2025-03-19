@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <label class="fw-bold mb-2">Tambah Umat</label>
            <div class="col-12">
                <div class="card overflow-hidden p-4">
                    <form action="{{ route('umats.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nas" class="form-label">Nas</label>
                                <input type="text" class="form-control" id="nas" name="nas" required>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="syubah" class="form-label">Syubah</label>
                                <select class="form-control" id="syubah" name="syubah">
                                    <option value="AshShidiqqin">AshShidiqqin</option>
                                    <option value="AsySyuhada">AsySyuhada</option>
                                    <option value="AshSholihin">AshSholihin</option>
                                    <option value="AlMutaqien">AlMutaqien</option>
                                    <option value="AlMuhsinin">AlMuhsinin</option>
                                    <option value="AshShobirin">AshShobirin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="farah" class="form-label">Farah</label>
                                <input type="number" class="form-control" id="farah" name="farah" required>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="holaqoh" class="form-label">Holaqoh</label>
                                <input type="text" class="form-control" id="holaqoh" name="holaqoh" required>
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('umats.index') }}" class="btn btn-secondary">Batal</a>
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
