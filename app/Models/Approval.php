<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_stock_id',
        'status',
        'name',
        'position',
        'remark',       
    ]; //

    public function loanStock():BelongsTo
    {
        return $this->belongsTo(loanStock::class);
    }
}


