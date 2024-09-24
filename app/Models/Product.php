<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'product'; // Specify the table name if different

    protected $fillable = [
        'uuid',          // If you're using UUIDs
        'merchant_id',
        'name',
        'price',
        'description',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for new records
        static::creating(function ($model) {
            // Always generate UUID on Data Create
            $model->{'uuid'} = Str::uuid()->toString();
        });

        // Listen to Deleted Event
        // static::deleted(function ($model){
        //     if($model->productMeta()->exists()){
        //         foreach($model->productMeta()->get() as $item){
        //             if($item->key === 'document'){
        //                 if($this->fileIsExists($item->value)){
        //                     $this->removeFile($item->value);
        //                 }
        //             }

        //             $item->delete();
        //         }
        //     }
        // });
    }
}
