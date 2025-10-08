<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class HeadTitles extends Resources
{
    use HasFactory;
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'head_titles';

    protected $rules = [
        'title_name' => ['required', 'string'],
        'description' => ['required', 'string'],
        'category' => ['required', 'string', 'unique'],
    ];

    protected $forms = [
        [
            'name' => 'content_type',
            'required' => true,
            'column' => 7,
            'label' => 'Content Type',
            'type' => 'sysparam',
            'options' => [
                'key' => 'key',
                'display' => 'value',
                'group' => 'Content'
            ],
            'display' => true
        ],
        [
            'name' => 'category',
            'required' => true,
            'column' => 7,
            'label' => 'Category',
            'type' => 'sysparam',
            'options' => [
                'key' => 'key',
                'display' => 'value',
                'group' => 'Head Title'
            ],
            'display' => true
        ],
        [
            'name' => 'title_name',
            'required' => true,
            'column' => 7,
            'label' => 'Title',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'description',
            'required' => true,
            'column' => 7,
            'label' => 'Description',
            'type' => 'textarea',
            'display' => true
        ],
    ];

    protected $fillable = [
        'id',
        'title_name',
        'description',
        'content_type',
    ];

    protected $reference = [
        'content_type',
        'category'
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

    public function content_type()
    {
        return $this->belongsTo(Sysparams::class, 'content_type', 'key')
            ->withTrashed()
            ->where('groups', 'Content');
    }

    public function category()
    {
        return $this->belongsTo(Sysparams::class, 'category', 'key')
            ->withTrashed()
            ->where('groups', 'Head Title');
    }

    public function sluggable(): array
    {
        return [];
    }
}
