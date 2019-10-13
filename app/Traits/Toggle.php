<?php


namespace App\Traits;


trait Toggle
{
    public function toggleActive()
    {
        $this->update(["is_active" => !$this->is_active]);
    }

    public function togglePublish()
    {
        $this->update(["is_publish" => !$this->is_publish]);
    }
}
