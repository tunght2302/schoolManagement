@extends('layouts.app')
@section('title')
    Loại môn học
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0">Cập nhật loại môn học</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Loại môn học</a></li>
                                    <li class="breadcrumb-item active">Cập nhật loại môn học</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="col-xxl-12">
                    @include('notifications._message_error')
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('admin.schoolSubjectTypeManagement.update', $oneSchoolSubjectType->id) }}"
                                    method="POST" class="row g-3">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-12">
                                        <label for="fullnameInput" class="form-label">Loại môn học</label>
                                        <input type="text" name="name" class="form-control" id="fullnameInput"
                                            value="{{ old('name', $oneSchoolSubjectType->name) }}" placeholder="Nhập loại môn học">
                                    </div>
                                    <div class="col-12">
                                        <div class="text-end">
                                            <a href="{{route('admin.schoolSubjectTypeManagement.index')}}" class="btn btn-success">Quay lại</a>
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
