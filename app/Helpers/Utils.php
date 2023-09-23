<?php

namespace App\Helpers;

use App\Models\Checking;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public static function emptyImage()
    {
        return null;
    }

    public static function generateWo()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $employee = Employee::with('client')->where('user_id', $user->id)->first();
        $lastNumber = Checking::where('client_id', $employee->client->id)->orderByDesc('number')->pluck('number')->first();

        $nextNumber = (int)$lastNumber + 1;

        $formattedNextNumber = sprintf('%06d', $nextNumber);
        $main = 'BBI';
        $current_year = $now->year;
        $client_code = $employee->client->code;

        $finalWo = $main . '-' . $current_year . '-' . $client_code . '-' . $formattedNextNumber;
        return $finalWo;
    }
}
