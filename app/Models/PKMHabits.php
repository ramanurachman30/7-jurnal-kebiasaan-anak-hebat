<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKMHabits extends Resources
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'p_k_m_habits';

    protected $rules = [
        'habit_name' => ['required', 'string', 'max:50'],
        'habit_description' => ['required', 'string', 'max:255'],
    ];

    protected $forms = [
        [
            'name' => 'habit_name',
            'required' => true,
            'column' => 3,
            'label' => 'Habit Name',
            'type' => 'text',
            'display' => true,
        ],
        [
            'name' => 'habit_description',
            'required' => true,
            'column' => 2,
            'label' => 'Habit Description',
            'type' => 'textarea',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'habit_name',
        'habit_description',
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
