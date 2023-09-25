<style>
    .editsite{

        cursor: pointer;
    }
    td{
        font-size: 11px;
        vertical-align: middle

    }
    th{
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
    <div class="row">
    
    </div>
    
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
            addProduct();
            switchProd();
        });

        function addProduct() {
            $("#addProductBtn").click(function(e) {
                var file = [];
                e.preventDefault();
                $("#productModal").modal('show');
                
            });
        }

        
    </script>
@endsection
