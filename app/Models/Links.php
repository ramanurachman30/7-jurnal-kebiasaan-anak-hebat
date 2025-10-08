<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Links extends Resources
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'links';
    protected $rules = [
        'type' => ['required'],
        'name' => ['required', 'string', 'max:255', 'unique'],
        'link' => ['required', 'url']
    ];

    protected $fillable = [
        'id',
        'type',
        'name',
        'link',
        'tooltiptext',
    ];

    protected $forms = [
        [
            'name' => 'type',
            'required' => true,
            'column' => 7,
            'label' => 'Type',
            'type' => 'select',
            'options' => [
                'sosmed' => 'Social Media',
                'web' => 'Website'
            ],
            'display' => true
        ],
        [
            'name' => 'name',
            'required' => true,
            'column' => 7,
            'label' => 'Name',
            'type' => 'text',
            'options' => [
                'fb' => 'Facebook',
                'tw' => 'Twitter',
                'ig' => 'Instagram',
                'yt' => 'Youtube',
                'in' => 'LinkendIn',
            ],
            'display' => true
        ],
        [
            'name' => 'link',
            'required' => true,
            'column' => 7,
            'label' => 'Link',
            'type' => 'text',
            'placeholder' => 'eg: https://www.oss.id/',
            'display' => true
        ],
        [
            'name' => 'tooltiptext',
            'required' => false,
            'column' => 7,
            'label' => 'Tooltip Text',
            'type' => 'text',
            'display' => false
        ],
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

    public function sluggable(): array
    {
        return [];
    }
}
