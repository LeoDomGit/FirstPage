<style>
    .editsite {

        cursor: pointer;
    }

    td {
        font-size: 11px;
        vertical-align: middle
    }

    th {
        font-size: 12px;
        text-align: center
    }
</style>
@extends('layout.layout')
@section('menunav')
    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        {{-- <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#"></a>
    </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="#" id="addProductBtn">Thêm</a>
        </li>
    </ul>
@endsection
@section('main')
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Modal Sản Phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Tên sản phẩm" id="name">
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="quantity" min="0"
                                placeholder="Số lượng">
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="price" placeholder="Giá" min="0">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="discount" min='0' max='50'
                                placeholder="Giảm giá">
                        </div>
                        <div class="col-md-3">
                            <select name="" id="idBrand" class="form-control">
                                @foreach ($brands as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="" id="idCate" class="form-control">
                                @foreach ($cates as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="file" name="" multiple id="file">
                        </div>
                    </div>
                    <div class="row mt-3 w-100">
                        <div class="col">
                            <textarea name="" id="content" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3" id="resultimage">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitProductBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    @if (count($products) > 0)
        <div class="row mt-3">
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Giảm giá</th>
                                <th scope="col">Thương hiệu</th>
                                <th scope="col">Loại sản phẩm</th>
                                <th scope="col">Tùy chỉnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                            <tr class="">
                                <td scope="row">{{++$key}}</td>
                                <td>
                                    {{-- <img style="height:80px; width:auto" src="{{ URL::to('/') }}/images/{{$item->images}}" alt=""> --}}
                                    {{-- <img style="height:80px; width:auto" src="{{$url.$item->images}}" alt=""> --}}
                                    <img style="height:80px; width:auto" src="{{url('/images/'.$item->images)}}" alt="">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{number_format($item->price *(100-$item->discount)/100)}}</td>
                                <td>{{$item->brandname}}</td>
                                <td>{{$item->catename}}</td>
                                <td>
                                    <button class="btn btn-warning editBtn" data-id="{{$item->id}}">Sửa</button>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif




    <script src="/dashboard/js/ckeditor/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        var ckeditor = CKEDITOR.replace('content', options);
        ckeditor.config.height = 300;
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1700,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            addProduct();
            editProduct();
            // switchProd();
        });
        function editProduct(){
            $(".editBtn").click(function (e) { 
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "/products/edit",
                    data: {id:id},
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res.product);
                        const product= res.product[0];
                        $("#name").val(product.name);
                        $("#quantity").val(product.quantity);
                        $("#price").val(product.price);
                        $("#discount").val(product.discount);
                        $("#idBrand").val(product.idBrand);
                        $("#idCate").val(product.idCate);
                        CKEDITOR.instances['content'].setData(product.content);
                        $("#productModal").modal('show');
                        submitEditProduct();
                    }
                });
            });
        }
        function submitEditProduct(){
            
        }


        function addProduct() {
            $("#addProductBtn").click(function(e) {
                var file = [];
                e.preventDefault();
                $("#productModal").modal('show');
                $("#submitProductBtn").click(function(e) {
                    e.preventDefault();
                    var name = $("#name").val().trim();
                    var price = $("#price").val().trim();
                    var quantity = $("#quantity").val().trim();
                    var discount = $("#discount").val().trim();
                    var idBrand = $("#idBrand option:selected").val();
                    var idCate = $("#idCate option:selected").val();
                    var file = $("#file")[0].files;

                    var content = CKEDITOR.instances.content.getData();
                    if (file == undefined) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Thiếu hình ảnh sản phẩm'
                        })
                    } else {
                        var formData = new FormData();

                        formData.append('name', name);
                        formData.append('price', price);
                        formData.append('quantity', quantity);
                        formData.append('discount', discount);
                        formData.append('idBrand', idBrand);
                        formData.append('idCate', idCate);
                        formData.append('file', file[0]);
                        formData.append('content', content);
                        $.ajax({
                            type: "post",
                            url: "/products",
                            data: formData,
                            contentType: false,
                            processData: false,
                            cache: false,
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Thêm sản phẩm thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.image) {
                                    Swal.fire({
                                        text: 'Muốn thay thế hình ảnh trùng tên ?',
                                        showDenyButton: true,
                                        showCancelButton: false,
                                        confirmButtonText: 'Đúng',
                                        denyButtonText: `Không`,
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            formData.append('replace', 1);
                                            $.ajax({
                                                type: "post",
                                                url: "/products",
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                cache: false,
                                                dataType: "JSON",
                                                success: function(res) {
                                                    if (res.check == true) {
                                                        Toast.fire({
                                                            icon: 'success',
                                                            title: 'Thêm sản phẩm thành công'
                                                        }).then(() => {
                                                            window
                                                                .location
                                                                .reload();
                                                        })
                                                    }
                                                    if (res.image) {
                                                        Swal.fire({
                                                            text: 'Muốn thay thế hình ảnh trùng tên ?',
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: 'Đúng',
                                                            denyButtonText: `Không`,
                                                        }).then((
                                                                result
                                                                ) => {
                                                                /* Read more about isConfirmed, isDenied below */
                                                                if (result
                                                                    .isConfirmed
                                                                ) {
                                                                    Swal.fire(
                                                                        'Saved!',
                                                                        '',
                                                                        'success'
                                                                    )
                                                                } else if (
                                                                    result
                                                                    .isDenied
                                                                ) {}
                                                            })
                                                    } else if (res.msg
                                                        .name) {
                                                        Toast.fire({
                                                            icon: 'error',
                                                            title: res
                                                                .msg
                                                                .name
                                                        })
                                                    } else if (res.msg
                                                        .quantity) {
                                                        Toast.fire({
                                                            icon: 'error',
                                                            title: res
                                                                .msg
                                                                .quantity
                                                        })
                                                    } else if (res.msg
                                                        .price) {
                                                        Toast.fire({
                                                            icon: 'error',
                                                            title: res
                                                                .msg
                                                                .price
                                                        })
                                                    } else if (res.msg
                                                        .discount) {
                                                        Toast.fire({
                                                            icon: 'error',
                                                            title: res
                                                                .msg
                                                                .discount
                                                        })
                                                    } else if (res.msg
                                                        .content) {
                                                        Toast.fire({
                                                            icon: 'error',
                                                            title: res
                                                                .msg
                                                                .content
                                                        })
                                                    } else if (res.msg) {
                                                        Toast.fire({
                                                            icon: 'error',
                                                            title: res
                                                                .msg
                                                        })

                                                    }
                                                }
                                            });
                                        } else if (result.isDenied) {}
                                    })
                                } else if (res.msg.name) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.name
                                    })
                                } else if (res.msg.quantity) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.quantity
                                    })
                                } else if (res.msg.price) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.price
                                    })
                                } else if (res.msg.discount) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.discount
                                    })
                                } else if (res.msg.content) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.content
                                    })
                                } else if (res.msg) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg
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
