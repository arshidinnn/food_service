<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $bin
 * @property string $reg_number
 * @property int $is_banned
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Food> $foods
 * @property-read int|null $foods_count
 * @property-read string|null $email
 * @property-read string|null $temporary_password
 * @property-read \App\Models\Restaurant|null $restaurant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Seller newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seller newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seller query()
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereRegNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seller whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'reg_number', 'bin', 'is_banned'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function restaurant(): HasOne
    {
        return $this->hasOne(Restaurant::class);
    }

    public function foods(): HasManyThrough
    {
        return $this->hasManyThrough(Food::class, Restaurant::class);
    }
    public function getEmailAttribute(): ?string
    {
        $this->loadMissing('users');
        $user = $this->users->first();

        return $user ? $user->email : null;
    }

    public function getTemporaryPasswordAttribute(): ?string {
        $this->loadMissing('users');
        $user = $this->users->first();

        return $user ? $user->temporary_password : null;
    }

}
