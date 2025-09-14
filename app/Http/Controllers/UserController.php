<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function homepage(){
        $products = Product::withAvg('ratings', 'rating')
                    ->latest()
                    ->limit(8)
                    ->get();
        return view('user.index', compact('products'));
    }

    function showAllProducts(){
        $products = Product::withAvg('ratings', 'rating')
                    ->get();
        return view('user.kategori_produk', compact('products'));
    }

    function showDetailProduct($product){
        $product = Product::where('slug', $product)
                    ->withAvg('ratings', 'rating')
                    ->withCount('ratings')
                    ->firstOrFail();
        return view('user.detail_product', compact('product'));
    }

    public function storeReview(Request $request, Product $product)
    {
        $request->validate([
            'reviewer_name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Rating::create([
            'product_id' => $product->id,
            'reviewer_name' => $request->reviewer_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('user.detail_product', $product->slug)->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
