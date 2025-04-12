@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">

            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card bg-primary py-0">
                        <h5 class="card-header text-white"><strong>Data Anggota Halaqoh</strong></h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('tausiyahs.create') }}" class="btn btn-primary col-md-2"><i
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
                                    <th>Halaqoh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($tausiyahs) && $tausiyahs->count() > 0)
                                    @foreach ($tausiyahs as $index => $tausiyah)
                                        <tr>
                                            <td>{{ $tausiyah->umat->name }}</td>
                                            <td>{{ $tausiyah->holaqoh ?? '-' }}</td> <!-- Pastikan menampilkan halaqoh -->
                                            <td>
                                                <a href="{{ route('tausiyahs.edit', $tausiyah->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route('tausiyahs.destroy', $tausiyah->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger buttonDeletion">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
