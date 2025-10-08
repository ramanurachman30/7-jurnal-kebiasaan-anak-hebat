<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'banks';

    protected $rules = [];

    protected $createRules = [
        'image' => ['required', 'mimes:jpg,jpeg,png,webp,mp3', 'max:2048'],
    ];

    protected $updateRules = [
        'image' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
    ];

    protected $forms = [
        [
            'name' => 'image',
            'required' => true,
            'column' => 5,
            'label' => 'Logo',
            'type' => 'fileupload',
            'display' => true,
            'size' => 5000000,
            'acept' => '*'
        ],
        [
            'name' => 'name',
            'required' => true,
            'column' => 7,
            'label' => 'Bama Bank',
            'type' => 'text',
            'display' => true
        ]
    ];

    protected $fillable = [
        'id',
        'image',
        'name',
    ];

    protected $reference = [
        'image'
    ];

    protected $filesList = [
        'image'
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

    public function createRules()
    {
        return $this->createRules;
    }

    public function updateRules()
    {
        return $this->updateRules;
    }

    public function getFilesList()
    {
        return $this->filesList;
    }

    public function image()
    {
        return $this->belongsTo(Files::class, 'image', 'code');
    }
    
}
