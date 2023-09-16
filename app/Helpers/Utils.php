<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class Utils
{

    public static function uploadImage($image, $width)
    {
        $img = Image::make($image);
        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio(); // Maintain aspect ratio
        });
        $img->encode('jpg', 80); // Compress the image (quality: 80%)

        // Generate a unique filename for the processed image
        $processedImageName = time() . '_' . uniqid() . '.jpg';

        // Save the processed image to storage
        $processedImagePath = 'public/' . $processedImageName;
        Storage::put($processedImagePath, $img->stream());

        // Generate the storage link for the processed image
        $storageLink = Storage::url($processedImagePath);
        return $storageLink;
    }

    public static function generateEmail($name)
    {
        // Menghilangkan spasi dan mengubah huruf menjadi lowercase
        $fullName = strtolower(str_replace(' ', '.', $name));
        
        // Menghasilkan alamat email dengan format "nama@domain.com"
        $email = $fullName . '@bukbeng.com';

        return $email;
    }
}
