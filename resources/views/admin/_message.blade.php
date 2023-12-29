@if (!empty(session('error')))
    <div class="alert alert-danger mb-xl-0" role="alert">
        <strong> Có lỗi xảy ra! </strong> {{ session('error') }}!
    </div>
@endif
@if (!empty(session('success')))
    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
        <i class="ri-check-double-line label-icon"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
