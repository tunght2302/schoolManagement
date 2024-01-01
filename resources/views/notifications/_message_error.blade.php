@if (!empty(session('error')))
    <div class="alert alert-danger mb-xl-0" role="alert">
        <strong> Có lỗi xảy ra! </strong> {{ session('error') }}!
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mb-xl-0" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

