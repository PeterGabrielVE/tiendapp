<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $Brand = Brand::orderByDesc('id')->get();
            return $Brand;

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Brand = Brand::create($request->all());

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $Brand = Brand::findOrFail($request->id);
            return $Brand;

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $Brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $brand = Brand::findOrFail($request->id);

            $brand->name = $request->name;
            $brand->reference = $request->reference;

            $brand->save();

            return $brand;
        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::where('id_brand',$id)
                        ->get();
            if(count($product) > 0){
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Hay productos con esta marca!'
                );
                return response()->json($returnData,500);
            }else{
                $brand = Brand::destroy($id);
                return $brand;
            }
        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }


    }
}
