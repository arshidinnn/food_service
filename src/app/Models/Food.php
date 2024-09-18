<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



/**
 * 
 *
 * @property int $id
 * @property string|null $image
 * @property string $title
 * @property string|null $description
 * @property float $price
 * @property int $quantity
 * @property string|null $unit
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food query()
 * @mixin \Eloquent
 */
class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'quantity',
        'unit'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
