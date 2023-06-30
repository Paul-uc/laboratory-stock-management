<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnStock extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'loan_stock_id',
        'isSucessful', 

    ]; //

    public function loanStock(){
        return $this->belongsTo(loanStock::class);
    }
}
