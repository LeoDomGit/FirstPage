<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="password" placeholder="Mật khẩu">

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-primary" id="loginBtn">Đăng nhập</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#loginBtn").click(function (e) { 
                e.preventDefault();
                var username=$("#username").val().trim();
                var password=$("#password").val().trim();
                if(username==''||password==''){
                    alert("Thiếu tên đăng nhập hoặc mật khẩu")
                }else{
                    $.ajax({
                        type: "POST",
                        url: "/checkLogin",
                        data: {
                            username:username,
                            password:password,
                        },
                        dataType: "JSON",
                        success: function (res) {
                            console.log(res);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>