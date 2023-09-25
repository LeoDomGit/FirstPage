<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\brandM;
use App\Models\cateM;
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
    public function store(Request $request)
    {
        //
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
