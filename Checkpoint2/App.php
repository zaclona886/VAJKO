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
            $this->storage->addUser(new User(jutsu_id: $_POST['jutsu_id'], name: $_POST['name']));
        }

        if (isset($_POST['deleteJutsu'])) {
            $this->storage->deleteUser($_POST['jutsu_id']);
            $this->storage->deleteJutsu($_POST['jutsu_id']);
        }

        if (isset($_POST['rewriteURL'])) {
            $image_url = $_POST['newURL'];
            $image_check = substr($image_url, -4);
            if (!($image_check == '.jpg' || $image_check == '.png')) {
                echo 'Neplatne udaje';
                return;
            }

            $this->storage->rewriteURL($_POST['jutsu_id'],$_POST['newURL']);
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