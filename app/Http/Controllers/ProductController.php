<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\brandM;
use App\Models\cateM;
use Illuminate\Support\Facades\Validator;
use DB;
use File;
class ProductController extends Controller
{

    //=================================
    public function getSingleProductAPI($id){
        $product= DB::table('products')
        ->join('brands','products.idBrand','=','brands.id')
        ->join('categrories','products.idCate','=','categrories.id')
        ->where('products.id','=',$id)->select('products.*','brands.name as brand','categrories.name as cate')->first();
        $gallery = DB::table('products_images')->where('idProduct',$id)->select('images')->get();
        return response()->json(['product'=>$product,'gallery'=>$gallery]);
    }
    // =================================
    public function getProductAPI(){
        $products = DB::Table('products')->inRandomOrder()->select('id','name','price','discount','images')->take(4)->get();
        // $products = DB::Table('products')->orderBy('id','desc')->select('id','name','price','discount','images')->take(6)->get();
        return response()->json($products);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = brandM::where('status', '=', 1)->select('id', 'name')->get();
        $cates = cateM::where('status', '=', 1)->select('id', 'name')->get();
        $products = DB::table('products')->join('brands','products.idBrand','=','brands.id')
        ->join('categrories','products.idCate','=','categrories.id')
        ->select('products.*','categrories.name as catename','brands.name as brandname')
        ->paginate(4);
        $url = 'http://127.0.0.1:8000/images/';
        // echo $products['lastPage'];
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
            'idBrand'=>'required|exists:brands,id',
            'idCate'=>'required|exists:categrories,id',
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
// ======================================
    public function deleteProduct(Request $request,productM $productM){
        $validation = Validator::make($request->all(), [

            'id'=>'required|exists:products,id',
          
        ],[
            'id.required'=>'Thiếu mã sản phẩm',
            'id.exists'=>'Mã không tồn tại',
          
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $image= productM::where('id',$request->id)->value('images');
        if(file_exists(public_path('images/'.$image))){
            File::delete(public_path('images/'.$image));
        }
        productM::where('id',$request->id)->delete();
        return response()->json(['check'=>true]);

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
    public function editProduct(Request $request, productM $productM)
    {
        $validation = Validator::make($request->all(), [

            'name'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric|min:0',
            'discount'=>'required|numeric|min:0',
            'idBrand'=>'required|exists:brands,id',
            'idCate'=>'required|exists:categrories,id',
            'content'=>'required',
            'id'=>'required|exists:products,id'
        ],[
            'name.required'=>'Thiếu tên sản phẩm',
            'price.required'=>'Thiếu giá sản phẩm',
            'price.numeric'=>'Giá sản phẩm không hợp lệ',
            'quantity.required'=>'Thiếu số lượng sản phẩm',
            'quantity.numeric'=>'Số lượng sản phẩm không hợp lệ',
            'quantity.min'=>'Số lượng sản phẩm >0',
            'discount.numeric'=>'Giá sản phẩm không hợp lệ',
            'id.required'=>'Chưa nhận được mã sản phẩm',
            'id.exists'=>'Mã sản phẩm không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        if(!isset($_FILES['file'])){
            productM::where('id',$request->id)->update(['name'=>$request->name,'price'=>$request->price,
                    'discount'=>$request->discount,'idBrand'=>$request->idBrand,
                    'quantity'=>$request->quantity,'idCate'=>$request->idCate,
                    'content'=>$request->content,'updated_at'=>now()]);
                    return response()->json(['check'=>true]);
        }else{
            if(file_exists(public_path('images/'.$_FILES['file']['name']))){
                if(isset($_POST['replace'])&& $_POST['replace']==1){
                    move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
                    productM::where('id',$request->id)->update(['name'=>$request->name,'price'=>$request->price,
                    'discount'=>$request->discount,'idBrand'=>$request->idBrand,
                    'quantity'=>$request->quantity,'idCate'=>$request->idCate,
                    'images'=>$_FILES['file']['name'],
                    'content'=>$request->content,'updated_at'=>now()]);
                     return response()->json(['check'=>true]);
                }else{
                 return response()->json(['check'=>false,'image'=>true]);
     
                }
             }else{
                $image= productM::where('id',$request->id)->value('images');
                if(file_exists(public_path('images/'.$image))){
                    File::delete(public_path('images/'.$image));
                }
                 move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
                 productM::where('id',$request->id)->update(['name'=>$request->name,'price'=>$request->price,
                 'discount'=>$request->discount,'idBrand'=>$request->idBrand,
                 'quantity'=>$request->quantity,'idCate'=>$request->idCate,
                 'images'=>$_FILES['file']['name'],
                 'content'=>$request->content,'updated_at'=>now()]);
                  return response()->json(['check'=>true]);
             }
        }
        
    }



    // // ===========================================
    // public function getProductAPI(){
    //     $result = DB::Table('products')->join('brands','products.idBrand','=','brands.id')
    //     ->join('categrories','products.idCate','=','categrories.id')
    //     ->select('products.*','categrories.name as catename','brands.name as brandname')
    //     ->paginate(3);
    //     return response()->json($result);
    // }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productM $productM)
    {
        //
    }
}
