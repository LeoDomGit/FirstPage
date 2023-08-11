{{-- Kế thừa  extend --}}
<link rel="stylesheet" href="/dashboard/css/styleUser.css">
@extends('layout.layout')
@section('menunav')
    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
            <a href="#" class="nav-link" id="themLTKBtn">Thêm</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Xóa</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Sửa</a>
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
    <div class="row">
        <div class="col-md-8">
            <ul class="list-group">
                @foreach ($userroles as $key => $item)
                    @if ($key == 0)
                        <li class="list-group-item active">{{ $item->name }}</li>
                    @else
                        <li class="list-group-item">{{ $item->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
                @foreach ($userroles as $key => $item)
                    @if ($key == 0)
                        <li class="list-group-item active">{{ $item->name }}</li>
                    @else
                        <li class="list-group-item">{{ $item->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            ThemLoaiTaiKhoan()
        });

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
