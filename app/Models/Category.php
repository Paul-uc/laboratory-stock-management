<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'stockCategory',
    ];

    public function stock(){
        return $this->hasMany(Stock::class);
    }
}
