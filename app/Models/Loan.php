<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'username',
        'email',
        'phoneNumber',
        'reason',
        'supervisorName',
        'startLoanDate',
        'estReturnDate',
        'termsAndCondition'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function approval():HasOne
    {
        return $this->hasOne(Approval::class, 'id');
    }

}
