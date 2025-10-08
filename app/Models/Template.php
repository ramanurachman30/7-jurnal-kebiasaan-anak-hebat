<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'templates';

    protected $rules = [
        'name' => ['required', 'string', 'max:100'],
        'file_name' => ['required', 'string', 'max:100'],
    ];

    protected $forms = [
        [
            'name' => 'name',
            'required' => true,
            'column' => 10,
            'label' => 'Nama Tema',
            'type' => 'text',
            'display' => true,
        ],
        [
            'name' => 'file_name',
            'required' => true,
            'column' => 10,
            'label' => 'File Name',
            'type' => 'text',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'name',
        'file_name',
    ];

    public function getFields()
    {
        return $this->fillable;
    }
    public function getRules()
    {
        return $this->rules;
    }
}
