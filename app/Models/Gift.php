<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'gifts';

    protected $rules = [
        'content_invitation_id' => ['required', 'string', 'max:50'],
        'bank_id' => ['required', 'string', 'max:50'],
        'no_req' => ['required', 'string', 'max:50'],
        'receiver_name' => ['required', 'string', 'max:50'],
    ];

    protected $forms = [
        [
            'name' => 'content_invitation_id',
            'required' => true,
            'column' => 3,
            'label' => 'Content Invitation Id',
            'type' => 'text',
            'display' => true,
        ],
        [
            'name' => 'bank_id',
            'required' => true,
            'column' => 2,
            'label' => 'Bank',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'no_req',
            'required' => true,
            'column' => 4,
            'label' => 'No Rekening',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'receiver_name',
            'required' => true,
            'column' => 3,
            'label' => 'Receiver Name',
            'type' => 'text',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'content_invitation_id',
        'bank_id',
        'no_req',
        'receiver_name',
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
    public function bankAccount()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }
}
