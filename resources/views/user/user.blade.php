@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            <i class="ri-user-add-line me-1"></i> Add User</button>
                    </div>
                    <div class="table-responsive ">
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
                                            <div class="d-flex align-items-center">
                                                <i class="ri-user-3-line ri-22px text-success me-2"></i>
                                                <span>{{ $user->role }}</span>
                                            </div>
                                        </td>
                                        <td class="text-truncate">{{ $user->syubah }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-2-line"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href=""><i
                                                            class="ri-pencil-line me-1"></i> Edit</a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus {{ $user->name }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
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
            <!--/ Data Tables -->
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter Name" required />
                                    <label for="name">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-6 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="xxxx@xxx.xx" required />
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col mb-6 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select" id="subah" name="syubah" required>
                                        <option value="" disabled selected>Pilih Syubah</option>
                                        <option value="AshShidiqqin">AshShidiqqin</option>
                                        <option value="AsySyuhada">AsySyuhada</option>
                                        <option value="AshSholihin">AshSholihin</option>
                                        <option value="AlMutaqien">AlMutaqien</option>
                                        <option value="AlMuhsinin">AlMuhsinin</option>
                                        <option value="AshShobirin">AshShobirin</option>
                                    </select>
                                    <label for="subah">Syubah</label>
                                </div>
                            </div>
                            <div class="col mb-6 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="jamiah">Jamiah</option>
                                        <option value="syubah">Syubah</option>
                                        <option value="mudir">Mudir</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-6">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Password" required />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ri-eye-off-line ri-20px"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
