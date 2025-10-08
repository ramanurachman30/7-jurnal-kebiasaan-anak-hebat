<?php
namespace App\Services;

use App\Models\EventSchedule;

class EventScheduleService
{
    public function store($data, $eventId)
    {
        foreach ($data as $key => $value) {
            EventSchedule::create([
                'title' => $value['title'],
                'description'=>$value['description'],
                'event_time' => $value['event_time'],
                'event_id' => $eventId
            ]);
        }
    }
}
