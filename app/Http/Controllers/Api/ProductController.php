<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = ($q = $request->get('q')) ? Product::search($q) : Product::query();
        $products = $products->paginate();

        return response()->json($products);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted.'
        ]);
    }
    
    /**
     * Restore the specified resource from storage.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function restore($productId)
    {
        Product::whereId($productId)->withTrashed()->restore();

        return response()->json([
            'message' => 'Product restored.'
        ]);
    }

    /**
     * Search a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $products = ($q = $request->get('q')) ? Product::search($q) : Product::query();
        $products = $products->get();

        return response()->json($products);
    }
}
