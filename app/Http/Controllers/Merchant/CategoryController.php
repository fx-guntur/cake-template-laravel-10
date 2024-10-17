<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('merchant.layout.app', [
            'pageTitle' => 'List Category',
            'viewType' => 'merchantCategories',
        ]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|string|max:50',
        ]);

        // Create a new product instance
        $category = new ProductCategories();
        $category->uuid = (string) Str::uuid();
        $category->category = $request->input('categoryName');

        // Save the product instance
        $category->save();

        return response()->json(['message' => 'Kategori berhasil ditambahkan.'], 201);
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
    public function edit(string $uuid)
    {
        $categories = ProductCategories::where('uuid', $uuid)->firstOrFail();
        return response()->json($categories);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category' => 'required|string|max:50',
        ]);

        // Find the product by UUID
        $category_name = ProductCategories::where('uuid', $uuid)->firstOrFail();
        $category_name->category = $validatedData['category'];

        // Save the changes to the database
        $category_name->save();

        return response()->json(['success' => 'Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $category = ProductCategories::where('uuid', $uuid)->firstOrFail();
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

    /**
     * Get product data for DataTables.
     */
    public function getData(Request $request)
    {
        $query = ProductCategories::select(
            'product_categories.uuid', // Change to the correct column name for category UUID
            'product_categories.category', // Select category name
            DB::raw('COUNT(product.id) as product_count') // Count the number of products in each category
        )
        ->leftJoin('product', 'product.category_id', '=', 'product_categories.id') // Join products table
        ->groupBy('product_categories.id', 'product_categories.uuid', 'product_categories.category');
        return datatables()->of($query)
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-primary editCategory" data-uuid="' . $row->uuid . '">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteCategory" data-uuid="' . $row->uuid . '">Delete</a>';
            })
            ->editColumn('status', function ($row) {
                return $row->status ? 'Active' : 'Inactive';
            })
            ->make(true);
    }
}
