<?php

namespace App\Facades;

use App\Services\Admin\StorageService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string handleImageUpload(\Illuminate\Http\UploadedFile|null $image, string $path = 'images')
 * @method static string updateImage(\Illuminate\Http\UploadedFile|null $image, object $model, string $path = 'images')
 * @method static void deleteImage(object $model)
 * @method static string getImagePath(string $imageUrl)
 *
 * @see StorageService
 */
class StorageFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return StorageService::class;
    }
}
