<?php

namespace App\Models;

use App\Enums\UnitType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property string $price
 * @property string $quantity
 * @property UnitType $unit
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereUpdatedAt($value)
 * @property int $seller_id
 * @property-read \App\Models\Seller $seller
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereSellerId($value)
 * @mixin \Eloquent
 */
class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'quantity',
        'unit',
        'category_id'
    ];

    protected $casts = [
        'unit' => UnitType::class
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
