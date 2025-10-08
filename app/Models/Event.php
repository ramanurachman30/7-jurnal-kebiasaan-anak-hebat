<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Event extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'events';

    protected $rules = [];

    protected $forms = [
        [
            'name' => 'bride_name',
            'required' => true,
            'column' => 5,
            'label' => 'Bride Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'groom_name',
            'required' => true,
            'column' => 5,
            'label' => 'Groom Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'wedding_date',
            'required' => true,
            'column' => 5,
            'label' => 'Wedding Name',
            'type' => 'date',
            'display' => true
        ],
        [
            'name' => 'vanue',
            'required' => true,
            'column' => 5,
            'label' => 'Vanue',
            'type' => 'textarea',
            'display' => true
        ],
        [
            'name' => 'maps',
            'required' => true,
            'column' => 5,
            'label' => 'Maps',
            'type' => 'textarea',
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'bride_name',
        'groom_name',
        'wedding_date',
        'vanue',
        'maps',
        'slug',
        'sound'
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

    public function contentInvitations()
    {
        return $this->hasOne(ContentInvitation::class, 'wedding_id');
    }
    public function invitation()
    {
        return $this->hasMany(Invitation::class, 'wedding_id', 'id');
    }
    public function eventschedule()
    {
        return $this->hasMany(EventSchedule::class, 'event_id', 'id');
    }
    public function sound()
    {
        return $this->belongsTo(Files::class, 'sound', 'code');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($event) {
            if (empty($event->slug)) {
                $brideSlug = Str::slug($event->bride_name, '-');
                $groomSlug = Str::slug($event->groom_name, '-');

                // Gabungkan dengan '&'
                $slug = "{$groomSlug}-&-{$brideSlug}";
                $count = Event::where('slug', 'LIKE', "{$slug}%")->count();

                $event->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
}
