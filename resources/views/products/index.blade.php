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
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>
                                        {{-- <img style="height:80px; width:auto" src="{{ URL::to('/') }}/images/{{$item->images}}" alt=""> --}}
                                        {{-- <img style="height:80px; width:auto" src="{{$url.$item->images}}" alt=""> --}}
                                        <img style="height:80px; width:auto" src="{{ url('/images/' . $item->images) }}"
                                            alt="">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price) }}</td>
                                    <td>{{ number_format(($item->price * (100 - $item->discount)) / 100) }}</td>
                                    <td>{{ $item->brandname }}</td>
                                    <td>{{ $item->catename }}</td>
                                    <td>
                                        <button class="btn btn-warning editBtn" data-id="{{ $item->id }}">Sửa</button>
                                        <button class="btn btn-danger deleteBtn" data-id="{{ $item->id }}">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <br>
                @if ($products->lastPage()>1)
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if (isset($_GET['page'])&&$_GET['page']>1)
                        <li class="page-item"><a class="page-link" href="?page=<?=($_GET['page']-1)?>">Previous</a></li>
    
                        @else
                        <li class="page-item"><a class="page-link" href="?page=1">Previous</a></li>
    
                        @endif
                      <?php $i=1;?>
                      @while ($i<$products->lastPage()+1)
                      <li class="page-item"><a class="page-link" href="?page={{$i}}">{{$i}}</a></li>
                      <?php $i++?>                      
                      @endwhile
                      @if (isset($_GET['page'])&&$_GET['page']<$products->lastPage())
                        <li class="page-item"><a class="page-link" href="?page=<?=($_GET['page']+1)?>">Next</a></li>
                      @else
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    
                      @endif
                    </ul>
                  </nav>
                @endif
 
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
            deleteProduct();
        });

        function deleteProduct() {
            $(".deleteBtn").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon: 'question',
                    text: 'Xóa sản phẩm?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/products/deleteProduct",
                            data: {
                                id: id,
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã xóa thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.msg.id) {
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
        // ===============================
        function editProduct() {
            $(".editBtn").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "/products/edit",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res.product);
                        const product = res.product[0];
                        $("#name").val(product.name);
                        $("#quantity").val(product.quantity);
                        $("#price").val(product.price);
                        $("#discount").val(product.discount);
                        $("#idBrand").val(product.idBrand);
                        $("#idCate").val(product.idCate);
                        CKEDITOR.instances['content'].setData(product.content);
                        $("#productModal").modal('show');
                        submitEditProduct(id);
                    }
                });
            });
        }

        function submitEditProduct(id) {
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
                if (name == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Thiếu tên sản phẩm'
                    })
                } else if (price == '' || price <= 0) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Giá sản phẩm không hợp lệ'
                    })
                } else if (quantity == '' || quantity <= 0) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Số lượng sản phẩm không hợp lệ'
                    })
                } else if (discount < 0 || discount > 100) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Giảm giá không hợp lệ'
                    })
                } else if (content == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'Thiếu nội dung sản phẩm'
                    })
                } else if (file.length == 0) {
                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('price', price);
                    formData.append('quantity', quantity);
                    formData.append('discount', discount);
                    formData.append('idBrand', idBrand);
                    formData.append('idCate', idCate);
                    formData.append('content', content);
                    formData.append('id', id);
                    $.ajax({
                        type: "post",
                        url: "/products/editProduct",
                        data: formData,
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "JSON",
                        success: function(res) {
                            if (res.check == true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Sửa sản phẩm thành công'
                                }).then(() => {
                                    window.location.reload();
                                })
                            }
                        }
                    });

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
                    formData.append('id', id);
                    $.ajax({
                        type: "post",
                        url: "/products/editProduct",
                        data: formData,
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "JSON",
                        success: function(res) {
                            if (res.check == true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Sửa sản phẩm thành công'
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
                                            url: "/products/editProduct",
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            cache: false,
                                            dataType: "JSON",
                                            success: function(res) {
                                                if (res.check == true) {
                                                    Toast.fire({
                                                        icon: 'success',
                                                        title: 'Sửa sản phẩm thành công'
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
