<?php

namespace App\Models;

use Core\Model;
use PDO;

class Book extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $discount;
    public $banner_link;
    public $book_details;

    /**
     * @return mixed
     */
    public function getBookDetails()
    {
        return $this->book_details;
    }

    /**
     * @param mixed $book_details
     */
    public function setBookDetails($book_details): void
    {
        $this->book_details = $book_details;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->banner_link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->banner_link = $link;
    }

    public function findByID($id) {
        if ($id == null) {
            $id = $this->id;
        }
        $sql = "SELECT * FROM book WHERE book.id = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $user = $stmt->fetch();
        $sql = "SELECT * FROM bookdetails WHERE bookdetails.book_id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, BookDetails::class);
        $stmt->execute();
        $user->setBookDetails($stmt->fetchAll());
        return $user;
    }

    public function findByName($name) {
        if ($name == null) {
            $name = $this->name;
        }
        $sql = "SELECT * FROM book WHERE book.name LIKE %:name%";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":name", $name);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach ($users as $user) {
            $sql = "SELECT * FROM bookdetails WHERE bookdetails.book_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $user->getId());
            $stmt->setFetchMode(PDO::FETCH_CLASS, BookDetails::class);
            $stmt->execute();
            $user->setBookDetails($stmt->fetchAll());
        }
        return $users;
    }

    public function findAll() {
        $sql = "SELECT * FROM book";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $books = $stmt->fetchAll();
        foreach ($books as $book) {
            $sql = "SELECT * FROM bookdetails WHERE bookdetails.book_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $book->getId());
            $stmt->setFetchMode(PDO::FETCH_CLASS, BookDetails::class);
            $stmt->execute();
            $book->setBookDetails($stmt->fetchAll());
        }
        return $books;
    }

}
