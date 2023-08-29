<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        
]; //

    public function loanStock(){
        return $this->belongsTo(loanStock::class);
    }
}
