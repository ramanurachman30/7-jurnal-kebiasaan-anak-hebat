<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class LinkCollections extends Resources
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'link_collections';
    protected $rules = [
        'type' => ['required'],
        'name' => ['required', 'string', 'max:255', 'unique'],
        'slug' => ['required', 'string', 'alpha_dash', 'unique'],
        'link' => ['required', 'url'],
        'ordering' => ['required'],
    ];

    protected $createRules = [
        'image' => ['image', 'webp'],
    ];

    protected $fillable = [
        'id',
        'type',
        'name',
        'slug',
        'link',
        'tooltip_text',
    ];

    protected $forms = [
        [
            'name' => 'type',
            'required' => true,
            'column' => 7,
            'label' => 'Type',
            'type' => 'sysparam',
            'options' => [
                'key' => 'key',
                'display' => 'value',
                'group' => 'Link'
            ],
            'display' => true
        ],
        [
            'name' => 'image',
            'required' => false,
            'column' => 7,
            'label' => 'Image',
            'type' => 'fileupload',
            'display' => false,
            'info' => 'Recomended: webp Max: 2MB, Size: 222 x 273',
            'accept' => 'image/webp',
        ],
        [
            'name' => 'name',
            'required' => true,
            'column' => 7,
            'label' => 'Name',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'slug',
            'required' => true,
            'column' => 7,
            'label' => 'Slug',
            'type' => 'text',
            'display' => true
        ],
        [
            'name' => 'link',
            'required' => true,
            'column' => 7,
            'label' => 'Link',
            'type' => 'text',
            'placeholder' => 'eg: https://www.sync.id/',
            'display' => true
        ],
        [
            'name' => 'tooltip_text',
            'required' => false,
            'column' => 7,
            'label' => 'Tooltip Text',
            'type' => 'text',
            'display' => false
        ],
        [
            'name' => 'ordering',
            'required' => true,
            'column' => 2,
            'label' => 'Ordering',
            'type' => 'number',
            'display' => false,
            // 'info' => '',
        ],
    ];

    protected $reference = [
        'type',
        'image',
    ];

    protected $filesList = [
        'image',
    ];

    public function getRules()
    {
        return $this->rules;
    }

    public function getFilesList()
    {
        return $this->filesList;
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

    public function type()
    {
        return $this->belongsTo(Sysparams::class, 'type', 'key')
            ->withTrashed()
            ->where('groups', 'Link');
    }

    public function image()
    {
        return $this->belongsTo(Files::class, 'image', 'code');
    }
}
