<?php

class DBJutsus
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=dbchp2", "root","dtb456");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Chyba" . $e->getMessage());
        }
    }

    public function storeJutsu(Jutsu $jutsu)
    {
        $this->connection->prepare("INSERT INTO jutsus(image,name,text,type,element) VALUES (?,?,?,?,?)")
        ->execute([$jutsu->getImage(),$jutsu->getName(),$jutsu->getText(),$jutsu->getType(),$jutsu->getElement()]);
    }

    public function getAllJutsus()
    {
        $stmt = $this->connection->prepare("SELECT * FROM jutsus");
        $stmt->execute();
        $jutsus = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Jutsu::class);
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE jutsu_id = ?");
        foreach ($jutsus as $jutsu) {
            $stmt->execute([intval($jutsu->getId())]);
            $users = $stmt->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, User::class);
            $jutsu->setUsers($users);
        }
        return $jutsus;
    }

    public function addUser(User $user)
    {
        $this->connection->prepare("INSERT INTO users (jutsu_id, name) VALUES (?,?)")
            ->execute([$user->getJutsuId(), $user->getName()]);
    }

    public function deleteJutsu($par_jutsu_id)
    {
        $this->connection->prepare("DELETE FROM jutsus WHERE id=?")->execute([$par_jutsu_id]);
    }

    public function deleteUser($par_jutsu_id)
    {
        $this->connection->prepare("DELETE FROM users WHERE jutsu_id=?")->execute([$par_jutsu_id]);
    }

    public function rewriteURL($par_jutsu_id,$newURL)
    {
        $this->connection->prepare("UPDATE jutsus SET image=? WHERE id=?")->execute([$newURL,$par_jutsu_id]);
    }
}