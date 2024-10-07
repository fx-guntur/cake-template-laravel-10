<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Merchant\Merchant;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show(string $uuid)
    {
        // Retrieve the transaction using the UUID
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();
        return response()->json($transaction);
    }

    // public function meta()
    // {
    //     return $this->hasMany(TransactionMeta::class, 'transaction_id');
    // }

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
        $merchant_id= Merchant::findOrFail(Auth::guard('merchant')->user()->id);
        $query = Transaction::select('uuid', 'payment_code', 'invoice', 'type', 'amount', 'status', 'created_at')
        ->where('merchant_id', $merchant_id->id); // Filter by merchant_id
        // Remove this line in production; it's only for debugging.
        // dd($query->get());

        return datatables()->of($query)
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-info" data-uuid="' . $row->uuid . '" id="viewTransactionBtn">Show Details</button>';
            })
            // ->editColumn('status', function ($row) {
            //     return $row->status ? 'Active' : 'Inactive';
            // })
            ->rawColumns(['action'])
            ->make(true);
    }
}
