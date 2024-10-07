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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Create a new product instance
        $product = new Product();
        $product->merchant_id = $user->id;
        $product->uuid = (string) Str::uuid();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->is_active = 1;

        // Save the product instance
        $product->save();

        // If there's an image, save it to the product_images table
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('products', 'public');

            $product->images()->create([
                'uuid' => (string) Str::uuid(),
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }

        return redirect()->route('merchant.show-product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $product = Product::with('images')->where('uuid', $uuid)->firstOrFail();
        return view('merchant.layout.viewProduct', compact('product'));
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $product = Product::where('uuid', $uuid)->firstOrFail();
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        // Find the product by UUID
        $product = Product::where('uuid', $uuid)->firstOrFail();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];

        // Save the changes to the database
        $product->save();

        return response()->json(['success' => 'Product updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $product = Product::where('uuid', $uuid)->firstOrFail();
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }

    /**
     * Get product data for DataTables.
     */
    public function getData(Request $request)
    {
        $query = Product::select('uuid', 'name', 'price', 'description', 'is_active as status', 'created_at');
        return datatables()->of($query)
            ->addColumn('action', function ($row) {
                return '<a href="/merchant/product/' . $row->uuid . '" class="btn btn-info btn-sm">Lihat Detail</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary editProduct" data-uuid="' . $row->uuid . '">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteProduct" data-uuid="' . $row->uuid . '">Delete</a>';
            })
            ->editColumn('status', function ($row) {
                return $row->status ? 'Active' : 'Inactive';
            })
            ->make(true);
    }
}
