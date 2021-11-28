<?php
require "Jutsu/Jutsu.php";
require "Jutsu/User.php";
require "Jutsu/DBJutsus.php";


class App
{
    private DBJutsus $storage;

    public function __construct()
    {
        $this->storage = new DBJutsus();
    }

    public function getAllJutsus()
    {
        return $this->storage->getAllJutsus();
    }
}