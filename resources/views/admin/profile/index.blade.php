@extends('layouts.app')
@section('title')
    Hồ sơ của tôi
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid card">
                <div class="row">
                    <div class="pt-4 mb-4 mb-lg-3 col-lg-4 pb-lg-4 profile-wrapper ">
                        <div class="row g-4 card-body">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="{{ asset($getUser->image) }}" alt="user-img"
                                        class="img-thumbnail rounded-circle" />
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col">
                                <div class="p-2">
                                    <h3 class="mb-1">{{ $getUser->name }}</h3>
                                    <p class="text-muted">Chức vụ:{{$getUser->roleName}}</p>
                                </div>
                            </div>
                            <div class="d-flex profile-wrapper">
                                <!-- Nav tabs -->
                                <div class="flex-shrink-0">
                                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-success"><i
                                            class="ri-edit-box-line align-bottom"></i>Chỉnh sửa hồ sơ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div>
                            <!-- Tab panes -->
                            <div class="tab-content pt-4 text-muted">
                                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                    <div class="row">
                                        <div>
                                            <div>
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">Thông tin cá nhân</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Họ tên:</th>
                                                                    <td class="text-muted">{{ $getUser->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Số điện thoại :</th>
                                                                    <td class="text-muted">{{ $getUser->phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">E-mail :</th>
                                                                    <td class="text-muted">{{ $getUser->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Địa chỉ :</th>
                                                                    <td class="text-muted">{{ $getUser->address }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <!--end tab-content-->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div><!-- end main content-->
@endsection
