<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'loan_stock_id',
        'userId',
        'status',
        'name',
        'position',
        'remark',       
    ]; //


    public function loanstock():BelongsTo
    {
        return $this->belongsTo(loanstock::class, 'id');
    }

    public function loan():BelongsTo
    {
        return $this->belongsTo(Loan::class, 'id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function stock():BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }


}


