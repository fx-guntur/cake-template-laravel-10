<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\showTransaction;
use Illuminate\Http\Request;

class ShowTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('merchant.layout.showTransaction');
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

    public function getData(Request $request){
        $query = showTransaction::select('uuid', 'payment_code', 'invoice', 'type', 'amount' ,'status','created_at');

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
