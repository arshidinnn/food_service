<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;



/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $seller_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Food> $foods
 * @property-read int|null $foods_count
 * @property-read \App\Models\Seller $seller
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];

    public function seller(): BelongsTo {
        return $this->belongsTo(Seller::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public static function getCategoriesBySeller(): Collection
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Seller $seller */
        $seller = $user->seller()->first();

        return $seller
            ->categories()
            ->select(['id', 'name'])
            ->get();
    }
}
