<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class loanStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'stock_code_id',

        'loanRemark', 
        
    ]; //
   
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function Stock():BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function stockCode():BelongsTo
    {
        return $this->belongsTo(stockCode::class);
    }

    
}
