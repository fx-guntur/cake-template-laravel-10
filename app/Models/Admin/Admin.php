<?php

namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory, Notifiable, Authenticatable;

    protected $table = 'admin'; // Specify the table name if different

    protected $fillable = [
        'uuid',        // If you're using UUIDs
        'name',
        'username',
        'password',
        'raw_password', // Add this if you need to store the unencrypted password
        'created_at'
    ];

    protected $hidden = [
        'password',
        'raw_password', // Hide sensitive information
    ];
    // Mutator for encrypting password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    // Optionally, you can define relationships and other model methods here
}
