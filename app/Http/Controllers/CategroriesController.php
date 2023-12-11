<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\cateM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategroriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cates= cateM::withTrashed()->get();
        return view('cates.index',compact('cates'));
    }
// =====================================================
    public function getCateAPI(Request $request){
        $cates = DB::Table('categrories')->where('status',1)
        ->select('id','name')->get();
        return response()->json($cates);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'name'=>'required|unique:categrories_tbl,name',
        ],[
            'name.required'=>'Thiếu tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        cateM::create(['name'=>$request->name,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }
    /**
     * Display the specified resource.
     */
    public function show(cateM $cateM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cateM $cateM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
            'name'=>'required|unique:categrories_tbl,name',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
            'name.required'=>'Thiếu tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        cateM::where('id',$request->id)->update(['name'=>$request->name,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(Request $request, cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
        ]); 
        cateM::onlyTrashed()->where('id', $request->id)->restore();
        return response()->json(['check'=>true]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
        ]); 
        cateM::where('id',$request->id)->delete();
        return response()->json(['check'=>true]);
    }
}
