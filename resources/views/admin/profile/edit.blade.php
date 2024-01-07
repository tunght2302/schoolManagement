@extends('layouts.app')
@section('title')
    Hồ sơ của tôi
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0">Cập nhật hồ sơ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hồ sơ của tôi</a></li>
                                    <li class="breadcrumb-item active">Cập nhật hồ sơ</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @include('notifications._message_error')
                <div class="row mt-3">
                    <div class="col-xxl-8">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                            role="tab">
                                            <i class="fas fa-home"></i> Thông tin cá nhân
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="text-center">
                                                    <div
                                                        class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                        <img src="{{ asset($getUser->image) }}"
                                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                            alt="user-profile-image">
                                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                            <input id="profile-img-file-input" type="file" name="image"
                                                                class="profile-img-file-input">
                                                            <label for="profile-img-file-input"
                                                                class="profile-photo-edit avatar-xs">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-light text-body">
                                                                    <i class="ri-camera-fill"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <h5 class="fs-16 mb-1">{{ Auth::user()->name }}</h5>
                                                    <p class="text-muted mb-0">{{$getUser->roleName}}</p>
                                                </div>
                                                {{-- <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Ảnh</label>
                                                        <input type="file" class="form-control" id="firstnameInput"
                                                            name="image">
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Họ tên</label>
                                                        <input type="text" class="form-control" id="firstnameInput"
                                                            placeholder="Họ tên" name="name"
                                                            value="{{ $getUser->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="emailInput"
                                                            placeholder="Email" name="email"
                                                            value="{{ $getUser->email }}">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="addresssInput" class="form-label">Địa chỉ</label>
                                                        <input type="text" class="form-control" id="addressInput"
                                                            placeholder="Địa chỉ" name="address"
                                                            value="{{ $getUser->address }}">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Số điện
                                                            thoại</label>
                                                        <input type="text" class="form-control" id="phonenumberInput"
                                                            placeholder="Số điện thoại" name="phone"
                                                            value="0{{ $getUser->phone }}">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success">Cập nhật</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card col-xxl-4">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab">
                                        <i class="far fa-user"></i> Đổi mật khẩu
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile.changePassword') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row g-2">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">Mật khẩu
                                                cũ <span class="text-danger">*</span></label>
                                            <input type="password" name="oldPassword" class="form-control"
                                                id="oldpasswordInput" required placeholder="Mật khẩu cũ">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">Mật khẩu
                                                mới<span class="text-danger">*</span></label>
                                            <input type="password" name="newPassword" class="form-control"
                                                id="newpasswordInput" required placeholder="Mật khẩu mới">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Xác nhận mật
                                                khẩu<span class="text-danger">*</span></label>
                                            <input type="password" name="confirmPassword" class="form-control"
                                                id="confirmpasswordInput" required placeholder="Xác nhận mật khẩu">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <a href="{{ route('admin.auth.forgot-password') }}"
                                                class="link-primary text-decoration-underline">Quên mật
                                                khẩu?</a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                Đổi mật khẩu
                                            </button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!-- container-fluid -->
        </div><!-- End Page-content -->
    </div>
@endsection
