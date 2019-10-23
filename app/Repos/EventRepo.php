<?php


namespace App\Repos;


use App\Contracts\EventContract;
use App\Event;

class EventRepo implements EventContract
{
    public $event;

    public function createEvent($attributes)
    {
        $this->event = Event::create($attributes);
        return $this;
    }

//    public function inviteVisitors($attributes)
//    {
//        $this->event->visitors()->attach($attributes);
//        return $this;
//    }

    public function createEventLocation($attributes)
    {
        $this->event->locations()->create($attributes);
        return $this;
    }

    public function createEventImages($attributes)
    {
        if($this->checkAttributesAreExist($attributes)) {
            $this->event->images()->createMany($attributes);
        }
        return $this;
    }

    public function update($attributes)
    {
        if($this->checkAttributesAreExist($attributes)){
            $this->event->update($attributes);
        }
        return $this;
    }

    public function syncVisitors($attributes)
    {
        if($this->checkAttributesAreExist($attributes)){
            $this->event->visitors()->sync($attributes);
        }
        return $this;
    }

    public function updateEventLocation($attributes){
        if($this->checkAttributesAreExist($attributes)){
            $this->event->locations()->update($attributes);
        }
        return $this;
    }

    public function deleteEventImagesWhereIn($attributes){
        if($this->checkAttributesAreExist($attributes)){
            $this->event->images()->whereIn('id', $attributes)->delete();
        }
        return $this;
    }

    public function checkAttributesAreExist($attributes)
    {
        if(isset($attributes)){
            return true;
        }
        return false;
    }

    public function getAllEvents()
    {
        return Event::all();
    }

    public function publishEvent($event)
    {
        $event->update(['is_publish' => true]);
    }

    public function unPublishEvent($event)
    {
        $event->update(['is_publish' => false]);
    }
}
