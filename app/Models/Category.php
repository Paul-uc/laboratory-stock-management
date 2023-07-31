<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function stock():HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function loanApproval():HasMany
    {
        return $this->hasMany(loanApproval::class);
    }
}
