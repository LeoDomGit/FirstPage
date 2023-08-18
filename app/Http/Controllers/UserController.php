<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserRoleM;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userroles = UserRoleM::all();
        return view('users.index',compact("userroles"));
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
            'password'=>'required',
            'email'=>'required|email|unique:users,email',
            'idRole'=>'required|exists:userroles,id',
           
        ],[
            'username.required'=>'Thiếu tên đăng nhập',
            'password.required'=>'Thiếu mật khẩu',
            'email.required'=>'Thiếu email',
            'email.unique'=>'Email đã được đăng ký',
            'email.email'=>'Email không đúng định dạng',
            'idRole.required'=>'Thiếu mã loại tài khoản',
            'idRole.exists'=>'Mã loại tài khoản không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        User::create(['name'=>$request->username,'password'=>Hash::make($request->password),'email'=>$request->email,'idRole'=>$request->idRole,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
