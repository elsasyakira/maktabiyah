@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">

            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card bg-primary py-0">
                        <h5 class="card-header text-white"><strong>Data Umat</strong></h5>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="{{ route('umats.create') }}" class="btn btn-primary btn-sm">
                            <i class="ri-user-add-line me-1"></i>Tambah Data
                        </a>
                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari nama..." style="width: 300px;">
                    </div>
                    
                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="alert alert-info">
                        Total Data Umat: <strong>{{ $totalUmat }}</strong>
                    </div>
                    <div class="table-responsive ">
                        <table class="table table-bordered mt-3" id="umatTable">
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("searchInput");
            const rows = document.querySelectorAll("#umatTable tbody tr");
    
            input.addEventListener("keyup", function () {
                const keyword = this.value.toLowerCase();
    
                rows.forEach(row => {
                    const name = row.children[0].textContent.toLowerCase();
                    if (name.includes(keyword)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>       
@endsection
