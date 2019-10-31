<?php


namespace App\Services;


use App\Repos\FolderRepo;

class FolderService
{
    public $folderRepo;

    public function __construct(FolderRepo $repo)
    {
        $this->folderRepo = $repo;
    }

    public function getAllFolders()
    {
        return $this->folderRepo->folderIndex();
    }

    public function createNewFolder($attributes)
    {
        return $this->folderRepo->createFolder($attributes);
    }

    public function getFolder($folder)
    {
        $this->folderRepo = $this->folderRepo->findOrFailFolder($folder);
        return $this->folderRepo->folder;
    }

    public function updateFolder($attributes, $folder)
    {
        $this->folderRepo = $this->folderRepo->findOrFailFolder($folder->id)
                                             ->updateFolder($attributes);

        return $this->folderRepo->folder;
    }

    public function destroyFolder($folder)
    {
        $this->folderRepo->findOrFailFolder($folder)
                         ->deleteFolder();
    }
}
