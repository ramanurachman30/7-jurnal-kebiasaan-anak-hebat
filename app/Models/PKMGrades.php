<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKMGrades extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'p_k_m_grades';

    protected $rules = [
        'grade_name' => ['required', 'string', 'max:50'],
        'grade_code' => ['required', 'string', 'max:50'],
        'level_order' => ['required','unique', 'int'],
        'description' => ['required', 'string', 'max:50'],
    ];

    protected $forms = [
        [
            'name' => 'grade_name',
            'required' => true,
            'column' => 3,
            'label' => 'Grade Name',
            'type' => 'text',
            'display' => true,
        ],
        [
            'name' => 'grade_code',
            'required' => true,
            'column' => 2,
            'label' => 'Grade Code',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'level_order',
            'required' => true,
            'column' => 2,
            'label' => 'Level Kelas',
            'type' => 'number',
            'display' => false
        ],
        [
            'name' => 'description',
            'required' => true,
            'column' => 2,
            'label' => 'Deskripsi',
            'type' => 'text',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'grade_name',
        'grade_code',
        'level_order',
        'description',
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
