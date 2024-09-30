<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Menentukan nama tabel jika berbeda dari default 'show_transactions'
    protected $table = 'transactions'; // Nama tabel di database

    // Jika primary key adalah 'id' dan menggunakan auto-increment
    protected $primaryKey = 'id';

    // Menentukan field yang dapat diisi secara massal
    protected $fillable = [
        'uuid', 
        'merchant_id', 
        'customer_id', 
        'payment_id', 
        'payment_code',
        'invoice', 
        'type', 
        'amount', 
        'unique_code', 
        'charge',
        'transaction_date', 
        'transaction_paid_date', 
        'transaction_deadline',
        'status', 
        'created_at', 
        'updated_at'
    ];

    // Mengaktifkan timestamps (created_at, updated_at)
    public $timestamps = true;

    // Jika menggunakan soft deletes (ada kolom deleted_at)
    protected $dates = ['deleted_at'];
}
