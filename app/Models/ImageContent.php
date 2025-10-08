<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageContent extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'image_contents';

    protected $rules = [
        'content_invitations_id' => ['required'],
        'sort' => ['required', 'integer'],
        'name' => ['required', 'max:100', 'string'],
    ];

    protected $forms = [
        [
            'name' => 'content_invitations_id',
            'required' => true,
            'column' => 4,
            'label' => 'Content Invitations',
            'type' => 'select2',
            'options' => [
                'model' => 'content_invitations',
                'key' => 'id',
                'display' => 'title'
            ],
            'display' => true
        ],
        [
            'name' => 'sort',
            'required' => true,
            'column' => 5,
            'label' => 'Sort',
            'type' => 'number',
            'display' => true
        ],
        [
            'name' => 'name',
            'required' => true,
            'column' => 5,
            'label' => 'Name',
            'type' => 'text',
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'content_invitations_id',
        'sort',
        'name'
    ];

    protected $reference = [
        'content_invitations_id',
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

    public function content_invitations_id()
    {
        return $this->hasOne(ContentInvitation::class, 'id', 'content_invitations_id');
    }
    public function file()
    {
        return $this->hasOne(Files::class, 'code', 'name');
    }
}
