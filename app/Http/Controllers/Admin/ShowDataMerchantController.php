<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant\Merchant;
use Illuminate\Support\Facades\Session;

class ShowDataMerchantController extends Controller
{
    // Tampilkan daftar merchant (index)
    public function index()
    {
        return view('admin.layout.app', [
            'pageTitle' => 'Customer Data',
            'viewType' => 'adminMerchantData',
        ]);
    }

    // Tampilkan form create merchant baru (create)
    public function create()
    {
        return view('admin.layout.app', [
            'pageTitle' => 'Customer Data',
            'viewType' => 'adminAddMerchant',
        ]);
    }

    // Simpan merchant baru (store)
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:customers|max:255',
            'email' => 'required|string|email|unique:customers|max:255',
            'password' => 'required|string|min:5|confirmed',
        ]);

        // Create a new customer account
        $merchant = new Merchant();
        $merchant->username = $request->username;
        $merchant->email = $request->email;
        $merchant->password = bcrypt($request->password); // Hash the password
        $merchant->save(); // UUID is generated here automatically

        Session::flash('success', 'Registration Successful! You can now log in.');
        return redirect()->route('admin.add-merchant.index');
    }

    // Tampilkan detail merchant tertentu (show)
    public function show(string $id)
    {
       
    }

    // Tampilkan form edit merchant (edit)
    public function edit(string $uuid)
    {
        $merchant = Merchant::where('uuid', $uuid)->firstOrFail();
        return response()->json($merchant);
    }

    // Update data merchant yang ada (update)
    public function update(Request $request, string $uuid)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
        ]);

        // Find the product by UUID
        $merchant_data = Merchant::where('uuid', $uuid)->firstOrFail();
        $merchant_data->email = $validatedData['email'];
        $merchant_data->username = $validatedData['username'];

        // Save the changes to the database
        $merchant_data->save();

        return response()->json(['success' => 'Merchant updated successfully.']);
    
    }

    // Hapus merchant (destroy)
    public function destroy(string $uuid)
    {
        $merchant = Merchant::where('uuid', $uuid)->firstOrFail();
        $merchant->delete();

        return response()->json(['success' => 'Merchant deleted successfully.']);
     }

    // Untuk data DataTables (extra, ini tidak otomatis resource)
    public function getMerchantsData(Request $request)
    {
        $merchants = Merchant::all();

        return datatables()->of($merchants)
            ->addColumn('action', function ($merchant) {
                return '
                    <button class="btn btn-sm btn-primary btn-edit" data-id="' . $merchant->id . '" data-email="' . $merchant->email . '" data-username="' . $merchant->username . '">Edit</button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="' . $merchant->id . '">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
