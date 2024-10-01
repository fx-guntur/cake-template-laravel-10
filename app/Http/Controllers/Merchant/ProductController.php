<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Merchant\Merchant;
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // // Check if the image is valid
            // if (!$image->isValid()) {
            //     dd('Invalid image file');
            // }

            // Manually move the image
            $path = public_path('storage/products');
            $filename = time() . '_' . $image->getClientOriginalName(); // Rename for uniqueness

            // if (!$image->move($path, $filename)) {
            //     dd('File upload failed');
            // }

            $finalPath = 'products/' . $filename; // Adjust the path

            // Create a new entry in the product_images table with the path as a string
            $product->images()->create([
                'uuid' => (string) Str::uuid(),
                'path' => $finalPath, // Save path as a string
            ]);
        }


        return redirect()->route('merchant.show-product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $query = Product::select('name', 'price', 'description', 'is_active as status', 'created_at');

        // Remove this line in production; it's only for debugging.
        // dd($query->get());

        return datatables()->of($query)
            ->addColumn('action', function ($row) {
                // return '<a href="' . route('products.edit', $row->product_id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            // ->editColumn('status', function ($row) {
            //     return $row->status ? 'Active' : 'Inactive';
            // })
            ->make(true);
    }
}
