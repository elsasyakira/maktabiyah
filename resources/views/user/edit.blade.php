@extends('partials.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <!-- Account -->
                        <div class="card-header bg-warning">
                            <a class="btn btn-primary" href="{{ route('user') }}">
                                <i class="ri-arrow-left-line me-1"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">

                            <form id="formAccountSettings" action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                <div class="row mt-1 g-5">
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                id="firstName" name="name" placeholder="Masukan Nama"
                                                value="{{ $user->name }}" />
                                            @error('name')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                name="email" id="lastName" placeholder="Masukan Email"
                                                value="{{ $user->email }}" />
                                            @error('email')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select name="syubah"
                                                class="form-control @error('syubah') is-invalid @enderror">
                                                <option selected disabled>-- Pilih Syubah --</option>
                                                <option value="AshShidiqqin"
                                                    {{ $user->syubah == 'AshShidiqqin' ? 'selected' : '' }}>AshShidiqqin
                                                </option>
                                                <option value="AsySyuhada"
                                                    {{ $user->syubah == 'AsySyuhada' ? 'selected' : '' }}>AsySyuhada
                                                </option>
                                                <option value="AshSholihin"
                                                    {{ $user->syubah == 'AshSholihin' ? 'selected' : '' }}>AshSholihin
                                                </option>
                                                <option value="AlMutaqien"
                                                    {{ $user->syubah == 'AlMutaqien' ? 'selected' : '' }}>AlMutaqien
                                                </option>
                                                <option value="AlMuhsinin"
                                                    {{ $user->syubah == 'AlMuhsinin' ? 'selected' : '' }}>AlMuhsinin
                                                </option>
                                                <option value="AshShobirin"
                                                    {{ $user->syubah == 'AshShobirin' ? 'selected' : '' }}>AshShobirin
                                                </option>
                                            </select>
                                            @error('syubah')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                                <option selected disabled>-- Pilih Role --</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="jamiah" {{ $user->role == 'jamiah' ? 'selected' : '' }}>
                                                    Jamiah</option>
                                                <option value="syubah" {{ $user->role == 'syubah' ? 'selected' : '' }}>
                                                    Syubah</option>
                                                <option value="mudir" {{ $user->role == 'mudir' ? 'selected' : '' }}>Mudir
                                                </option>
                                            </select>
                                            @error('role')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="password" id="state" name="password"
                                                placeholder="Masukan Pasword" />
                                            <label for="state">Masukan Password</label>
                                            @error('password')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" class="form-control" id="zipCode"
                                                name="password_confirmation" placeholder="Konfirmasi Pasword" />
                                            <label for="zipCode">Konfirmasi Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3">Edit User</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
