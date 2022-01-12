<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Controllers\AControllerRedirect;
use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Models\Jutsu;
use App\Models\Tool;
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
        $data[0] = Character::getAll();
        $data[1] = Jutsu::getAll();
        return $this->html($data);
    }

    //Vsetko co sa tyka charactrov
    public function characters()
    {
        $characters = Character::getAll();
        return $this->html($characters);
    }

    public function addCharacter()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home','characters');
            return;
        }

        if (isset($_POST['addCharacter'])) {
            if ($_FILES["img1"]["error"] == UPLOAD_ERR_OK) {
                $img1_name = date('Y-m-d-H-i-s').'-1-'.$_FILES['img1']['name'];
                $imageFileType = strtolower(pathinfo($img1_name,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $this->redirect('home','characters', ['error' => 'File1 is not an image!']);
                    return;
                }
            }
            if ($_FILES["img2"]["error"] == UPLOAD_ERR_OK) {
                $img2_name = date('Y-m-d-H-i-s').'-2-'.$_FILES['img2']['name'];
                $imageFileType = strtolower(pathinfo($img2_name,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $this->redirect('home','characters', ['error' => 'File2 is not an image!']);
                    return;
                }
            }
            if ($_FILES["img3"]["error"] == UPLOAD_ERR_OK) {
                $img3_name = date('Y-m-d-H-i-s').'-3-'.$_FILES['img3']['name'];
                $imageFileType = strtolower(pathinfo($img3_name,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $this->redirect('home','characters', ['error' => 'File3 is not an image!']);
                    return;
                }
            }

            if ( strlen($_POST['name']) < 3) {
                $this->redirect('home','characters', ['error' => 'Name is too short!']);
                return;
            }

            if ( strlen($_POST['text']) < 10) {
                $this->redirect('home','characters', ['error' => 'Text is too short!']);
                return;
            }

            $character = new Character();
            move_uploaded_file($_FILES['img1']['tmp_name'],Configuration::UPLOAD_DIR . "$img1_name");
            $character->image1 = $img1_name;
            move_uploaded_file($_FILES['img2']['tmp_name'],Configuration::UPLOAD_DIR . "$img2_name");
            $character->image2 = $img2_name;
            move_uploaded_file($_FILES['img3']['tmp_name'],Configuration::UPLOAD_DIR . "$img3_name");
            $character->image3 = $img3_name;

            $character->name = $_POST['name'];
            $character->text = $_POST['text'];
            $character->save();
        }

        $this->redirect('home','characters', ['succes' => 'Character added succesfully!']);
    }

    public function deleteCharacter()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home','characters');
            return;
        }

        if (isset($_POST['deleteCharacter'])) {
            $image = Character::getOne($_POST["character_id"]);
            unlink(Configuration::UPLOAD_DIR . "$image->image1");
            unlink(Configuration::UPLOAD_DIR . "$image->image2");
            unlink(Configuration::UPLOAD_DIR . "$image->image3");

            Connection::connect()->prepare("DELETE FROM characters WHERE id=?")->execute([$_POST["character_id"]]);
            $this->redirect('home','characters', ['succes' => 'Character deleted succesfully!']);
        }
    }

    public function getAllCharacters()
    {
        $chrctrs = Character::getAll();
        return $this->json($chrctrs);
    }

    // Vsetko co sa tyka jutsu
    public function jutsu()
    {
        $jutsus = Jutsu::getAll();
        return $this->html($jutsus);
    }

    public function addJutsu()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home','jutsu');
            return;
        }

        if (isset($_POST['addJutsu'])) {
            if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
                $img_name = date('Y-m-d-H-i-s').'-J-'.$_FILES['img']['name'];
                $imageFileType = strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $this->redirect('home','jutsu', ['error' => 'File is not an image!']);
                    return;
                }
            }
            if (strlen($_POST['name']) < 3) {
                $this->redirect('home','jutsu', ['error' => 'Name is too short!']);
                return;
            }
            if (strlen($_POST['text']) < 10) {
                $this->redirect('home','jutsu', ['error' => 'Text is too short!']);
                return;
            }
            if ($_POST['type'] == " ") {
                $this->redirect('home','jutsu', ['error' => 'Fill an type!']);
                return;
            }

            if ($_POST['element'] == " ") {
                $this->redirect('home','jutsu', ['error' => 'Fill an element!']);
                return;
            }

            $newJutsu = new Jutsu();
            move_uploaded_file($_FILES['img']['tmp_name'],Configuration::UPLOAD_DIR . "$img_name");
            $newJutsu->image = $img_name;
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
        if (!Auth::isLogged()) {
            $this->redirect('home','jutsu');
            return;
        }

        if (isset($_POST['user'])) {
            $users = User::getAll('name = ? AND jutsu_id = ?',[$_POST['name'],$_POST['jutsu_id']]);
            if ($users != null) {
                $this->redirect('home','jutsu',['error' => 'User is already added!']);
                return;
            }
            $characters = Character::getAll('name = ?', [$_POST['name']]);
            if ($characters == null) {
                $this->redirect('home','jutsu',['error' => 'User name too short!']);
                return;
            }
            $newUser = new User();
            $newUser->jutsu_id = ($_POST['jutsu_id']);
            $newUser->name = ($_POST['name']);
            $newUser->save();
        }
        $this->redirect('home','jutsu',['succes' => 'User added succesfully!']);
    }

    public function iconAction() //Jutsu ikony
    {
        if (!Auth::isLogged()) {
            $this->redirect('home','jutsu');
            return;
        }

        if (isset($_POST['deleteJutsu'])) {
            $image = Jutsu::getOne($_POST["jutsu_id"]);
            unlink(Configuration::UPLOAD_DIR . "$image->image");
            Connection::connect()->prepare("DELETE FROM users WHERE jutsu_id=?")->execute([$_POST["jutsu_id"]]);
            Connection::connect()->prepare("DELETE FROM jutsus WHERE id=?")->execute([$_POST["jutsu_id"]]);
            $this->redirect('home','jutsu', ['succes' => 'Jutsu deleted succesfully!']);
        }

        if (isset($_POST['rewriteImg'])) {

            if ($_FILES["newImg"]["error"] == UPLOAD_ERR_OK) {
                $new_img = date('Y-m-d-H-i-s').'-J-'.$_FILES['newImg']['name'];
                $imageFileType = strtolower(pathinfo($new_img,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $this->redirect('home','jutsu', ['error' => 'File is not an image!']);
                    return;
                }
            }
            $old_image = Jutsu::getOne($_POST["jutsu_id"]);
            unlink(Configuration::UPLOAD_DIR . "$old_image->image");
            move_uploaded_file($_FILES['newImg']['tmp_name'],Configuration::UPLOAD_DIR . "$new_img");

            Connection::connect()->prepare("UPDATE jutsus SET image=? WHERE id=?")->execute([$new_img,$_POST["jutsu_id"]]);
            $this->redirect('home','jutsu', ['succes' => 'Image changed succesfully!']);
        }
    }

    public function getAllJutsus()
    {
        $jutsus = Jutsu::getAll();
        return $this->json($jutsus);
    }

    //Vsetko co sa tyka toolov

    public function tools()
    {
        $tools = Tool::getAll();
        return $this->html($tools);
    }
}