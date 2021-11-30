<?php

namespace App\Models;

use App\Core\Model;

class Jutsu extends Model
{
    public $id;
    public $image;
    public $name;
    public $text;
    public $type;
    public $element;

    static public function setDbColumns()
    {
        return ['id','image','name','text','type','element'];
    }

    static public function setTableName()
    {
        return "jutsus";
    }

    /**
     * @return User[]
     * @throws \Exception
     */
    public function users()
    {
        return User::getAll("jutsu_id = ?",[intval($this->id)]);
    }
}