@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4>Edit Umat</h4>
            <div class="col-12">
                <div class="card overflow-hidden p-4">
                    <form action="{{ route('umats.update', $umat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $umat->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $umat->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nas" class="form-label">Nas</label>
                                <input type="number" class="form-control" id="nas" name="nas"
                                    value="{{ $umat->nas }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="syubah" class="form-label">Syubah</label>
                                <select class="form-control" id="syubah" name="syubah">
                                    <option value="AshShidiqqin" {{ $umat->syubah == 'AshShidiqqin' ? 'selected' : '' }}>
                                        AshShidiqqin
                                    </option>
                                    <option value="AsySyuhada" {{ $umat->syubah == 'AsySyuhada' ? 'selected' : '' }}>AsySyuhada
                                    </option>
                                    <option value="AshSholihin" {{ $umat->syubah == 'AshSholihin' ? 'selected' : '' }}>
                                        AshSholihin</option>
                                    <option value="AlMutaqien" {{ $umat->syubah == 'AlMutaqien' ? 'selected' : '' }}>AlMutaqien
                                    </option>
                                    <option value="AlMuhsinin" {{ $umat->syubah == 'AlMuhsinin' ? 'selected' : '' }}>AlMuhsinin
                                    </option>
                                    <option value="AshShobirin" {{ $umat->syubah == 'AshShobirin' ? 'selected' : '' }}>
                                        AshShobirin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="farah" class="form-label">Farah</label>
                                <input type="number" class="form-control" id="farah" name="farah"
                                    value="{{ $umat->farah }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="holaqoh" class="form-label">Holaqoh</label>
                                <input type="number" class="form-control" id="holaqoh" name="holaqoh"
                                    value="{{ $umat->holaqoh }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('umats.index') }}" class="btn btn-secondary">Batal</a>
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
