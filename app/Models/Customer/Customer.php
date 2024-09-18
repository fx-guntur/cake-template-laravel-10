<?php

namespace App\Models\Customer;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Customer extends Model implements AuthenticatableContract
{
    use HasFactory, Notifiable, Authenticatable;

    protected $table = 'customers'; // Specify the table name if different

    protected $fillable = [
        'uuid',          // If you're using UUIDs
        'name',
        'phone',
        'email',
        'username',
        'password',
        'raw_password',  // Optional: store unencrypted password if needed
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

    // Disable timestamps if not using created_at and updated_at
    public $timestamps = false;

}
