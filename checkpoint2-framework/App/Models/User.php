<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public $id;
    public $jutsu_id;
    public $name;

    static public function setDbColumns()
    {
        return ['id','jutsu_id','name'];
    }

    static public function setTableName()
    {
        return "users";
    }
}