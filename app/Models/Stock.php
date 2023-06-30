<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'stockQuantity',
        'stockDescription',
        'price',
        'warrantyDate',
        'stockAvailability',
    ]; //


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function LoanStock(){
        return $this->hasMany(loanStock::class);
    }
}
