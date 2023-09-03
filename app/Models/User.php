<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;



class User extends Authenticatable implements MustVerifyEmail
//implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'provider',
        'provider_id',
        'provider_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function generateUserName($username)
    {
        if($username === null){
            $username = Str::lower(Str::random(8));
        }
        if(User::where('username', $username)->exists()){
            $newUsername = $username.Str::lower(Str::random(3));
            $username = self::generateUserName($newUsername);
        }
        return $username;
    }

    public function isAdmin()
    {
    return $this->roles->whereIn('name', ['SuperAdmin', 'Admin'])->count() > 0;
    }

    public function loans():HasMany
    {
        return $this->hasMany(Loan::class);
    }

  public function returnStock():HasMany
    {
        return $this->hasMany(returnStock::class);
    }

    public function username():HasOne
    {
        return $this->hasOne(User::class, 'username');
    }

    public function userId():HasOne
    {
        return $this->hasOne(User::class, 'id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function loanstock():HasMany
    {
        return $this->hasMany(loanstock::class, 'loan_stock_id');
    }

    public function approvals():HasMany
    {
        return $this->hasMany(Approval::class, 'approval_id');
    }


    // public function canAccessFilament(): bool{
    //     return $this->hasRole('Admin', 'SuperAdmin', '');
    // }
}
