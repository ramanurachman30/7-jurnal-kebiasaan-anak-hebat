<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Resources extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $guard_name = 'web';

    protected $forms = [];

    protected $reference = [];

    public function getForms()
    {
        return $this->forms;
    }

    public function getTableFields()
    {
        return Schema::getColumnListing($this->getTable());
    }

    public function getFilesList()
    {
        return [];
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function createRules()
    {
        return false;
    }

    public function updateRules()
    {
        return false;
    }

    public function checkTableExists($table_name)
    {
        return Schema::hasTable($table_name);
    }

    public function sluggable(): array
    {
        // return [
        //     'slug' => [
        //         'source' => ['title', 'name', 'minister_name']
        //     ]
        // ];
        return [];
    }
}
