<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'attendances';

    protected $rules = [
        'guest_id' => ['required'],
    ];

    protected $forms = [
        [
            'name' => 'guest_id',
            'required' => true,
            'column' => 4,
            'label' => 'Guest',
            'type' => 'select2',
            'options' => [
                'model' => 'invitations',
                'key' => 'id',
                'display' => 'name'
            ],
            'display' => true
        ],
        [
            'name' => 'check_in_time',
            'required' => false,
            'column' => 5,
            'label' => 'Check In time',
            'type' => 'datetime',
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'guest_id',
        'check_in_time'
    ];

    protected $reference = [
        'guest_id',
    ];


    public function getReference()
    {
        return $this->reference;
    }

    public function getFields()
    {
        return $this->fillable;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function guest_id()
    {
        return $this->hasOne(Invitation::class, 'id', 'guest_id');
    }
}
