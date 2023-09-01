<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class lossStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'approval_id',
        'user_id',
        'stock_id',
        'userId',
        'status',
        'name',
        'position',
        'remark', 
        'loan_stock_id',
        
]; //

    public function loanStock(){
        return $this->belongsTo(loanStock::class);
    }

    public function stock():BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
  
}
