<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ImpersonatingController extends Controller
{
    public $guard = 'admin';

    /**
     * 
     */
    public function startImpersonate(Request $request)
    {
        $guard = $this->guard;
        if($request->has('guard') && !empty($request->guard)){
            $guard = $request->guard;
        }

        // Check if impersonate session exists
        if(Session::has('impersonate') && !empty(Session::get('impersonate'))){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'error' => 'Silahkan hentikan sesi Impersonate sebelumnya untuk memulai sesi Impersonate yang baru!'
            ]);
        }

        $data = null;
        switch($guard){
            default:
                $data = Customer::find($request->id);
                break;
        }

        if(!empty($data) && !empty($guard)){
            Session::put('impersonate', $data->id);
            Session::put('impersonate_guard', $guard);
            Session::put('impersonate_model', get_class($data));

            return response()->json([
                'status' => 'success',
                'message' => 'Aksi Impersonate berhasil dilakukan!'
            ]);
        }

        // Throw default exception
        throw \Illuminate\Validation\ValidationException::withMessages([
            'error' => 'Terdapat kesalahan, data tidak ditemukan!'
        ]);
    }

    /**
     * 
     */
    public function stopImpersonate(Request $request)
    {
        Session::forget('impersonate');
        Session::forget('impersonate_guard');
        Session::forget('impersonate_model');
    }
}
