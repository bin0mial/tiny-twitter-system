<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'image',
        'banned_at',
        'ban_expire_at',
        'attempts'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "followers", 'follower_id', 'following_id')
            ->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "followers", 'following_id', 'follower_id')
            ->withTimestamps();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }

    public function getImageAttribute($value): ?string
    {
        return $value ? Storage::url($value) : null;
    }

    public function setImageAttribute($value): void
    {
        $path = $value ? $value->storePublicly("public/avatars") : null;
        $this->attributes['image'] = $path;
    }

    public function isBanned(): bool
    {
        $expired_at = Carbon::parse($this->attributes['ban_expire_at']);
        return $expired_at->greaterThanOrEqualTo(now());
    }


}
