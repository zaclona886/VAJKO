<?php

namespace App\Models;

use App\Core\Model;

class Character extends Model
{
    public $id;
    public $name;
    public $image1;
    public $image2;
    public $image3;
    public $text;

    static public function setDbColumns()
    {
        return ['id','name','image1','image2','image3','text'];
    }

    static public function setTableName()
    {
        return "characters";
    }
}