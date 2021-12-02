<?php

namespace App\Controllers;

use App\Controllers\AControllerRedirect;
use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Models\Jutsu;
use App\Models\User;
use App\Models\Character;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html([]);
    }

    public function characters()
    {
        $characters = Character::getAll();
        return $this->html($characters);
    }

    public function addCharacter()
    {
        if (isset($_POST['addCharacter'])) {
            $image_check1 = substr($_POST['url1'], -4);
            $image_check2 = substr($_POST['url2'], -4);
            $image_check3 = substr($_POST['url3'], -4);
            if (!($image_check1 == '.jpg' || $image_check1 == '.png')) {
                $this->redirect('home','characters', ['error' => 'URL adress is not an image!']);
                return;
            }

            if (!($image_check2 == '.jpg' || $image_check2 == '.png')) {
                $this->redirect('home','characters', ['error' => 'URL adress is not an image!']);
                return;
            }

            if (!($image_check3 == '.jpg' || $image_check3 == '.png')) {
                $this->redirect('home','characters', ['error' => 'URL adress is not an image!']);
                return;
            }

            $character = new Character();
            $character->image1 = $_POST['url1'];
            $character->image2 = $_POST['url2'];
            $character->image3 = $_POST['url3'];
            $character->name = $_POST['name'];
            $character->text = $_POST['text'];
            $character->save();
        }

        $this->redirect('home','characters', ['succes' => 'Character added succesfully!']);
    }

    public function jutsu()
    {
        $jutsus = Jutsu::getAll();
        return $this->html($jutsus);
    }

    public function addJutsu()
    {
        if (isset($_POST['addJutsu'])) {
            $image_check = substr($_POST['url'], -4);
            if (!($image_check == '.jpg' || $image_check == '.png')) {
                $this->redirect('home','jutsu', ['error' => 'URL adress is not an image!']);
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

        $this->redirect('home','jutsu', ['succes' => 'Jutsu added succesfully!']);
    }

    public function addUser()
    {
        if (isset($_POST['user'])) {
            $newUser = new User();
            $newUser->jutsu_id = ($_POST['jutsu_id']);
            $newUser->name = ($_POST['name']);
            $newUser->save();
        }
        $this->redirect('home','jutsu');
    }

    public function iconAction()
    {
        if (isset($_POST['deleteJutsu'])) {
            Connection::connect()->prepare("DELETE FROM users WHERE jutsu_id=?")->execute([$_POST["jutsu_id"]]);
            Connection::connect()->prepare("DELETE FROM jutsus WHERE id=?")->execute([$_POST["jutsu_id"]]);
            $this->redirect('home','jutsu', ['succes' => 'Jutsu deleted succesfully!']);
        }

        if (isset($_POST['rewriteURL'])) {

            $image_url = $_POST['newURL'];
            $image_check = substr($image_url, -4);
            if (!($image_check == '.jpg' || $image_check == '.png')) {
                $this->redirect('home','jutsu', ['error' => 'URL adress is not an image!']);
                return;
            }
            Connection::connect()->prepare("UPDATE jutsus SET image=? WHERE id=?")->execute([$_POST['newURL'],$_POST["jutsu_id"]]);
            $this->redirect('home','jutsu', ['succes' => 'IMG url changed succesfully!']);
        }
    }

    public function deleteCharacter()
    {
        if (isset($_POST['deleteCharacter'])) {
            Connection::connect()->prepare("DELETE FROM characters WHERE id=?")->execute([$_POST["character_id"]]);
            $this->redirect('home','characters', ['succes' => 'Character deleted succesfully!']);
        }
    }
}