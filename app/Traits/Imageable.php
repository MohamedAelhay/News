<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait Imageable
{
    public function createImageable($owner, $location, $image)
    {
        $owner->images()->create(['image' => $this->upload($location, $image)]);
    }

    public function upload($location, $image)
    {
        return Storage::putFile($location, $image);
    }
}
