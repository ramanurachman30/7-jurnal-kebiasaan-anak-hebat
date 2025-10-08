<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vocabularies extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'vocabularies';

    protected $rules = [
        'country_code' => ['required', 'string', 'max:5'],
        'key' => ['required', 'string', 'max:255'],
        'translate' => ['required', 'string', 'max:255']
    ];

    protected $forms = [
        [
            'name' => 'country_code',
            'required' => true,
            'column' => 3,
            'label' => 'Country Code',
            'type' => 'select',
            'options' => [
                'id' => 'Indonesia',
                'en' => 'English'
            ],
            'display' => true
        ],
        [
            'name' => 'key',
            'required' => true,
            'column' => 9,
            'label' => 'Kata Kunci',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'translate',
            'required' => true,
            'column' => 9,
            'label' => 'Terjemahan',
            'type' => 'text',
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'country_code',
        'key',
        'translate'
    ];

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
