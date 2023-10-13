<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
     <div class="container-xl mt-5 p-4 rounded" style="box-sizing: border-box; box-shadow: 2px 2px 2px 2px grey;">
        <div class="row w-100">
            <div class="col-md-3">
                <img class="img-fluid" style="height: 100%;" src="https://media.istockphoto.com/id/1341408852/video/colored-smoke-on-a-dark-background-blue-and-red-light-with-smoke.jpg?s=640x640&k=20&c=v2DQUY8IVbli_6FH_9KAs6YWRXlDdYiBJHfp7JFh7NY=" alt="">
            </div>
            <div class="col-md">
                <div class="row">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" id="email" placeholder="Email" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                        <input type="password" class="form-control" aria-label="Sizing example input" id="password" placeholder="Mật khẩu" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <button class="btn btn-primary" id="submitDangNhap">Đăng nhập</button>
                    </div>
                </div>
                <div class="row">
                    <a class="btn btn-warning mt-3" href="/loginGoogle">Login Google</a>
                </div>
            </div>
        </div>
     </div>   
    <script src="/dashboard/js/sweetalert2.all.min.js"></script>

    <script src="/dashboard/js/login/login.js"></script>
</body>
</html>