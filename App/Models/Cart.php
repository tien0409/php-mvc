<?php

namespace App\Models;

use App\Auth;
use Core\Model;
use PDO;

class Cart extends Model {
    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function numCartItems($userId) {
        $sql = 'SELECT COUNT(*) as numCartItems FROM CartItems INNER JOIN Carts ON CartItems.cart_id = Carts.id WHERE Carts.user_id = :user_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":user_id", $userId, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        return $stmt->fetch()->numCartItems;
    }

    public static function addCartItem($bookId) {
        $sql = 'SELECT * FROM Carts WHERE user_id = :user_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', Auth::getUser()->id, PDO::PARAM_INT);
        $stmt->execute();
        $cart = $stmt->fetch();

        $sql = 'SELECT * FROM CartItems WHERE cart_id = :cart_id and book_id = :book_id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':cart_id', $cart['id'], PDO::PARAM_INT);
        $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        if(count($stmt->fetchAll()) !== 0) {
            return 0;
        }

        $sql = 'INSERT INTO CartItems (cart_id, book_id) VALUES (:cart_id, :book_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':cart_id', $cart['id'], PDO::PARAM_INT);
        $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}