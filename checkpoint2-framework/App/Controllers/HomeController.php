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
        $characters = Character::getAll();
        $data[0] = array_reverse($characters);
        $jutsus =Jutsu::getAll();
        $data[1] = array_reverse($jutsus);
        $tools = Tool::getAll();
        $data[2] = array_reverse($tools);
        return $this->html($data);
    }

    //Vsetko co sa tyka charactrov
    public function characters()
    {
        $characters = Character::getAll();
        return $this->html(array_reverse($characters));
    }

    public function addCharacter()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home','characters');
            return;
        }

        if ($_FILES["img_1"]["error"] == UPLOAD_ERR_OK) {
        $img1_name = date('Y-m-d-H-i-s').'-1-'.$_FILES['img_1']['name'];
        $imageFileType = strtolower(pathinfo($img1_name,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return $this->json("error");
        }
    }
        if ($_FILES["img_2"]["error"] == UPLOAD_ERR_OK) {
            $img2_name = date('Y-m-d-H-i-s').'-2-'.$_FILES['img_2']['name'];
            $imageFileType = strtolower(pathinfo($img2_name,PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                return $this->json("error");
            }
        }
        if ($_FILES["img_3"]["error"] == UPLOAD_ERR_OK) {
            $img3_name = date('Y-m-d-H-i-s').'-3-'.$_FILES['img_3']['name'];
            $imageFileType = strtolower(pathinfo($img3_name,PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                return $this->json("error");
            }
        }

        $name = $this->request()->getValue('name');
        if (strlen($name) < 3) {
            return $this->json("error");
        }
        $text = $this->request()->getValue('text');
        if (strlen($text) < 10) {
            return $this->json("error");
        }
        $character = new Character();
        move_uploaded_file($_FILES['img_1']['tmp_name'],Configuration::UPLOAD_DIR . "$img1_name");
        $character->image1 = $img1_name;
        move_uploaded_file($_FILES['img_2']['tmp_name'],Configuration::UPLOAD_DIR . "$img2_name");
        $character->image2 = $img2_name;
        move_uploaded_file($_FILES['img_3']['tmp_name'],Configuration::UPLOAD_DIR . "$img3_name");
        $character->image3 = $img3_name;

        $character->name = $name;
        $character->text = $text;
        $character->save();

        $character = Character::getAll();
        $size = sizeof($character);
        return $this->json($character[$size - 1]);
    }

    public function deleteCharacter()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home','characters');
            return;
        }

        $char_id = $this->request()->getValue("char_id");
        $character = Character::getAll('id = ?',[$char_id]);
        if ($character == null) {
            return $this->json("error");
        } else {
            $character = Character::getOne($char_id);
        }
        unlink(Configuration::UPLOAD_DIR . "$character->image1");
        unlink(Configuration::UPLOAD_DIR . "$character->image2");
        unlink(Configuration::UPLOAD_DIR . "$character->image3");

        Connection::connect()->prepare("DELETE FROM characters WHERE id=?")->execute([$character->id]);
        return $this->json("ok");
    }

    // Vsetko co sa tyka jutsu
    public function jutsu()
    {
        $data[0] = array_reverse(Jutsu::getAll());
        $data[1] = Character::getAll();
        return $this->html($data);
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
    //Vsetko co sa tyka toolov

    public function tools()
    {
        $tools = Tool::getAll();
        return $this->html($tools);
    }
}