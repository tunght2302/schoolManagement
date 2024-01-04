@extends('layouts.app')
@section('title')
    Thêm mới phân công môn học
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0">Thêm mới phân công môn học</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Phân công môn học</a></li>
                                    <li class="breadcrumb-item active">Thêm mới phân công môn học</li>
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
                                <form action="{{ route('admin.classSubjectManagement.store') }}" method="POST"
                                    class="row g-3">
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Tên lớp</label>
                                        <select class="form-select mb-3" name="school_class_id">
                                            <option value="" selected>Chọn lớp</option>
                                            @foreach ($data['getSchoolClass'] as $schoolClass)
                                                <option value="{{ $schoolClass->id }}"
                                                    {{ old('school_class_id') == $schoolClass->id ? 'selected' : '' }}>
                                                    {{ $schoolClass->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Tên môn</label>
                                        <div class="row">
                                            @foreach ($data['getSchoolSubject'] as $schoolSubject)
                                                <div class="col-md-2 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="school_subject_id[]"
                                                            type="checkbox" value="{{ $schoolSubject->id }}"
                                                            id="subject{{ $schoolSubject->id }}"
                                                            {{ in_array($schoolSubject->id, old('school_subject_id', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="subject{{ $schoolSubject->id }}">
                                                            {{ $schoolSubject->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Trạng thái</label>
                                        <select class="form-select mb-3" name="status">
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
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
