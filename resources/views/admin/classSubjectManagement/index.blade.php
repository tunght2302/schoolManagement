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
                            <h4 class="mb-sm-0">Danh sách phân công môn học</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="">Phân công môn học</a></li>
                                    <li class="breadcrumb-item active">Danh sách phân công môn học</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thêm,Sửa & Xoá</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{ route('admin.classSubjectManagement.create') }}"
                                                    class="btn btn-primary add-btn"><i
                                                        class="ri-add-line align-bottom me-1"></i>Phân công</a>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <form action="{{ route('admin.classSubjectManagement.search') }}"
                                                method="GET">
                                                @csrf
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="ms-2">
                                                        <input type="text" class="form-control search"
                                                            placeholder="Tìm kiếm..." name="searchName"
                                                            value="{{ Request::get('searchName') }}">
                                                    </div>
                                                    <div class="col-lg-sm mx-2">
                                                        <select class="form-select" name="searchClass"
                                                            aria-label=".form-select-sm example">
                                                            <option value="0"
                                                                {{ Request::get('searchClass') == 0 ? 'selected' : '' }}>
                                                                Lọc theo lớp</option>
                                                            @foreach ($data['getSchoolClass'] as $class)
                                                                <option value="{{ $class->id }}"
                                                                    {{ Request::get('searchClass') == $class->id ? 'selected' : '' }}>
                                                                    {{ $class->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-info mx-2">Tìm kiếm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                                value="option">
                                                        </div>
                                                    </th>
                                                    <th>Tên lớp</th>
                                                    <th>Tên môn</th>
                                                    <th>Trạng thái</th>
                                                    <th>Người tạo</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @if ($schoolClasses && count($schoolClasses) > 0)
                                                    @foreach ($schoolClasses as $classSubject)
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="chk_child" value="option1">
                                                                </div>
                                                            </th>
                                                            <td class="customer_name">{{ $classSubject->nameClass ?? '' }}
                                                            </td>
                                                            <td class="customer_name">
                                                                {{ $classSubject->nameSubject }}
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge  {{ $classSubject->status === 'active' ? 'bg-success' : 'text-white bg-danger' }} text-white text-uppercase">
                                                                    {{ $classSubject->status }}
                                                                </span>
                                                            </td>
                                                            <td class="customer_name">{{ $classSubject->creator->name }}
                                                            </td>
                                                            <td class="phone">
                                                                {{ date('d-m-Y H:i A', strtotime($classSubject->created_at)) }}
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <a href="{{ route('admin.classSubjectManagement.edit', $classSubject->id) }}"
                                                                            class="btn btn-info btn-icon waves-effect waves-light">
                                                                            <i class="bx bx-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="edit">
                                                                        <a href="{{ route('admin.classSubjectManagement.edits', $classSubject->school_class_id) }}"
                                                                            class="btn btn-success btn-icon waves-effect waves-light">
                                                                            <i class="bx bx-credit-card-front"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="remove">
                                                                        <a href="{{ route('admin.classSubjectManagement.destroy', $classSubject->id) }}"
                                                                            onclick="return confirm('Bạn chắc chắn muốn xoá!')"
                                                                            class="btn btn-danger btn-icon waves-effect waves-light">
                                                                            <i class="ri-delete-bin-5-line"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>Không có dữ liệu</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-sm-auto">
                                        <ul
                                            class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
                                            <li class="page-item">
                                                {{ $schoolClasses->links('pagination::bootstrap-4') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
