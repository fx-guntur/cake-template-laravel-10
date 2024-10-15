<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant\Merchant;

class ShowDataMerchantController extends Controller
{
    // Tampilkan daftar merchant (index)
    public function index()
    {
        return view('admin.layout.show-data-merchant');
    }

    // Tampilkan form create merchant baru (create)
    public function create()
    {
        return view('admin.layout.create-merchant'); // Ganti dengan tampilan form
    }

    // Simpan merchant baru (store)
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
        ]);

        Merchant::create($request->all());

        return redirect()->route('admin.merchant-data.index')->with('success', 'Merchant created successfully.');
    }

    // Tampilkan detail merchant tertentu (show)
    public function show(string $id)
    {
        $merchant = Merchant::find($id);

        return view('admin.layout.show-merchant', compact('merchant')); // Ganti dengan tampilan detail
    }

    // Tampilkan form edit merchant (edit)
    public function edit(string $id)
    {
        $merchant = Merchant::find($id);

        return view('admin.layout.edit-merchant', compact('merchant')); // Ganti dengan tampilan form edit
    }

    // Update data merchant yang ada (update)
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
        ]);

        $merchant = Merchant::find($id);
        $merchant->update($request->all());

        return response()->json(['success' => 'Merchant updated successfully']);
    }

    // Hapus merchant (destroy)
    public function destroy(string $id)
    {
        $merchant = Merchant::find($id);
        $merchant->delete();

        return response()->json(['success' => 'Merchant deleted successfully']);
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
