@extends('layouts.app')
@section('title')
    Phân công môn học
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                            <h4 class="mb-sm-0">Cập nhật phân công môn học</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="">Phân công môn học</a></li>
                                    <li class="breadcrumb-item active">Cập nhật phân công môn học</li>
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
                                <form action="{{ route('admin.classSubjectManagement.update', $singleClassSubject->id) }}"
                                    method="POST" class="row g-3">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Tên lớp</label>
                                        <select name="school_class_id" class="form-select">
                                            @foreach ($data['getSchoolClass'] as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('school_class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Tên môn</label>
                                        <div class="row">
                                            @if (!empty($data['getSchoolSubject']))
                                                @foreach ($data['getSchoolSubject'] as $subject)
                                                    <div class="col-md-2 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="school_subject_id"
                                                                type="checkbox" value="{{ $subject->id }}"
                                                                {{ old('school_subject_id', $singleClassSubject->school_subject_id) == $subject->id ? 'checked' : '' }}
                                                                id="subject{{ $subject->id }}"
                                                                onchange="limitCheckbox(this)">

                                                            <label class="form-check-label"
                                                                for="subject{{ $subject->id }}">
                                                                {{ $subject->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Không có môn học nào.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Trạng thái</label>
                                        <select class="form-select mb-3" name="status">
                                            <option value="1"
                                                {{ $singleClassSubject->status == 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2"
                                                {{ $singleClassSubject->status == 'inactive' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="text-end">
                                            <a href="{{ route('admin.classSubjectManagement.index') }}"
                                                class="btn btn-success">Quay lại</a>
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
