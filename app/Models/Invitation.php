<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Invitation extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'invitations';

    protected $rules = [
        'wedding_id' => ['required'],
        'name' => ['required', 'string', 'max:100'],
        'phone' => ['required', 'string', 'max:20'],
    ];

    protected $forms = [
        [
            'name' => 'wedding_id',
            'required' => true,
            'column' => 4,
            'label' => 'Weddings',
            'type' => 'select2',
            'options' => [
                'model' => 'events',
                'key' => 'id',
                'display' => 'slug'
            ],
            'display' => true
        ],
        [
            'name' => 'name',
            'required' => true,
            'column' => 5,
            'label' => 'Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'email',
            'required' => false,
            'column' => 5,
            'label' => 'Email',
            'type' => 'email',
            'display' => true
        ],
        [
            'name' => 'phone',
            'required' => true,
            'column' => 5,
            'label' => 'Phone',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'address',
            'required' => true,
            'column' => 5,
            'label' => 'Address',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'qr_code',
            'required' => false,
            'column' => 5,
            'label' => 'QR Code',
            'type' => 'textarea',
            'hidden' => true,
            'display' => true
        ],
        [
            'name' => 'is_attending',
            'required' => false,
            'column' => 5,
            'label' => 'Is Attending',
            'type' => 'sysparam',
            'options' => [
                'key' => 'key',
                'display' => 'value',
                'group' => 'IsAttending'
            ],
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'wedding_id',
        'name',
        'email',
        'phone',
        'qr_code',
        'is_attending',
        'address',
        'slug'
    ];

    protected $reference = [
        'wedding_id',
        'is_attending'
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

    public function is_attending()
    {
        return $this->belongsTo(Sysparams::class, 'is_attending', 'key')
            ->withTrashed()
            ->where('groups', 'IsAttending');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($invitation) {
            if (empty($invitation->slug)) {
                $slug = Str::slug($invitation->name, '-');
                $count = Invitation::where('slug', 'LIKE', "{$slug}%")->count();

                $invitation->slug = $count ? "{$slug}-{$count}" : $slug;
            }
            if (empty($invitation->qr_code)) {
                $invitation->qr_code = Str::uuid()->toString();
            }
        });
    }
}
