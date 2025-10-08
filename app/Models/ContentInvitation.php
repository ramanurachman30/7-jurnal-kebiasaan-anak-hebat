<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentInvitation extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'content_invitations';

    protected $rules = [
        'title' => ['required', 'max:100', 'string'],
        'wedding_id' => ['required'],
        'daughter' => ['required', 'max:100', 'string'],
        'son' => ['required', 'max:100', 'string'],
        'bride_father' => ['required', 'max:100', 'string'],
        'bride_mother' => ['required', 'max:100', 'string'],
        'groom_father' => ['required', 'max:100', 'string'],
        'groom_mother' => ['required', 'max:100', 'string'],
        'bride_date' => ['required', 'date'],
        'groom_date' => ['required', 'date'],
        'forewords' => ['required', 'max:100', 'string'],
    ];

    protected $forms = [
        [
            'name' => 'title',
            'required' => true,
            'column' => 5,
            'label' => 'Title',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'wedding_id',
            'required' => true,
            'column' => 5,
            'label' => 'Weddings',
            'type' => 'select2',
            'options' => [
                'model' => 'events',
                'key' => 'id',
                'display' => 'vanue'
            ],
            'display' => true
        ],
        [
            'name' => 'template_id',
            'required' => true,
            'column' => 5,
            'label' => 'Template',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'daughter',
            'required' => true,
            'column' => 5,
            'label' => 'Daughter',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'son',
            'required' => true,
            'column' => 5,
            'label' => 'Son',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'bride_father',
            'required' => true,
            'column' => 5,
            'label' => 'Bride Father',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'bride_mother',
            'required' => true,
            'column' => 5,
            'label' => 'Bride Mother',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'groom_father',
            'required' => true,
            'column' => 5,
            'label' => 'Groom Father',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'groom_mother',
            'required' => true,
            'column' => 5,
            'label' => 'Groom Father',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'bride_date',
            'required' => true,
            'column' => 5,
            'label' => 'Bride Date',
            'type' => 'date',
            'display' => true
        ],
        [
            'name' => 'groom_date',
            'required' => true,
            'column' => 5,
            'label' => 'Groom Date',
            'type' => 'date',
            'display' => true
        ],
        [
            'name' => 'forewords',
            'required' => true,
            'column' => 5,
            'label' => 'Foreword',
            'type' => 'text',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'title',
        'wedding_id',
        'template_id',
        'daughter',
        'son',
        'bride_father',
        'bride_mother',
        'groom_father',
        'groom_mother',
        'bride_date',
        'groom_date',
        'forewords',
    ];

    protected $reference = [
        'wedding_id',
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

    public function wedding_id()
    {
        return $this->hasOne(Event::class, 'id', 'wedding_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'wedding_id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function imageContents()
    {
        return $this->hasMany(ImageContent::class, 'content_invitations_id')->with('file');
    }
    public function gift()
    {
        return $this->hasMany(Gift::class, 'content_invitation_id');
    }
}
