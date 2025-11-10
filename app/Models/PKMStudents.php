<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKMStudents extends Resources
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'p_k_m_students';

    protected $rules = [
        'student_name' => ['required', 'string', 'max:50'],
        'user_id' => ['required', 'string', 'max:50'],
        'grade_id' => ['required', 'string', 'max:50'], 
    ];

    protected $forms = [
        [
            'name' => 'student_name',
            'required' => true,
            'column' => 3,
            'label' => 'Student Name',
            'type' => 'text',
            'display' => true,
        ],
        [
            'name' => 'user_id',
            'required' => true,
            'column' => 3,
            'label' => 'User Id',
            'type' => 'select2',
            'options' => [
                'model' => 'users',
                'key' => 'id',
                'display' => 'name',
            ],
            'display' => true,
        ],
        [
            'name' => 'grade',
            'required' => true,
            'column' => 2,
            'label' => 'Grade',
            'type' => 'select2',
            'options' => [
                'model' => 'p_k_m_grades',
                'key' => 'id',
                'display' => 'grade_name',
            ],
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'student_name',
        'user_id',
        'grade_id',
    ];

    protected $reference = [
        'user_id',
        'grade',
    ];

    public function getFields()
    {
        return $this->fillable;
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
    public function grade()
    {
        return $this->belongsTo(PKMGrades::class, 'grade_id');
    }
    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
