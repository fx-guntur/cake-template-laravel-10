<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionMeta extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Menentukan nama tabel jika berbeda dari default 'show_transactions'
    protected $table = 'transaction_meta'; // Nama tabel di database

    // Menentukan field yang dapat diisi secara massal
    protected $fillable = [
        'uuid', 
        'transaction_id', 
        'key',
        'value',
    ];

    // Mengaktifkan timestamps (created_at, updated_at)
    public $timestamps = true;

    // Jika menggunakan soft deletes (ada kolom deleted_at)
    protected $dates = ['deleted_at'];
}
