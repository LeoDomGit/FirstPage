<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserRoleM;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\demoMail;
use App\Mail\ChangeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function DangNhap()
    {
        return view('login.dangnhap');
    }

    /**
     * Display a listing of the resource.
     */
    public function switchUser(Request $request,Validator $validation,User $User){
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:users,id',
        ],[
            'id.required'=>'Thiếu mã tài khoản',
            'id.exists'=>'Mã tài khoản không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $old =User::where('id',$request->id)->value('status');
        if($old ==0){
            User::where('id',$request->id)->update(['status'=>1,'updated_at'=>now()]);
        }else{
            User::where('id',$request->id)->update(['status'=>0,'updated_at'=>now()]);
        }
        return response()->json(['check'=>true]);
    }
    /**
     * Display a listing of the resource.
     */
    public function checkRegister(Request $request,Validator $validation,User $User,UserRoleM $UserRoleM)
    {
        $validation = Validator::make($request->all(), [
            'email'=>'required|unique:users,email',
            'password'=>'required'
        ],[
            'email.required'=>'Thiếu email tài khoản',
            'email.unique'=>'Email tài khoản bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        
    }
    /**
     * Display a listing of the resource.
     */

    public function DangKy()
    {
        return view('login.dangky');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userroles = UserRoleM::all();
        $users = User::all();
        return view('users.index',compact("userroles","users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function TaoLoaiTaiKhoan(Request $request,Validator $validation,UserRoleM $UserRoleM)
    {
        $validation = Validator::make($request->all(), [
            'tenLoai'=>'required|unique:userroles,name',
        ],[
            'tenLoai.required'=>'Thiếu tên loại tài khoản',
            'tenLoai.unique'=>'Tên loại bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
            // }else{
        $name=$request->tenLoai;
        UserRoleM::create(['name'=>$request->tenLoai]);
        return response()->json(['check'=>true]);
    }
       /**
     * Show the form for creating a new resource.
     */
    public function editLoaiTaiKhoan(Request $request,Validator $validation,UserRoleM $UserRoleM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:userroles,id',
            'tenLoai'=>'required|unique:userroles,name',
        ],[
            'id.required'=>'Thiếu mã loại tài khoản',
            'id.exists'=>'Mã loại tài khoản không tồn tại',
            'tenLoai.required'=>'Thiếu tên loại tài khoản',
            'tenLoai.unique'=>'Tên loại bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        UserRoleM::where('id',$request->id)->update(['name'=>$request->tenLoai,'updated_at'=>now()]);
        return response()->json(['check'=>true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function deleteLoaiTaiKhoan(Request $request,Validator $validation,UserRoleM $UserRoleM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:userroles,id',
           
        ],[
            'id.required'=>'Thiếu mã loại tài khoản',
            'id.exists'=>'Mã loại tài khoản không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        UserRoleM::where('id',$request->id)->delete();
        return response()->json(['check'=>true]);
    }
    /**
     * Display the specified resource.
     */
    public function createUser(Request $request,Validator $validation,User $User,UserRoleM $UserRoleM)
    {
        $validation = Validator::make($request->all(), [
            'username'=>'required',
           
            'email'=>'required|email|unique:users,email',
            'idRole'=>'required|exists:userroles,id',
           
        ],[
            'username.required'=>'Thiếu tên đăng nhập',
            'email.required'=>'Thiếu email',
            'email.unique'=>'Email đã được đăng ký',
            'email.email'=>'Email không đúng định dạng',
            'idRole.required'=>'Thiếu mã loại tài khoản',
            'idRole.exists'=>'Mã loại tài khoản không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $password=random_int(10000,99999);
        User::create(['name'=>$request->username,'password'=>Hash::make($password),'email'=>$request->email,'idRole'=>$request->idRole,'created_at'=>now()]);
        //Email nhận 
        $mailData = [
            'title'=>'Email đăng ký thành viên mới',
            'username'=>$request->username,
            'password'=>$password,
        ];
        Mail::to($request->email)->send(new demoMail($mailData));
        return response()->json(['check'=>true]);
    }
     /**
     * Display the specified resource.
     */
    public function Login()
    {
        return view('login.dangnhap');
    }

    /**
     * Display the specified resource.
     */
    public function checkLogin(Request $request,Validator $validation,User $User)
    {
        $validation = Validator::make($request->all(), [
            'email'=>'required|email|exists:users,email',
            'password'=>'required',

        ],[
            'email.required'=>'Thiếu email đăng nhập',
            'email.email'=>'Email đăng nhập không hợp lệ',
            'email.exists'=>"Email không tồn tại",
            'password.required'=>'Thiếu mật khẩu',
           
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password], true)) {
            return response()->json(['check'=>true]);
        }else{
            return response()->json(['check'=>false,'msg'=>'Sai mật khẩu']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function doiEmail(Request $request,Validator $validation,User $User)
    {
        $validation = Validator::make($request->all(), [
            'email'=>'required|email|unique:users,email',
            'id'=>'required|numeric|exists:users,id',

        ],[
            'email.required'=>'Thiếu email đăng nhập',
            'email.email'=>'Email đăng nhập không hợp lệ',
            'email.unique'=>"Email đã tồn tại",
            'id.required'=>'Thiếu mã tài khoản',
            'id.numeric'=>'Mã tài khoản không hợp lệ',
            'id.exists'=>'Mã tài khoản không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        User::where('id',$request->id)->update(['email'=>$request->email,'updated_at'=>now()]);
        $mailData = [
            'title'=>'CẬP NHẬT EMAIL TÀI KHOẢN',
            'email'=>$request->email,
        ];
        Mail::to($request->email)->send(new ChangeMail($mailData));
        return response()->json(['check'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
            return redirect('/login');
        }
    }
}
