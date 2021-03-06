<?php

namespace App\Models;

use App\Core\Model;

class Tool extends Model
{
    public $id;
    public $image;
    public $name;
    public $description;
    public $wielders;

    static public function setDbColumns()
    {
        return ['id','image','name','description','wielders'];
    }

    static public function setTableName()
    {
        return "tools";
    }
}