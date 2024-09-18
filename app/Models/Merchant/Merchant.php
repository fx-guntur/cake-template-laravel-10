<?php

namespace App\Models\Merchant;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Merchant extends Model implements AuthenticatableContract
{
    use HasFactory, Notifiable, Authenticatable;
    protected $table = 'merchants'; // Specify the table name if different

    protected $fillable = [
        'uuid',        // If you're using UUIDs
        'email',
        'username',
        'password',
        'raw_password', // Add this if you need to store the unencrypted password
    ];

    protected $hidden = [
        'password',
        'raw_password', // Hide sensitive information
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for new records
        static::creating(function ($customer) {  // Changed from $admin to $customer
            $customer->uuid = (string) Str::uuid();
        });
    }

    // Hash the password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
        $this->attributes['raw_password'] = $value; // Optional, if you want to keep the raw password
    }

    public $timestamps = true; // Enable timestamps

    // Disable the updated_at timestamp
    const UPDATED_AT = null;
}
