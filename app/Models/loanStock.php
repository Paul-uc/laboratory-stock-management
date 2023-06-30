<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loanStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'loanRemark', 
        'estReturnDate',
    ]; //
   

    public function Stock(){
        return $this->belongsTo(Stock::class);
    }
}
