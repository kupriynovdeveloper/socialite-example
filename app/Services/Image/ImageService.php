<?php

namespace App\Services\Image;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function uploadImage(Post $post, array $files): void
    {
        foreach ($files as $file) {
            /** @var $file UploadedFile */
            if (! file_exists(storage_path('app/public/images/'.$file->getClientOriginalName()))) {
                $filePath = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
                Image::create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $filePath,
                    'post_id' => $post->id
                ]);
            }
        }
    }
}
