<style>
    .pointer {
        cursor: pointer;
    }
</style>
@extends('layout.layout')
@section('menunav')
    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
            <a href="#" class="nav-link" id="addBrandBtn">Thêm</a>
        </li>
    </ul>
@endsection
@section('main')
    <div class="modal fade" id="BrandModal" tabindex="-1" aria-labelledby="BrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BrandModalLabel">Chỉnh sửa thương hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Thương hiệu" id="brandname" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitBrandBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Thương hiệu</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($brands) > 0)
                        @foreach ($brands as $key => $item)
                            @if ($key % 2 == 0)
                                <tr class="table-warning">
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><span class="editBrand editsite"
                                            data-id="{{ $item->id }}"data-value="{{ $item->name }}">{{ $item->name }}</span>
                                    </td>
                                    <td>
                                        @if ($item->status == 0)
                                            <b class="editsite switchBrand"data-id="{{ $item->id }}">Đang tắt</b>
                                        @else
                                            <b class="editsite switchBrand" data-id="{{ $item->id }}">Đang mở</b>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('d/m/20y', strtotime($item->created_at)) }}
                                    </td>
                                </tr>
                            @else
                                <tr class="table-secondary">
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><span class="editBrand editsite" data-id="{{ $item->id }}"
                                            data-value="{{ $item->name }}">{{ $item->name }}</span></td>
                                    <td>
                                        @if ($item->status == 0)
                                            <b class="editsite switchBrand"data-id="{{ $item->id }}">Đang tắt</b>
                                        @else
                                            <b class="editsite switchBrand" data-id="{{ $item->id }}">Đang mở</b>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d/m/20y', strtotime($item->created_at)) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <b>Chưa có thương hiệu sản phẩm</b>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
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
            addBrand();
            editBrand();
        });
        function editBrand() {
            $(".editBrand").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var old = $(this).attr('data-value');
                $("#brandname").val(old);
                $("#BrandModal").modal('show');
                $("#submitBrandBtn").click(function(e) {
                    e.preventDefault();
                    
                    var brandName = $("#brandname").val().trim();
                    if (brandName == '') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Thiếu tên loại'
                        })
                    } else if (brandName == old) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Tên loại chưa được thay đổi'
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "{{ route('products.editBrands') }}",
                            data: {
                                id: id,
                                name: brandName
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.check == true) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã chuyển thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (response.message.name) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message.catename
                                    })
                                }
                                if (response.message) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message
                                    })
                                }
                            }
                        });
                    }
                });
            });
            
        }
        function addBrand() {
            $('#addBrandBtn').click(function(e) {
                e.preventDefault();
                $("#BrandModal").modal('show');
                $("#submitBrandBtn").click(function(e) {
                    e.preventDefault();
                    var name = $("#brandname").val().trim();
                    if (name == '') {
                        Toast.fire({
                            icon: 'error',
                            title: 'Chưa thêm thương hiệu'
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/products/brands",
                            data: {
                                name: name
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
                                }
                                if (res.msg.name) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.name
                                    })
                                }
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection
