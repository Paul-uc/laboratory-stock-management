<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

   
    public function stockCode():HasMany
    {
        return $this->hasMany(stockCode::class);
    }

    public function loanStock():HasMany
    {
        return $this->hasMany(loanStock::class);
    }

    public function loan():HasMany
    {
        return $this->hasMany(Loan::class);
    }
   
}
