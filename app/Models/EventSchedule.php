<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSchedule extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'event_schedules';

    protected $rules = [];

    protected $forms = [
        [
            'name' => 'title',
            'required' => true,
            'column' => 3,
            'label' => 'Title',
            'type' => 'text',
            'display' => true,
        ],
        [
            'name' => 'description',
            'required' => true,
            'column' => 2,
            'label' => 'Desctiption',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'event_time',
            'required' => true,
            'column' => 4,
            'label' => 'Event Time',
            'type' => 'text',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'event_time',
        'event_id',
    ];

    public function getFields()
    {
        return $this->fillable;
    }
    public function getRules()
    {
        return $this->rules;
    }

    public function searchable() 
    {
        return false;
    }
}
