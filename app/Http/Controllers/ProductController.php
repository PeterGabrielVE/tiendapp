<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*', 'brands.name as brand')
        ->leftjoin('brands', 'products.id_brand', '=', 'brands.id')
        ->orderByDesc('boarding_date')->get();
        return $products;
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $product->save();

        return response()->json('Producto creado!');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->update($request->all());

        return response()->json('Producto actualizado!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('Producto eliminado!');
    }
}
