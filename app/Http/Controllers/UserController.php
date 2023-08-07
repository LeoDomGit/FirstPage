<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserRoleM;
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
    public function create()
    {
        echo "Create User";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
