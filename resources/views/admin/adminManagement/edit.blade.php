@extends('layouts.app')
@section('title')
    Cập nhật Admin
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0">Cập nhật Admin</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý Admin</a></li>
                                    <li class="breadcrumb-item active">Cập nhật Admin</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="col-xxl-12">
                    @include('admin._message_error')
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('admin.adminManagement.update', $oneUser->id) }}" method="POST"
                                    class="row g-3">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-6">
                                        <label for="fullnameInput" class="form-label">Họ Tên</label>
                                        <input type="text" name="name" class="form-control" id="fullnameInput"
                                            value="{{ old('name', $oneUser->name) }}"
                                            placeholder="Nhập họ tên">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4"
                                            value="{{ old('email', $oneUser->email) }}" placeholder="Nhập email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="password-input">Mật khẩu</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" name="password"
                                                value="{{ old('password', $oneUser->password) }}" placeholder="Nhập mật khẩu"
                                                id="password-input">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Chức vụ</label>
                                        <select class="form-select mb-3" name="role_id">
                                            <option selected value="0">Chưa có chức vụ</option>
                                            @foreach ($getRole as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $oneUser->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!--end row-->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    </div>
@endsection
