<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class ProductCategories extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    // Menentukan nama tabel jika berbeda dari default 'show_transactions'
    protected $table = 'product_categories'; // Nama tabel di database

    // Menentukan field yang dapat diisi secara massal
    protected $fillable = [
        'uuid', 
        'category',
    ];

    // Mengaktifkan timestamps (created_at, updated_at)
    public $timestamps = true;

    // Jika menggunakan soft deletes (ada kolom deleted_at)
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for new records
        static::creating(function ($model) {
            // Always generate UUID on Data Create
            $model->{'uuid'} = Str::uuid()->toString();
        });
    }
}
