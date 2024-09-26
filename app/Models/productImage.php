<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'uuid', 'product_id', 'path'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
