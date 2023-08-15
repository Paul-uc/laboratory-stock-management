<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class returnStock extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'approval_id',
        'remark', 
        'userId',

    ]; //

    public function approval():BelongsTo
    {
        return $this->belongsTo(Approval::class);
    }



  
}
