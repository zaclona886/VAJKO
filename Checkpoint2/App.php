<?php
require "Jutsu/Jutsu.php";
require "Jutsu/User.php";
require "Jutsu/DBJutsus.php";


class App
{
    private DBJutsus $storage;

    public function __construct()
    {
        $a = 1;
        $this->storage = new DBJutsus();
        if (isset($_POST['jutsu'])) {

           $image_url = $_POST['url'];
            $image_check = substr($image_url, -4);
            if (!($image_check == '.jpg' || $image_check == '.png')) {
                echo 'Neplatne udaje';
                return;
            }
            $this->storeJutsu();
        }


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

    private function storeJutsu()
    {
        $newJutsu = new Jutsu(image: $_POST['url'],name: $_POST['name'],
            text: $_POST['text'],type: $_POST['type'],element: $_POST['element']);
        $this->storage->storeJutsu($newJutsu);
    }
}