<?php


namespace App\Traits;

trait ImageUpload
{
    public $imagePath;

    /**
     * Upload an Image.
     *
     * @param  \Illuminate\Http\UploadedFile $image
     * @param  string filesystem disk name $disk
     * @return $this
     */
    public function upload($image, $disk = 'public')
    {
        $this->imagePath = $image->store($this->getTable() . '/images', $disk);
        return $this;
    }
}
