<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'menus';

    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'type' => ['required', 'string', 'max:20']
    ];

    protected $forms = [
        [
            'name' => 'parent_id',
            'required' => false,
            'column' => 12,
            'label' => 'Groups',
            'type' => 'select2',
            'options' => [
                'model' => 'menus',
                'key' => 'id',
                'display' => 'title',
                'filter' => [
                    "parent_id" => "IS NULL",
                    "type" => "sidebar"
                ]
            ],
            'display' => true
        ],
        [
            'name' => 'title',
            'required' => true,
            'column' => 12,
            'label' => 'Title',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'icon',
            'required' => false,
            'column' => 12,
            'label' => 'Icon',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'url',
            'required' => false,
            'column' => 12,
            'label' => 'URL',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'type',
            'required' => true,
            'column' => 12,
            'label' => 'Type',
            'type' => 'select',
            'options' => [
                'sidebar' => 'Sidebar',
                'header' => 'Header',
            ],
            'display' => true
        ],
        [
            'name' => 'order',
            'required' => false,
            'column' => 12,
            'label' => 'order',
            'type' => 'text',
            'display' => true
        ]
    ];

    protected $fillable = [
        'parent_id',
        'title',
        'icon',
        'url',
        'type',
        'order',
        'is_active',
    ];
    protected $reference = [
        'parent_id'
    ];
    public function parent_id()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function getFields()
    {
        return $this->fillable;
    }
    public function getRules()
    {
        return $this->rules;
    }
    public function sluggable(): array
    {
        return [];
    }
}
