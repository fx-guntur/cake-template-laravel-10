<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction\Transaction;
use App\Models\Customer\Customer;
use App\Models\Merchant\Merchant;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Fetch total earnings for the current month
        $monthlyEarnings = Transaction::whereYear('transaction_date', $currentYear)
            ->whereMonth('transaction_date', $currentMonth)
            ->sum('amount');

        // Fetch total earnings for the current year
        $annualEarnings = Transaction::whereYear('transaction_date', $currentYear)
            ->sum('amount');

        // Fetch the total number of registered users
        $registeredUsers = Customer::count();

        // Fetch the total number of registered merchants
        $registeredMerchants = Merchant::count();

        // Pass all data to the view
        return view('admin.layout.dashboard', [
            'monthlyEarnings' => $monthlyEarnings,
            'annualEarnings' => $annualEarnings,
            'registeredUsers' => $registeredUsers,
            'registeredMerchants' => $registeredMerchants,
        ]);
    }
}
