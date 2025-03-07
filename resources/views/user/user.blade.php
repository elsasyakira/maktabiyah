@extends('partials.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <!-- Data Tables -->
            <div class="col-12">
                <div class="card overflow-hidden">
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
                                                    <a class="dropdown-item" href=""><i
                                                            class="ri-delete-bin-6-line me-1"></i> Delete</a>
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
@endsection
