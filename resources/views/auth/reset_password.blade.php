<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Dec 2023 17:00:03 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Đặt lại mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <!-- Layout config Js -->
    <script src="{{asset('js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{asset('images/logo-light.png')}}" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Phần mềm quản lý trường học</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-4">
                                <div class="p-2 mt-4">
                                    @include('admin._message')
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mật khẩu mới</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" name="cpassword" id="password" placeholder="Nhập lại mật khẩu">
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Đặt lại mật khẩu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0"><a href="auth-signup-basic.html" class="fw-semibold text-primary text-decoration-underline"> Đăng nhập </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                2023 Velzon.Bản quyền thuộc về Mr.Tung
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>

    <!-- particles js -->
    <script src="{{asset('libs/particles.js')}}/particles.js')}}"></script>
    <!-- particles app js -->
    <script src="{{asset('js/pages/particles.app.js')}}"></script>
    <!-- password-addon init -->
    <script src="{{asset('js/pages/password-addon.init.js')}}"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Dec 2023 17:00:03 GMT -->
</html>
