<?php


namespace App\Contracts;


interface EventContract
{
    public function createEvent($attributes);

    public function createEventLocation($attributes);

    public function createEventImages($attributes);

    public function update($attributes);

    public function syncVisitors($attributes);

    public function updateEventLocation($attributes);

    public function deleteEventImagesWhereIn($attributes);

    public function checkAttributesAreExist($attributes);
}
