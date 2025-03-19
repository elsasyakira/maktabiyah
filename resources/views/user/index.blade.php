@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">

            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card bg-primary py-0">
                        <h5 class="card-header text-white"><strong>Data User</strong></h5>
                    </div>
                    <div class="card-header d-flex flex-warp justify-content-center justify-content-xl-between">
                        <div>
                            <a class="btn btn-primary btn-sm me-2" href="{{ route('user.create') }}">
                                <i class="ri-user-add-line me-1"></i> Tambah User
                            </a>
                        </div>
                        <div>
                            <a class="btn btn-danger btn-sm" href="{{ route('user.pdf') }}">
                                <i class="ri-file-pdf-2-line me-1"></i> Cetak PDF
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-truncate">Nama</th>
                                    <th class="text-truncate">Role</th>
                                    <th class="text-truncate">Syubah</th>
                                    <th class="text-truncate">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-transparent">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-4">
                                                    <img src="{{ asset('mat/assets/img/avatars/1.png') }}" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-truncate">{{ $user->name }}</h6>
                                                    <small class="text-truncate">{{ $user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">
                                            @switch($user->role)
                                                @case('admin')
                                                    <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>

                                                    {{ $user->role }}
                                                @break

                                                @case('jamiah')
                                                    <i class="ri-computer-line text-danger ri-22px me-2"></i>
                                                    {{ $user->role }}
                                                @break

                                                @case('syubah')
                                                    <i class="ri-macbook-line ri-22px text-info me-2"></i>
                                                    {{ $user->role }}
                                                @break

                                                @case('mudir')
                                                    <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                                    {{ $user->role }}
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-truncate">
                                            @switch($user->syubah)
                                                @case('AshShidiqqin')
                                                    <span class="badge rounded-pill bg-label-primary">
                                                        {{ $user->syubah }}
                                                    </span>
                                                @break

                                                @case('AsySyuhada')
                                                    <span class="badge rounded-pill bg-label-secondary">
                                                        {{ $user->syubah }}
                                                    </span>
                                                @break

                                                @case('AshSholihin')
                                                    <span class="badge rounded-pill bg-label-success">
                                                        {{ $user->syubah }}
                                                    </span>
                                                @break

                                                @case('AlMutaqien')
                                                    <span class="badge rounded-pill bg-label-danger">
                                                        {{ $user->syubah }}
                                                    </span>
                                                @break

                                                @case('AlMuhsinin')
                                                    <span class="badge rounded-pill bg-label-warning">
                                                        {{ $user->syubah }}
                                                    </span>
                                                @break

                                                @case('AshShobirin')
                                                    <span class="badge rounded-pill bg-label-info">
                                                        {{ $user->syubah }}
                                                    </span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-2-line"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item text-warning"
                                                        href="{{ route('user.edit', $user->id) }}"> <i
                                                            class="ri-pencil-line me-1"></i> Edit
                                                    </a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger buttonDeletion">
                                                            <i class="ri-delete-bin-6-line me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
