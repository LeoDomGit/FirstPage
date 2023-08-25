$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    login();
});
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
function login(){
    $("#submitDangNhap").click(function (e) { 
        e.preventDefault();
        var email=$("#email").val().trim();
        var password=$("#password").val().trim();
        if(email==''||password==''){
            Toast.fire({
                icon: 'error',
                title: 'Chưa nhập đủ thông tin'
            })
        }else{
            $.ajax({
                type: "post",
                url: "/checkLogin",
                data: {
                    email:email,
                    password:password
                },
                dataType: "JSON",
                success: function (res) {
                    if(res.check==true){
                        Toast.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công'
                        }).then(()=>{
                            window.location.replace('/');
                        })
                    }
                    if(res.msg.email){
                        Toast.fire({
                            icon: 'error',
                            title: res.msg.email
                        })
                    }else if(res.msg.password){
                        Toast.fire({
                            icon: 'error',
                            title: res.msg.password
                        })
                    }else if(res.msg){
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