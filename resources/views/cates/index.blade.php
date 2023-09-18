<style>
    .pointer {
        cursor: pointer;
    }
</style>
@extends('layout.layout')
@section('menunav')
    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
            <a href="#" class="nav-link" id="themLSPBtn">Thêm</a>
        </li>
    </ul>
@endsection
@section('main')
    <!-- Modal -->
    <div class="modal fade" id="loaiSPModal" tabindex="-1" aria-labelledby="loaiSPModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loaiSPModalLabel">Loại sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Loại sản phẩm" id="cateIpt" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitLSPBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên loại</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($cates) && count($cates) > 0)
                            @foreach ($cates as $key => $item)
                                <tr class="">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td><span class="pointer editCateName" data-value="{{ $item->name }}"
                                            data-id="{{ $item->id }}">{{ $item->name }}</span></td>
                                    <td>
                                        @if ($item->status == 0 && $item->deleted_at == null)
                                            <b class="pointer switchCate" data-id="{{ $item->id }}">Đang khóa</b>
                                        @else
                                            @if ($item->deleted_at != null)
                                                <b class="pointer restoreCate" data-id="{{ $item->id }}">Đã xóa</b>
                                            @else
                                                <b class="pointer switchCate" data-id="{{ $item->id }}">Đang mở</b>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/20y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-danger xoaLSPBtn" data-id="{{ $item->id }}">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif

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
            addLoaiSP();
            editLoaiSP();
            xoaLoaiSP();
            restoreLoaiSP();
        });

        function restoreLoaiSP() {
            $(".restoreCate").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon:'question',
                    text: 'Khôi phục loại sản phẩm ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/khoi-phuc-loaisp",
                            data: {
                                id:id
                            },
                            dataType: "JSON",
                            success: function (res) {
                                if(res.check==true){
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã khôi phục'
                                    }).then(()=>{
                                        window.location.reload();
                                    })
                                }
                                if(res.msg.id){
                                    Toast.fire({
                                        icon: 'success',
                                        title: res.msg.id
                                    })
                                }
                            }
                        });
                    } else if (result.isDenied) {
                    }
                })
            });
        }

        function xoaLoaiSP() {
            $(".xoaLSPBtn").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon: 'question',
                    text: 'Xóa loại sản phẩm ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/xoa-loai-sp",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Xóa thành công'
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

        function editLoaiSP() {
            $(".editCateName").click(function(e) {
                e.preventDefault();
                var old = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $("#cateIpt").val(old);
                $("#loaiSPModal").modal('show');
                $("#submitLSPBtn").click(function(e) {
                    e.preventDefault();
                    var name = $("#cateIpt").val().trim();
                    if (name == '') {
                        Toast.fire({
                            icon: 'error',
                            title: "Tên loại sản phẩm chưa được nhập"
                        })
                    } else if (name == old) {
                        Toast.fire({
                            icon: 'error',
                            title: "Tên loại sản phẩm chưa thay đổi"
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/sua-loai-sp",
                            data: {
                                id: id,
                                name: name
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Sửa thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.check == false) {
                                    if (res.msg.name) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.name
                                        })
                                    } else if (res.msg.id) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.id
                                        })
                                    }
                                }
                            }
                        });
                    }
                });
            });
        }

        function addLoaiSP() {
            $("#themLSPBtn").click(function(e) {
                e.preventDefault();
                $("#loaiSPModal").modal('show');
                $("#submitLSPBtn").click(function(e) {
                    e.preventDefault();
                    var name = $("#cateIpt").val().trim();
                    if (name == '') {
                        Toast.fire({
                            icon: 'error',
                            title: "Tên loại sản phẩm chưa được nhập"
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/loai-sp",
                            data: {
                                name: name
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Thêm thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.check == false) {
                                    if (res.msg.name) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.name
                                        })
                                    }
                                }
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection
