<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('images')->get();
        $cheap_products = Product::with('images')
        ->orderBy('price', 'asc')
        ->limit(6)
        ->get();
        return view('customer.layout.dashboard', compact('products', 'cheap_products'));
    }

    public function images()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }
}
