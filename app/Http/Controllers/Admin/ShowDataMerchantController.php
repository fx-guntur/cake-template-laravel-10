<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant\Merchant;

class ShowDataMerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layout.show-data-merchant');
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
        //
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
    public function getMerchantsData(Request $request)
    {
        $merchants = Merchant::all(); // Fetch all merchants

        return datatables()->of($merchants)
            ->addColumn('action', function ($merchant) {
                return '<a href="' . route('admin.merchant-data.edit', $merchant->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('admin.merchant-data.destroy', $merchant->id) . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->rawColumns(['action'])  // To ensure HTML is rendered
            ->make(true);
    }
}
