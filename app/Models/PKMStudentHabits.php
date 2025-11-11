<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PKMStudentHabits extends Resources
{
    use HasFactory, SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'p_k_m_student_habits';

    protected $fillable = [
        'student_id',
        'habit_id',
        'date',
        'is_checked',
    ];

    protected $rules = [
        'student_id' => ['required', 'integer'],
        'habit_id' => ['required', 'integer'],
        'date' => ['required', 'date'],
        'is_checked' => ['boolean'],
    ];

    protected $forms = [
        [
            'name' => 'student_id',
            'required' => true,
            'column' => 3,
            'label' => 'Nama Murid',
            'type' => 'select2',
            'options' => [
                'model' => 'p_k_m_students',       // ✅ sekarang ambil dari tabel users
                'key' => 'id',
                'display' => 'student_name',
            ],
            'display' => true,
        ],
        [
            'name' => 'grade_name',
            'required' => false,
            'column' => 3,
            'label' => 'Kelas',
            'type' => 'text', // readonly / display only
            'display' => true,
        ],
        [
            'name' => 'habit_id',
            'required' => true,
            'column' => 3,
            'label' => 'Kebiasaan',
            'type' => 'select2',
            'options' => [
                'model' => 'p_k_m_habits',
                'key' => 'id',
                'display' => 'habit_name',
            ],
            'display' => true,
        ],
        [
            'name' => 'date',
            'required' => true,
            'column' => 3,
            'label' => 'Tanggal',
            'type' => 'date',
            'display' => true,
        ],
        [
            'name' => 'is_checked',
            'required' => false,
            'column' => 2,
            'label' => 'Ter Ceklis',
            'type' => 'checkbox',
            'display' => true,
        ],
    ];

    protected $reference = [
        'student_id',
        'student_id.grade',
        'habit_id',
    ];
    public function student_id()
    {
        // ✅ student_id sekarang relasi ke model User
        return $this->belongsTo(PKMStudents::class, 'student_id');
    }

    public function habit_id()
    {
        return $this->belongsTo(PKMHabits::class, 'habit_id', 'id');
    }

    // === FUNGSI TAMBAHAN ===
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
}
