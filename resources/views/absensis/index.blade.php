@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">
            <label class="fw-bold">List Data Absensi Tausiyah</label>

            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
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
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $absensi)
                                    <tr class="border-transparent">
                                        <td>{{ $absensi->tanggal }}</td>
                                        <td>{{ $item->umat->name }}</td>
                                        <td>{{ $absensi->status }}</td>
                                        <td>{{ $absensi->ket }}</td>
                                        <td>
                                            <a href="{{ route('absensis.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('absensis.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
