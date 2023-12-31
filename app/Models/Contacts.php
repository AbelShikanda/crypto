<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Contacts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'users_id',
        'key', 
    ];

    // public function setMessageNoAttribute($value)
    // {
    //     $this->attributes['message'] = Crypt::encryptString($value);
    // }

    // public function getCardNoAttribute($value)
    // {
    //     try {
    //         return Crypt::decryptString($value);
    //     } catch (\Exception $e) {
    //         return $value;
    //     }
    // }

}
