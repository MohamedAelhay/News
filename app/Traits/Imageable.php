<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait Imageable
{
    public function createImageable($owner, $image)
    {
        $owner->images()->create(['image' => $this->upload($image)]);
    }

    public function upload($image)
    {
        return Storage::putFile($this->uploadLocation, $image);
    }
}
