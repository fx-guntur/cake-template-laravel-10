<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

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
        // Validasi input dari form tanpa gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Buat produk baru
        $product = Product::create([
            'uuid' => (string) Str::uuid(),
            'merchant_id' => auth()->user()->merchant_id, // Pastikan merchant_id diambil dari user login
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'is_active' => 1, // Misal: set aktif secara default
        ]);

        // Kode untuk mengelola gambar telah dihapus

        return redirect()->route('merchant.products.index')->with('success', 'Produk berhasil ditambahkan.');
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
