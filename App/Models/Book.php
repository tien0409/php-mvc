<?php

namespace App\Models;

use Core\Model;
use PDO;

class Book extends Model {
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
    public function getBookDetails() {
        return $this->book_details;
    }

    /**
     * @param mixed $book_details
     */
    public function setBookDetails($book_details): void {
        $this->book_details = $book_details;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDiscount() {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getLink() {
        return $this->banner_link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void {
        $this->banner_link = $link;
    }

    public function insertBook($data) {
        $sql = 'INSERT INTO Books (name, description, banner_link, overview, price) VALUES (:name, :description, :banner_link, :overview, :price);';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":description", $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(":banner_link", $data['book_banner']['url'], PDO::PARAM_STR);
        $stmt->bindValue(":overview", $data['overview'], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data['price'], PDO::PARAM_INT);
        $stmt->execute();

        return $db->lastInsertId();
    }

    public function updateBook($bookId, $data) {
        $sql = 'UPDATE Books SET name = :name, description = :description, banner_link = :banner_link, overview = :overview, price =:price WHERE id = :id;';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", $bookId, PDO::PARAM_STR);
        $stmt->bindValue(":description", $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(":banner_link", $data['book_banner']['url'], PDO::PARAM_STR);
        $stmt->bindValue(":overview", $data['overview'], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data['price'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteBook($bookId) {
        $sql = 'DELETE FROM BookDetails WHERE book_id = :bookId ';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":bookId", $bookId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $sql = 'DELETE FROM Books WHERE id = :bookId';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":bookId", $bookId, PDO::PARAM_INT);
            return $stmt->execute();
        }

        return false;
    }

    public function findByID($id) {
        if ($id == null) {
            $id = $this->id;
        }
        $sql = "SELECT * FROM Books WHERE id = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $user = $stmt->fetch();
        $sql = "SELECT * FROM BookDetails WHERE book_id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, BookDetails::class);
        $stmt->execute();
        $user->setBookDetails($stmt->fetchAll());
        return $user;
    }

    public function findByName($name) {
        $name = "%" . $name . "%";
        $sql = "SELECT * FROM Books WHERE name LIKE :name";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":name", $name);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach ($users as $user) {
            $sql = "SELECT * FROM BookDetails WHERE book_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $user->getId());
            $stmt->setFetchMode(PDO::FETCH_CLASS, BookDetails::class);
            $stmt->execute();
            $user->setBookDetails($stmt->fetchAll());
        }
        return $users;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void {
        $this->id = $id;
    }

    public function findAll() {
        $sql = "SELECT * FROM Books";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $books = $stmt->fetchAll();
        foreach ($books as $book) {
            $sql = "SELECT * FROM BookDetails WHERE book_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $book->getId());
            $stmt->setFetchMode(PDO::FETCH_CLASS, BookDetails::class);
            $stmt->execute();
            $book->setBookDetails($stmt->fetchAll());
        }
        return $books;
    }

}
