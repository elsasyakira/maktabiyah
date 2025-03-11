@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">
            <label class="fw-bold">List Data Umat</label>

            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <a href="{{ route('umats.create') }}" class="btn btn-primary col-md-2"><i
                                class="ri-user-add-line me-1"></i>Tambah Data</a>
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
                                    <th>Nama</th>
                                    <th>NAS</th>
                                    <th>Syubah</th>
                                    <th>Farah</th>
                                    <th>Halaqoh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($umats as $umat)
                                    <tr class="border-transparent">
                                        <td>{{ $umat->name }}</td>
                                        <td>{{ $umat->nas }}</td>
                                        <td>{{ $umat->syubah }}</td>
                                        <td>{{ $umat->farah }}</td>
                                        <td>{{ $umat->holaqoh }}</td>
                                        <td>
                                            <a href="{{ route('umats.edit', $umat->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('umats.destroy', $umat->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?');"
                                                    class="btn btn-danger">
                                                    Hapus
                                                </button>
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
