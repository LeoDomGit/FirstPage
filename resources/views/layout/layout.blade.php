<?php
use Illuminate\Support\Facades\Session;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="/dashboard/images/logos/favicon.png" />
    <link rel="stylesheet" href="/dashboard/css/styles.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                {{-- <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="#" class="text-nowrap logo-img">
                        @if (Session::has('image'))
                        <img src="{{Session::get('image')}}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div> --}}
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Tài khoản</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/users/" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Loại Tài Khoản</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Sản Phẩm</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/loai-sp" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Loại Sản Phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/products/brands" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Thương Hiệu</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/products/" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Sản Phẩm</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Bài viết</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/posts" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Bài viết</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Typography</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">EXTRA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Thông tin tài khoản </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if (Auth::user())
                                <input type="text" readonly placeholder="Username" id="usernameaccount"
                                    value="{{ Auth::user()->name }}"
                                    data-id="{{ Auth::id() }}"class="form-control mb-2">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" readonly placeholder="Username" id="apiToken"
                                            value="{{ Auth::user()->remember_token }}"
                                            data-id="{{ Auth::id() }}"class="form-control mb-2">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary w-100" id="copyAPIBtn">Copy</button>
                                    </div>
                                </div>
                                <input type="text" placeholder="Email" value="{{ Auth::user()->email }}"
                                    data-value="{{ Auth::user()->email }}" data-id="{{ Auth::id() }}"
                                    id="emailaccount" class="form-control mb-2">
                            @endif
                            <input type="password" placeholder="Mật khẩu mới" id="passwordaccount"
                                class="form-control mb-2">
                            <input type="password" placeholder="Nhập lại password" id="repasswordaccount"
                                class="form-control mb-2">
                            <button class="btn btn-secondary" id="changpassbtn">Đổi mật khẩu</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="updateUserBtn">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
            <!------------------------------------>
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <div class="w-100 row">
                            <div class="col-md-10">
                                @yield('menunav')
                            </div>
                            <div class="col-md-2">
                                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            @if (Session::has('image'))
                                                <img src="{{ Session::get('image') }}" alt="" width="35"
                                                    height="35" class="rounded-circle">
                                            @else
                                                <img src="/dashboard/images/profile/user-1.jpg" alt=""
                                                    width="35" height="35" class="rounded-circle">
                                            @endif

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                            aria-labelledby="drop2">
                                            <div class="message-body">
                                                <a href="javascript:void(0)" id="accountBtn"
                                                    class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-user fs-6"></i>
                                                    <p class="mb-0 fs-3">My Profile</p>
                                                </a>
                                                <!--<a href="javascript:void(0)"  class="d-flex align-items-center gap-2 dropdown-item">-->
                                                <!--  <i class="ti ti-mail fs-6"></i>-->
                                                <!--  <p class="mb-0 fs-3">My Account</p>-->
                                                <!--</a>-->
                                                <!--<a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">-->
                                                <!--  <i class="ti ti-list-check fs-6"></i>-->
                                                <!--  <p class="mb-0 fs-3">My Task</p>-->
                                                <!--</a>-->
                                                <a href="/logout"
                                                    class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                @yield('main')
            </div>
        </div>
    </div>

    <script src="/dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dashboard/js/sidebarmenu.js"></script>
    <script src="/dashboard/js/app.min.js"></script>
    <script src="/dashboard/js/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            changePassword()
        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        function changePassword() {
            $("#accountBtn").click(function(e) {
                e.preventDefault();
                $("#passwordaccount").hide();
                $("#repasswordaccount").hide();
                $("#userModal").modal('show');
                $('#updateUserBtn').click(function(e) {
                    e.preventDefault();
                    var email = $("#emailaccount").val().trim();
                    Swal.fire({
                        icon: 'question',
                        text: 'Cập nhật email tài khoản ?',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Đúng',
                        denyButtonText: `Không`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var id = $("#emailaccount").attr('data-id');
                            $.ajax({
                                type: "post",
                                url: "/doiEmail",
                                data: {
                                    email: email,
                                    id: id
                                },
                                dataType: "JSON",
                                success: function(res) {
                                    if (res.check == true) {
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Đã được cập nhật'
                                        }).then(() => {
                                            window.location.reload();
                                        })
                                    } else if (res.check == false) {
                                        if (res.msg.id) {
                                            Toast.fire({
                                                icon: 'error',
                                                title: res.msg.id
                                            })
                                        }else if(res.msg.email){
                                            Toast.fire({
                                                icon: 'error',
                                                title: res.msg.email
                                            })
                                        }
                                    }

                                }
                            });
                        } else if (result.isDenied) {}
                    })
                });
            });
        }
    </script>

</body>

</html>
