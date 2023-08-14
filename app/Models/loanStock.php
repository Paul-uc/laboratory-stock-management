<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
class loanStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'stock_id',
        'stock_code_id',

        'user_id',
        'userId',

        'email',
        'phoneNumber',
        'reason',
        'supervisorName',
        'startLoanDate', 
        'estReturnDate', 
        'termsAndCondition'
        
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


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function approval():HasOne
    {
        return $this->hasOne(Approval::class, 'id');
    }
    
    
}
