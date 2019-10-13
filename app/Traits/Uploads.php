<?php


namespace App\Traits;

trait Uploads
{
    public $imagePath;
    public $filePath;

    /**
     * Upload an Image.
     *
     * @param  \Illuminate\Http\UploadedFile $image
     * @param  string filesystem disk name $disk
     * @return $this
     */
    public function imageUpload($image, $disk = 'public')
    {
        $this->imagePath = $image->store($this->getTable() . '/images', $disk);
        return $this;
    }

    public function fileUpload($file, $disk = 'public')
    {
        $this->filePath = $file->store($this->getTable() . 'files', $disk);
        return $this;
    }
}
