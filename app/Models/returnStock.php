<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class returnStock extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'approval_id',
        'user_id',
        'loan_stock_id',
        'userId',
        'status',
        'name',
        'position',
        'remark', 
      

    ]; //

    public function approval():BelongsTo
    {
        return $this->belongsTo(Approval::class);
    }
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class);
    }


  
}
