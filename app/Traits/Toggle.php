<?php


namespace App\Traits;


trait Toggle
{
    public function updateStatus()
    {
        $this->update(["is_active" => !$this->is_active]);    }
}
