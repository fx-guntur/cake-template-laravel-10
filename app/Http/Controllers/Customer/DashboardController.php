<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductCategories;
use App\Models\Product\ProductImage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with(['images', 'category'])->get();
        $categories = ProductCategories::all();
        $cheap_products = Product::with(['images', 'category'])
            ->orderBy('price', 'asc')
            ->limit(6)
            ->get();

            return view('customer.layout.app', [
                'pageTitle' => 'Dashboard',
                'viewType' => 'customerDashboard',
                'products' => $products,
                'cheap_products' => $cheap_products,
                'categories' => $categories,
            ]);

    }

    public function images()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'category_id'); // Adjust 'category_id' to your actual foreign key name
    }
}
