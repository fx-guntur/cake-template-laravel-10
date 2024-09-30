<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantMeta extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Menentukan nama tabel jika berbeda dari default 'show_transactions'
    protected $table = 'merchant_meta'; // Nama tabel di database

    // Menentukan field yang dapat diisi secara massal
    protected $fillable = [
        'uuid', 
        'merchant_id', 
        'key',
        'value',
    ];

    // Mengaktifkan timestamps (created_at, updated_at)
    public $timestamps = true;

    // Jika menggunakan soft deletes (ada kolom deleted_at)
    protected $dates = ['deleted_at'];
}
