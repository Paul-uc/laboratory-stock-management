<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payementId',
        'paymentMethod',
        'paymentStatus',
        ];

    protected function loss_stock(){
        return $this->belongsTo(lossStock::class);
    }
}
