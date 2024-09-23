<?php

namespace App\Services\Admin;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * @throws Exception
     */
    public function handleImageUpload(UploadedFile|null $image, string $path = 'images'): string
    {
        if (!isset($image)) {
            throw new Exception('No image file provided.');
        }

        $imagePath = $image->store($path, 'public');
        return asset('storage/' . $imagePath);
    }

    /**
     * @throws Exception
     */
    public function updateImage(UploadedFile|null $image, object $model, string $path = 'images'): void
    {
        if (!isset($image)) {
            throw new Exception('No image file provided.');
        }

        if ($model->image && Storage::disk('public')->exists($this->getImagePath($model->image))) {
            Storage::disk('public')->delete($this->getImagePath($model->image));
        }

        $model->image = $this->handleImageUpload($image, $path);
    }

    public function deleteImage(object $model): void
    {
        if ($model->image && Storage::disk('public')->exists($this->getImagePath($model->image))) {
            Storage::disk('public')->delete($this->getImagePath($model->image));
        }

        $model->image = null;
    }

    protected function getImagePath(string $imageUrl): string
    {
        return str_replace(asset('storage/'), '', $imageUrl);
    }
}
