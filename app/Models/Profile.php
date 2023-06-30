<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    protected $fillable = [
        'first_name',
        'last_name',
        'contact',
        'email',
        'gender',
        'address',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
  
}
