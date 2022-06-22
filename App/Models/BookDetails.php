<?php

namespace App\Models;

use Core\Model;
use PDO;

class BookDetails extends Model {
    public $id;
    public $page_link;
    public $book;

    public static function insertBookDetail($bookId, $page_link) {
        foreach ($page_link as $link) {
            $sql = 'INSERT INTO BookDetails (book_id, page_link) VALUES (:book_id, :page_link);';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":book_id", $bookId, PDO::PARAM_INT);
            $stmt->bindValue(":page_link", $link['url'], PDO::PARAM_STR);
            $stmt->execute();
        }
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

    /**
     * @return mixed
     */
    public function getPageLink() {
        return $this->page_link;
    }

    /**
     * @param mixed $page_link
     */
    public function setPageLink($page_link): void {
        $this->page_link = $page_link;
    }

    /**
     * @return mixed
     */
    public function getBook() {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook($book): void {
        $this->book = $book;
    }
}