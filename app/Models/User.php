<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Modules\Product\App\Models\Product;
use Modules\Segment\App\Models\PivotProductUser;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function products(): HasMany
    {
        return $this->hasMany(PivotProductUser::class);
    }

    public function pivotProductUsers(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'pivot_product_users');
    }

    public function wishlistedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'pivot_product_users')
            ->wherePivot('type', 'wishlisted');
    }

    public function subscribedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'pivot_product_users')
            ->wherePivot('type', 'subscribed');
    }
}
