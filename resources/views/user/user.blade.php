@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-3">
            <label class="fw-bold">List Data User</label>
            <div class="col-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal"
                            onclick="resetModal()">
                            <i class="ri-user-add-line me-1"></i> Tambah User</button>
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
                                        <td class="text-truncate"><i
                                                class="ri-user-3-line ri-22px text-success me-2"></i>{{ $user->role }}
                                        </td>
                                        <td class="text-truncate">{{ $user->syubah }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-2-line"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="#"
                                                        onclick="editUser({{ $user }})" data-bs-toggle="modal"
                                                        data-bs-target="#userModal">
                                                        <i class="ri-pencil-line me-1"></i> Edit
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
        </div>
    </div>

    <!-- Modal Tambah/Edit User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="userForm" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="id">
                        <div class="form-floating mb-3">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama"
                                required>
                            <label for="name">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="syubah" name="syubah" required>
                                <option value="" disabled selected>Pilih Syubah</option>
                                <option value="AshShidiqqin">AshShidiqqin</option>
                                <option value="AsySyuhada">AsySyuhada</option>
                                <option value="AshSholihin">AshSholihin</option>
                                <option value="AlMutaqien">AlMutaqien</option>
                                <option value="AlMuhsinin">AlMuhsinin</option>
                                <option value="AshShobirin">AshShobirin</option>
                            </select>
                            <label for="syubah">Syubah</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="role" name="role" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="jamiah">Jamiah</option>
                                <option value="syubah">Syubah</option>
                                <option value="mudir">Mudir</option>
                            </select>
                            <label for="role">Role</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password">
                            <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editUser(user) {
            document.getElementById('modalTitle').innerText = 'Edit User';
            document.getElementById('userForm').action = `/user/${user.id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('syubah').value = user.syubah;
            document.getElementById('role').value = user.role;
        }

        function resetModal() {
            document.getElementById('modalTitle').innerText = 'Tambah User';
            document.getElementById('userForm').action = '{{ route('user.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('userForm').reset();
        }
    </script>
@endsection
