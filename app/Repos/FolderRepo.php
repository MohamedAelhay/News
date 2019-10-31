<?php


namespace App\Repos;

use App\Folder;

class FolderRepo
{
    public $folder;

    public function __construct(Folder $folder)
    {
        $this->folder = $folder;
    }

    public function folderIndex()
    {
        return Folder::all();
    }

    public function createFolder($attributes)
    {
        return $this->folder::create($attributes);
    }

    public function findOrFailFolder($folder)
    {
        $this->folder = $this->folder::findOrFail($folder)->first();
        return $this;
    }

    public function updateFolder($attributes)
    {
        $this->folder = $this->folder->update($attributes);
        return $this;
    }

    public function deleteFolder()
    {
        $this->folder->delete();
        return $this;
    }
}
