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

        if (isset($_POST['user'])) {
            if ($_POST['name'] != "") {
                $this->storage->addUser(new User(jutsu_id: $_POST['jutsu_id'], name: $_POST['name']));
            }
        }
    }
    public function getAllJutsus()
    {
        return $this->storage->getAllJutsus();
    }
}