<?php

namespace App\Models;

use App\Core\Model;

class Tool extends Model
{

    static public function setDbColumns()
    {
        return ['id','image','name','description'];
    }

    static public function setTableName()
    {
        return "tools";
    }
}