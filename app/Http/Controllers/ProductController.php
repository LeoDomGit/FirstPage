<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\brandM;
use App\Models\cateM;
use Illuminate\Support\Facades\Validator;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = brandM::where('status', '=', 1)->select('id', 'name')->get();
        $cates = cateM::where('status', '=', 1)->select('id', 'name')->get();
        $products = DB::table('products')->join('brands_tbl','products.idBrand','=','brands_tbl.id')
        ->join('categrories_tbl','products.idCate','=','categrories_tbl.id')
        ->select('products.*','categrories_tbl.name as catename','brands_tbl.name as brandname')
        ->get();
        $url = 'http://127.0.0.1:8000/images/';
        return view('products.index',compact('brands','cates','products','url'));
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
            'file'=>'required'
        ],[
            'name.required'=>'Thiếu tên sản phẩm',
            'name.unique'=>'Tên thương hiệu bị trùng',
            'price.required'=>'Thiếu giá sản phẩm',
            'price.numeric'=>'Giá sản phẩm không hợp lệ',
            'quantity.required'=>'Thiếu số lượng sản phẩm',
            'quantity.numeric'=>'Số lượng sản phẩm không hợp lệ',
            'quantity.min'=>'Số lượng sản phẩm >0',
            'discount.numeric'=>'Giá sản phẩm không hợp lệ',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        if(!isset($_FILES['file'])){
            return response()->json(['check'=>false,'msg'=>'Thiếu hình ảnh']);
        }
        if(file_exists(public_path('images/'.$_FILES['file']['name']))){
           if(isset($_POST['replace'])&& $_POST['replace']==1){
                move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
                productM::create(['name'=>$request->name,'price'=>$request->price,'discount'=>$request->discount,'idBrand'=>$request->idBrand,'quantity'=>$request->quantity,'idCate'=>$request->idCate,'images'=>$_FILES['file']['name'],'content'=>$request->content]);
                return response()->json(['check'=>true]);
           }else{
            return response()->json(['check'=>false,'image'=>true]);

           }
        }else{
            move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
            productM::create(['name'=>$request->name,'price'=>$request->price,'discount'=>$request->discount,'idBrand'=>$request->idBrand,'quantity'=>$request->quantity,'idCate'=>$request->idCate,'images'=>$_FILES['file']['name'],'content'=>$request->content]);
            return response()->json(['check'=>true]);
        }

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
    public function edit(Request $request,productM $productM)
    {
        $validation = Validator::make($request->all(), [

            'id'=>'required|exists:products,id'
        ],[
            'id.required'=>'Thiếu mã sản phẩm',
            'id.exists'=>'Mã sản phẩm không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $result = productM::where('id',$request->id)->get();
        return response()->json(['check'=>true,'product'=>$result]);
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
