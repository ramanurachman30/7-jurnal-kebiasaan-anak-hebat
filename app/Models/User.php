<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $rules = [
        'first_name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique'],
        'email' => ['required', 'email', 'max:255', 'unique'],
        'role' => ['required'],
        'password' => ['nullable', 'confirmed'],
    ];

    protected $fillable = [
        'id',
        'photo',
        'first_name',
        'last_name',
        'username',
        'email',
        'gender',
        'address',
        'phone_number',
        'password',
        'role'
    ];

    protected $forms = [
        [
            'name' => 'photo',
            'required' => false,
            'column' => 3,
            'label' => 'Photo',
            'type' => 'thumbnail',
            'display' => true
        ],
        [
            'name' => 'first_name',
            'required' => true,
            'column' => 3,
            'label' => 'First Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'last_name',
            'required' => true,
            'column' => 3,
            'label' => 'Last Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'username',
            'required' => true,
            'column' => 3,
            'label' => 'Username',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'email',
            'required' => true,
            'column' => 3,
            'label' => 'Email',
            'type' => 'email',
            'display' => true
        ],
        [
            'name' => 'gender',
            'required' => true,
            'column' => 2,
            'label' => 'Gender',
            'type' => 'sysparam',
            'options' => [
                'key' => 'key',
                'display' => 'value',
                'group' => 'Gender'
            ],
            'display' => true
        ],
        [
            'name' => 'address',
            'required' => true,
            'column' => 5,
            'label' => 'Address',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'phone_number',
            'required' => true,
            'column' => 3,
            'label' => 'Phone Number',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'password',
            'required' => true,
            'column' => 6, // max 9
            'label' => 'Password',
            'type' => 'password',
            'display' => false
        ],
        [
            'name' => 'role',
            'required' => true,
            'column' => 3,
            'label' => 'Role',
            'type' => 'select2',
            'options' => [
                'model' => 'roles', // table name
                'key' => 'id',
                'display' => 'name'
            ],
            'display' => true
        ],
        [
            'name' => 'status',
            'required' => true,
            'column' => 2,
            'label' => 'Status',
            'type' => 'sysparam',
            'options' => [
                'key' => 'key',
                'display' => 'value',
                'group' => 'Activation'
            ],
            'display' => true
        ],
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $reference = [
        'role',
        'status',
        'gender'
    ];

    protected $filesList = [
        'photo',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRules()
    {
        return $this->rules;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getFields()
    {
        return $this->fillable;
    }

    public function getForms()
    {
        return $this->forms;
    }

    public function getTableName()
    {
        return $this->table;
    }

    public function checkTableExists($table_name)
    {
        return Schema::hasTable($table_name);
    }

    public function getTableFields()
    {
        return Schema::getColumnListing($this->getTable());
    }

    public function getFilesList()
    {
        return $this->filesList;
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Sysparams::class, 'status', 'key')
            ->withTrashed()
            ->where('groups', 'Activation');
    }

    public function updateRules()
    {
        return false;
    }

    public function createRules()
    {
        return false;
    }

    public function gender()
    {
        return $this->belongsTo(Sysparams::class, 'gender', 'key')
            ->withTrashed()
            ->where('groups', 'Gender');
    }

    public function sluggable(): array
    {
        return [];
    }
}
