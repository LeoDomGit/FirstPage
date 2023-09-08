<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background: #fff !important; margin: 0 auto; margin-top: 30px; width: 90%; font-size: 14px; color: #333333; border: 1px solid #e1e1e1;">
	<div style="margin: 0 auto; width: 90%">
		<div style="margin-bottom: 25px;">
			<h3>{{ $mailData['title'] }}</h3>
            <h4> Bạn đã thay đổi email thành công</h4>
            <h4>Mail đăng nhập của bạn là : {{$mailData['email']}}</h4>
		</div>
		<p>Thân gửi,</p>
	</div>	
	<div style="width: 100%; margin-top: 50px;">
    	<img src="https://jobsgo.vn/blog/wp-content/uploads/2023/02/coder-la-gi.jpg" alt="logo" class="img-responsive" style="width: 100%">
  	</div>
</body>
</html>