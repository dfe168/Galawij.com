<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;



class StoreImageFileAction
{
    /**
     * Store Image 
     */
    public function handle(UploadedFile $image): string
    {
        $imgName = (string) uniqid() . "." . $image->getClientOriginalExtension();

        Storage::disk('public')
            ->putFileAs('paintings', $image, $imgName);

        return $imgName;
    }
}
