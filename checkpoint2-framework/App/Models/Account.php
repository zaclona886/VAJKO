<?php

namespace App\Models;

use App\Core\Model;

class Account extends Model
{
    public $id;
    public $name;
    public $password;
    public $date;

    static public function setDbColumns()
    {
        return ['id','name','password','date'];
    }

    static public function setTableName()
    {
        return "accounts";
    }
}