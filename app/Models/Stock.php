<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'stock_code_id',
        
        'serialNumber',
        'stockDescription',

        'warrantyStartDate',
        'warrantyEndDate',

        'stockQuantity',   
        'price',
        
        'stockAvailability',
    ]; //

//belongs to relations
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockCode():BelongsTo
    {
        return $this->belongsTo(stockCode::class);
    }

//has many relations
    public function LoanStock():HasMany
    {
        return $this->hasMany(loanStock::class);
    }

    public function approvals():HasMany
    {
        return $this->hasMany(Approval::class);
    }

    
}
