<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $Brand = Brand::orderByDesc('id')->get();
        return $Brand;
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
        $Brand = Brand::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $Brand = Brand::findOrFail($request->id);
        return $Brand;
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
        $brand = Brand::findOrFail($request->id);

        $brand->name = $request->name;

        $brand->save();

        return $brand;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::destroy($id);
        return $brand;
    }
}