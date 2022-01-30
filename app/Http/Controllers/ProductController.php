<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::select('products.*', 'brands.name as brand')
            ->leftjoin('brands', 'products.id_brand', '=', 'brands.id')
            ->orderByDesc('boarding_date')->get();
            return $products;
        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    public function store(Request $request)
    {
        try {
            $product = Product::create($request->all());
            $product->save();
            return response()->json('Producto creado!');

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    public function show($id)
    {
        try {
            $product = Product::find($id);
            return response()->json($product);

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    public function update(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product->update($request->all());

            return response()->json('Producto actualizado!');

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            return response()->json('Producto eliminado!');

        }catch(\App\Exceptions\NotFoundmonException $e)
        {
            return $e->getMessage();
        }

    }
}
