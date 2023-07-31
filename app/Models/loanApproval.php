<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loanApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'loanRemark', 
        'estReturnDate',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
