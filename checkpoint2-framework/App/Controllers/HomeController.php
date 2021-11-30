<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Models\Jutsu;
use App\Models\User;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{

    public function index()
    {
        return $this->html(
            []
        );

    }

    public function characters()
    {
        return $this->html(
            []
        );
    }

    public function jutsu()
    {
        $jutsu = Jutsu::getAll();
        return $this->html($jutsu);
    }

    private function loadJutsu(){
        header("Location: ?c=home&a=jutsu");
        return $this->html();
    }

    public function addJutsu()
    {
        if (isset($_POST['jutsu'])) {

            $image_url = $_POST['url'];
            $image_check = substr($image_url, -4);
            if (!($image_check == '.jpg' || $image_check == '.png')) {
                echo 'Neplatne udaje';
                $this->loadJutsu();
                return;
            }

            $newJutsu = new Jutsu();
            $newJutsu->image = $_POST['url'];
            $newJutsu->name = $_POST['name'];
            $newJutsu->text = $_POST['text'];
            $newJutsu->type = $_POST['type'];
            $newJutsu->element = $_POST['element'];
            $newJutsu->save();
        }

        $this->loadJutsu();
    }

    public function addUser()
    {
        if (isset($_POST['user'])) {
            $newUser = new User();
            $newUser->jutsu_id = ($_POST['jutsu_id']);
            $newUser->name = ($_POST['name']);
            $newUser->save();
        }

        $this->loadJutsu();
    }

    public function iconAction()
    {
        if (isset($_POST['deleteJutsu'])) {
            Connection::connect()->prepare("DELETE FROM users WHERE jutsu_id=?")->execute([$_POST["jutsu_id"]]);
            Connection::connect()->prepare("DELETE FROM jutsus WHERE id=?")->execute([$_POST["jutsu_id"]]);
        }

        if (isset($_POST['rewriteURL'])) {

            $image_url = $_POST['newURL'];
            $image_check = substr($image_url, -4);
            if (!($image_check == '.jpg' || $image_check == '.png')) {
                echo 'Neplatne udaje';
                $this->loadJutsu();
                return;
            }
            Connection::connect()->prepare("UPDATE jutsus SET image=? WHERE id=?")->execute([$_POST['newURL'],$_POST["jutsu_id"]]);
        }

        $this->loadJutsu();
    }
    

}