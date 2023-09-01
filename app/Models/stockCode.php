<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class stockCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',

        'stockDescription',
    ];

    //belongs to relationship
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
     //belongs to relationship
     public function stocks():BelongsTo
     {
         return $this->belongsTo(Stock::class);
     }


    //has many relations
    public function stock():HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function serial_numbers():HasMany
    {
        return $this->hasMany(Stock::class);
    }


    public function loan():HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
