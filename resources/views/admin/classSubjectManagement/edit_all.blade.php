@extends('layouts.app')
@section('title')
    Cập nhật phân công môn học
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
                                <form action="{{ route('admin.classSubjectManagement.updates', $oneClassSubject->school_class_id) }}"
                                    method="POST" class="row g-3">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Tên lớp</label>
                                        <input type="text" class="form-control" disabled value="{{$oneClassSubject->nameClass}}">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputState" class="form-label">Tên môn</label>
                                        <div class="row">
                                            @if (!empty($data['getSchoolSubject']))
                                                @foreach ($data['getSchoolSubject'] as $schoolSubject)
                                                    <div class="col-md-2 mb-3">
                                                        <div class="form-check">
                                                            @php
                                                                $subjectAssigned = $classSubjectsInClass->contains('subjectId', $schoolSubject->id);
                                                            @endphp

                                                            <input class="form-check-input" name="school_subject_id[]"
                                                                type="checkbox" value="{{ $schoolSubject->id }}"
                                                                {{ $subjectAssigned ? 'checked' : '' }}
                                                                id="subject{{ $schoolSubject->id }}">

                                                            <label class="form-check-label"
                                                                for="subject{{ $schoolSubject->id }}">
                                                                {{ $schoolSubject->name }}
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
                                                {{ $oneClassSubject->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="2"
                                                {{ $oneClassSubject->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive
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
