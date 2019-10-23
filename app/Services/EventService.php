<?php


namespace App\Services;


use App\Event;
use App\Mail\EventInvitations;
use App\Visitor;
use App\Contracts\EventContract;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class EventService
{
    protected $eventRepo;

    public function __construct(EventContract $repo)
    {
        $this->eventRepo = $repo;
    }

    public function eventIndexByDataTables()
    {
        return DataTables::eloquent(Event::query())
            ->addColumn('actions', function ($event){
                return view('events.actions', compact('event'));
            })
            ->toJson();
    }

    public function getVisitorUsers()
    {
        return Visitor::visitorUser()->get();
    }

    public function store($attributes)
    {
        $attributes = $this->getDateAndTime($attributes);

        $this->eventRepo->createEvent($attributes)
                        ->syncVisitors($attributes['visitors'])
                        ->createEventLocation($attributes)
                        ->createEventImages($this->getAttr('image', $attributes['images']));

        $users = $this->getVisitorsDetails($this->eventRepo->event->visitors);
        Mail::to($users)->send(new EventInvitations($this->eventRepo->event));
    }

    public function getVisitorsDetails($visitors)
    {
        $users = [];
        foreach ($visitors as $visitor)
        {
            $users[] = $visitor->user;
        }
        return $users;
    }

    public function getDateAndTime($attributes){
        $attributes['start_date'] = $attributes['start_date'] . ' ' . $attributes['start_time'];
        $attributes['end_date'] = $attributes['end_date'] . ' ' . $attributes['end_time'];
        unset($attributes['start_time']);
        unset($attributes['end_time']);
        return $attributes;
    }

    public function getAttr($attr, $inputs)
    {
        $arr = array();
        foreach($inputs as $input){
            $arr[] = [$attr=>$input];
        }
        return $arr;
    }

    public function getVisitorsId($event)
    {
        return $event->visitors->pluck('id')->toArray();
    }

    public function updateEvent($attributes, $event)
    {
        $this->eventRepo->event = $event;
        $attributes = $this->getDateAndTime($attributes);

        $this->eventRepo->update($attributes->all())
                        ->syncVisitors($attributes->input('visitors'))
                        ->updateEventLocation($attributes->only('address', 'latitude', 'longitude'))
                        ->deleteEventImagesWhereIn($attributes->input('deleted_images'))
                        ->createEventImages($this->getAttr('image', $attributes->input('images')));
    }

    public function publishEvents()
    {
        $events = $this->eventRepo->getAllEvents();
        foreach ($events as $event)
        {
            if($event->start_date <= now('Africa/Cairo') && $event->end_date > now('Africa/Cairo'))
            {
                $this->eventRepo->publishEvent($event);
            }
            elseif ($event->is_publish && $event->end_date < now())
            {
                $this->eventRepo->unPublishEvent($event);
            }
        }
    }
}
