<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Merchant\Merchant;
use App\Models\Product\ProductImage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('merchant.layout.showallProduct');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merchant.layout.add-catalog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the authenticated user
        $user = Merchant::findOrFail(Auth::guard('merchant')->user()->id);

        // Validate input from the form including the image
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);

        // Create a new product instance
        $product = new Product();
        $product->merchant_id = $user->id; // Set the merchant_id
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->is_active = 1;

        // Save the product instance
        $product->save();

        // If there's an image, save it to the product_images table
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image in the public storage
            $path = $image->store('products', 'public'); // Store image in storage/products

            // Create a new entry in the product_images table with the path as a string
            $product->images()->create([
                'uuid' => (string) Str::uuid(),
                'product_id' => $product->id, // Store the product ID
                'path' => $path, // Save path as a string

            ]);
        }

        return redirect()->route('merchant.show-product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        // Mencari produk berdasarkan UUID
        $product = Product::with('images')->where('uuid', $uuid)->firstOrFail();

        // Check if the product exists
        if (!$product) {
            abort(404, 'Product not found');
        }

        // Mengembalikan data (bisa dalam bentuk view atau JSON)
        return view('merchant.layout.viewProduct', compact('product'));
    }

    // Product.php
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getData(Request $request)
    {
        // Modify the query to include the UUID
        $query = Product::select('uuid', 'name', 'price', 'description', 'is_active as status', 'created_at');

        return datatables()->of($query)
            ->addColumn('action', function ($row) {
                // Generate the action button using the UUID
                return '<a href="/merchant/previewProduct/' . $row->uuid . '" class="btn btn-info btn-sm">Lihat Detail</a>';
            })
            // ->editColumn('status', function ($row) {
            //     return $row->status ? 'Active' : 'Inactive';
            // })
            ->make(true);
    }
}
