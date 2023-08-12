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
        'loan_stock_id',
        'status',
        'name',
        'position',
        'remark',       
    ]; //


    public function loanstock():BelongsTo
    {
        return $this->belongsTo(loanstock::class, 'id');
    }

}


