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
        });

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
