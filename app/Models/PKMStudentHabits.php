<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKMStudentHabits extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'p_k_m_student_habits';

    protected $rules = [
        'student_id' => ['required', 'string', 'max:50'],
        'habit_id' => ['required', 'string', 'max:50'],
        'date' => ['required', 'string', 'max:50'],
        'is_checked' => ['required', 'string', 'max:50'],
    ];

    protected $forms = [
        [
            'name' => 'student_id',
            'required' => true,
            'column' => 3,
            'label' => 'Student Id',
            'type' => 'select2',
            'options' => [
                'model' => 'p_k_m_students',
                'key' => 'id',
                'display' => 'student_name',
            ],
            'display' => true,
        ],
        [
            'name' => 'habit_id',
            'required' => true,
            'column' => 2,
            'label' => 'Habit Id',
            'type' => 'select2',
            'options' => [
                'model' => 'p_k_m_habits',
                'key' => 'id',
                'display' => 'habit_name',
            ],
            'display' => true
        ],
        [
            'name' => 'date',
            'required' => true,
            'column' => 4,
            'label' => 'Date',
            'type' => 'date',
            'display' => true
        ],
        [
            'name' => 'is_checked',
            'required' => true,
            'column' => 3,
            'label' => 'Is Checked',
            'type' => 'checkbox',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'student_id',
        'habit_id',
        'date',
        'is_checked',
    ];

    protected $reference = [
        'student_id',
        'habit_id',
    ];

    public function getFields()
    {
        return $this->fillable;
    }
    public function getForms()
    {
        return $this->forms;
    }
    public function getRules()
    {
        return $this->rules;
    }
    public function getReference()
    {
        return $this->reference;
    }

    public function searchable() 
    {
        return false;
    }
    public function student_id()
    {
        return $this->belongsTo(PKMStudents::class, 'student_id', 'id');
    }
    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function habit_id()
    {
        return $this->belongsTo(PKMHabits::class, 'habit_id', 'id');
    }
}
