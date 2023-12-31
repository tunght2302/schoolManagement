@extends('layouts.app')
@section('title')
    Cập nhật Lớp học
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0">Cập nhật Lớp học</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý Admin</a></li>
                                    <li class="breadcrumb-item active">Cập nhật Lớp học</li>
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
                                <form action="{{ route('admin.schoolClassManagement.update', $oneSchoolClass->id) }}"
                                    method="POST" class="row g-3">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-12">
                                        <label for="fullnameInput" class="form-label">Tên lớp</label>
                                        <input type="text" name="name" class="form-control" id="fullnameInput"
                                            value="{{ old('name', $oneSchoolClass->name) }}" placeholder="Nhập họ tên">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Trạng thái</label>
                                        <select class="form-select mb-3" name="status">
                                            <option selected value="0">Trạng thái</option>
                                            <option value="1"
                                                {{ $oneSchoolClass->status === 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2"
                                                {{ $oneSchoolClass->status === 'inactive' ? 'selected' : '' }}>Inactive
                                            </option>
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
