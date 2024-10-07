<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Merchant\Merchant;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;

class ShowDataTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.layout.show-data-transaction');
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

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    // Define the relationship to the Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getTransactionData(Request $request)
    {
        $query = Transaction::select(
            'transactions.uuid',
            'merchants.username as merchant_name',
            'customers.name as customer_name', 
            'transactions.payment_code',
            'transactions.invoice',
            'transactions.type',
            'transactions.amount',
            'transactions.status',
            'transactions.created_at'
        )
        ->join('merchants', 'transactions.merchant_id', '=', 'merchants.id')
        ->join('customers', 'transactions.customer_id', '=', 'customers.id'); 
        // Filter by merchant_id
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
