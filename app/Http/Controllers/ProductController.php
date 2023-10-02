<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\brandM;
use App\Models\cateM;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = brandM::where('status', '=', 1)->select('id', 'name')->get();
        $cates = cateM::where('status', '=', 1)->select('id', 'name')->get();
        return view('products.index',compact('brands','cates'));
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
    public function store(Request $request,productM $productM)
    {
        $validation = Validator::make($request->all(), [

            'name'=>'required|unique:products,name',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric|min:0',
            'discount'=>'required|numeric|min:0',
            'idBrand'=>'required|exists:brands_tbl,id',
            'idCate'=>'required|exists:categrories_tbl,id',
            'content'=>'required',
        ],[
            'name.required'=>'Thiếu tên sản phẩm',
            'name.unique'=>'Tên thương hiệu bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
        productM::create(['name'=>$request->name,'price'=>$request->price,'discount'=>$request->discount,'idBrand'=>$request->idBrand,'idCate'=>$request->idCate,'images'=>$_FILES['file']['name'],'content'=>$request->content]);
    }

    /**
     * Display the specified resource.
     */
    public function show(productM $productM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productM $productM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productM $productM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productM $productM)
    {
        //
    }
}
