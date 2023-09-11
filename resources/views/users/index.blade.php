{{-- Kế thừa  extend --}}
<link rel="stylesheet" href="/dashboard/css/styleUser.css">
@extends('layout.layout')
@section('menunav')
    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
            <a href="#" class="nav-link" id="themLTKBtn">Thêm</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" id="themTaiKhoanBtn">Thêm tài khoản</a>
        </li>
    </ul>
@endsection
@section('main')
    <div class="modal fade" id="LoaiTaiKhoanModal" tabindex="-1" aria-labelledby="LoaiTaiKhoanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="LoaiTaiKhoanModalLabel">Loại tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="tenLoaiTaiKhoan" placeholder="Loại tài khoản">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitLoaiTaiKhoan">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="TaiKhoanModal" tabindex="-1" aria-labelledby="TaiKhoanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TaiKhoanModalLabel">Modal Tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" placeholder="Username" id="username" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="text" placeholder="Email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <select name="" id="idRole" class="form-control">
                                @foreach ($userroles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitUserBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="ModalThayDoiEmail" tabindex="-1" aria-labelledby="ModalThayDoiEmailLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalThayDoiEmailLabel">Thay đổi email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="emailconvert" placeholder="Email mới" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateEmailBtn">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
    {{-- ===================== --}}
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                @foreach ($userroles as $key => $item)
                    @if ($key == 0)
                        <li class="list-group-item active " data-id="{{ $item->id }}">
                            <div class="row ">
                                <div class="col-md-6 editUserRole ">
                                    {{ $item->name }}
                                </div>
                                <div class="col-md">
                                    <button class="xoaLTK btn btn-danger" data-id="{{ $item->id }}">Xóa</button>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="list-group-item " data-id="{{ $item->id }}">
                            <div class="row">
                                <div class="col-md-6 editUserRole">
                                    {{ $item->name }}
                                </div>
                                <div class="col-md">
                                    <button class="xoaLTK btn btn-danger" data-id="{{ $item->id }}">Xóa</button>
                                </div>
                            </div>

                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-md">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên tài khoản</th>
                            <th scope="col">Email</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tùy chỉnh</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                            <tr class="">
                                <td scope="row">{{ ++$key }}</td>
                                <td><b class="pointer">{{ $item->name }}</b></td>
                                <td><b class="pointer emailchange" data-id='{{ $item->id }}'
                                        data-value="{{ $item->email }}">{{ $item->email }}</b></td>
                                <td><?php
                                if($item->status==1){?>
                                    <b class="pointer switchbtn" style="cursor: pointer;"
                                        data-id='{{ $item->id }}'>Đang mở</b>
                                    <?php  }else{ ?>
                                    <b class="pointer switchbtn" data-id='{{ $item->id }}'>Đang đóng</b>
                                    <?php }
                            ?>
                                </td>
                                <td>
                                    {{ date('d/m/20y', strtotime($item->created_at)) }}
                                </td>
                                <td>
                                    <button class="btn btn-danger deleteUserbtn"
                                        data-id='{{ $item->id }}'>Xóa</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter',
                        Swal
                        .stopTimer)
                    toast.addEventListener('mouseleave',
                        Swal
                        .resumeTimer)
                }
            })
            ThemLoaiTaiKhoan();
            editLoaiTaiKhoan();
            deleteUserRole();
            themTaiKhoan();
            SwitchUser();
            ThayDoiEMail();
            deleteUser();
        });

        function deleteUser() {
            $(".deleteUserbtn").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    text: 'Xóa tài khoản ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng ',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/deleteUser",
                            data: {id:id},
                            dataType: "JSON",
                            success: function (res) {
                                if(res.check==true){
                                    Toast.fire({
                            icon: 'success',
                            title: 'Xóa thành công'
                        }).then(()=>{
                            window.location.reload()
                        })
                                }else if(res.check==false){
                                    if(res.msg.id){
                                        Toast.fire({
                            icon: 'error',
                            title: res.msg.id
                        })
                                    }
                                }
                            }
                        });
                    } else if (result.isDenied) {
                    }
                })
            });
        }
        // ===================================
        function ThayDoiEMail() {
            $(".emailchange").click(function(e) {
                e.preventDefault();
                var old = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $("#emailconvert").val(old);
                $("#ModalThayDoiEmail").modal('show');
                $("#updateEmailBtn").click(function(e) {
                    e.preventDefault();
                    var email = $("#emailconvert").val();
                    if (email == old) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Chưa cập nhật email'
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/doiEmail",
                            data: {
                                id: id,
                                email: email
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Cập nhật thành công'
                                    })
                                } else if (res.check == false) {
                                    if (res.msg.id) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.id
                                        })
                                    } else if (res.msg.email) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.email
                                        })
                                    }
                                }
                            }
                        });
                    }
                });
            });
        }
        // ===================================
        function SwitchUser() {
            $(".switchbtn").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon: 'question',
                    text: 'Thay đổi trạng thái tài khoản ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/switchUser",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                            icon: 'success',
                                            title: 'Đã thay đổi thành công'
                                        })
                                        .then(() => {
                                            window.location.reload();
                                        })
                                } else if (res.check == false) {
                                    if (res.msg.id) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.id
                                        })
                                    }
                                }
                            }
                        });
                    } else if (result.isDenied) {}
                })
            });
        }
        // ====================================
        function themTaiKhoan() {
            $("#themTaiKhoanBtn").click(function(e) {
                e.preventDefault();
                $("#TaiKhoanModal").modal('show');
                $("#submitUserBtn").click(function(e) {
                    e.preventDefault();
                    var username = $("#username").val().trim();
                    var email = $("#email").val().trim();
                    var idRole = $("#idRole option:selected").val();
                    if (username == '') {

                        Toast.fire({
                            icon: 'error',
                            title: 'Thiếu username'
                        })
                    } else if (email == '') {
                        Toast.fire({
                            icon: 'error',
                            title: 'Thiếu email'
                        })
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter',
                                    Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave',
                                    Swal
                                    .resumeTimer)
                            }
                        })
                        $.ajax({
                            type: "post",
                            url: "/createUser",
                            data: {
                                username: username,
                                email: email,
                                idRole: idRole
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã thêm thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                } else if (res.check == false) {
                                    console.log(res);
                                    if (res.msg.username) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.username
                                        })
                                    } else if (res.msg.idRole) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.idRole
                                        })
                                    } else if (res.msg.email) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.email
                                        })
                                    }
                                }
                            }
                        });
                    }
                });
            });
        }
        // ==================================
        function deleteUserRole() {
            $(".xoaLTK").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon: 'question',
                    text: 'Có xóa không ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/deleteLoaiTaiKhoan",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal
                                                .stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal
                                                .resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã xóa thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.msg.id) {
                                    $("#submitLoaiTaiKhoan").attr('disabled', false);

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1700,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal
                                                .stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal
                                                .resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.id
                                    })
                                }
                            }
                        });
                    } else if (result.isDenied) {}
                })
            });
        }
        // ==================================

        function editLoaiTaiKhoan() {
            $('.editUserRole').click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var old = $(this).text().trim();
                // Trim :Lọc khoảng trắng dư ở đầu và cuối chuỗi
                $("#tenLoaiTaiKhoan").val(old);
                $("#LoaiTaiKhoanModal").modal('show');
                $('#submitLoaiTaiKhoan').click(function(e) {
                    e.preventDefault();
                    var name = $("#tenLoaiTaiKhoan").val().trim();
                    if (name == old) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter',
                                    Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave',
                                    Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Tên loại chưa được thay đổi'
                        })
                    } else {
                        $("#submitLoaiTaiKhoan").attr('disabled', 'disabled');
                        $.ajax({
                            type: "post",
                            url: "/editLoaiTaiKhoan",
                            data: {
                                id: id,
                                tenLoai: name
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal
                                                .stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal
                                                .resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã sửa thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.msg.tenLoai) {
                                    $("#submitLoaiTaiKhoan").attr('disabled', false);

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1700,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal
                                                .stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal
                                                .resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.tenLoai
                                    })
                                } else if (res.msg.id) {
                                    $("#submitLoaiTaiKhoan").attr('disabled', false);

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1700,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal
                                                .stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal
                                                .resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.id
                                    })
                                }
                            }
                        });
                    };
                });
            })
        }
        // ==================================
        function ThemLoaiTaiKhoan() {
            $("#themLTKBtn").click(function(e) {
                e.preventDefault();
                $("#LoaiTaiKhoanModal").modal('show');
                $("#submitLoaiTaiKhoan").click(function(e) {
                    e.preventDefault();
                    var tenLoai = $("#tenLoaiTaiKhoan").val().trim();
                    $.ajax({
                        type: "post",
                        url: "/addLoaiTaiKhoan",
                        data: {
                            tenLoai: tenLoai
                        },
                        dataType: "JSON",
                        success: function(res) {
                            if (res.check == true) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Đã thêm thành công'
                                }).then(() => {
                                    window.location.reload();
                                })
                            }
                            if (res.msg.tenLoai) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1700,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: res.msg.tenLoai
                                })
                            }
                        }
                    });
                    // if (tenLoai == '') {
                    //     const Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         showConfirmButton: false,
                    //         timer: 3000,
                    //         timerProgressBar: true,
                    //         didOpen: (toast) => {
                    //             toast.addEventListener('mouseenter', Swal.stopTimer)
                    //             toast.addEventListener('mouseleave', Swal.resumeTimer)
                    //         }
                    //     })

                    //     Toast.fire({
                    //         icon: 'warning',
                    //         title: 'Thiếu tên loại tài khoản'
                    //     })
                    // } else {

                    // }
                });
            });
        }
    </script>
@endsection
