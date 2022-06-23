<?php

namespace App\Controllers;

use App\Flash;
use Core\Controller;
use Core\View;

class Cart extends Controller {
    public function index() {
        View::renderTemplate('Cart/index.twig', ['groups' => [1, 2, 3], 'books' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 9, 2]]);
    }

    public function addCartItem() {
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $bookId = end($array);
        if (\App\Models\Cart::addCartItem($bookId) === 0) {
            Flash::addMessage('Sản phẩm đã tồn tại trong giả hàng của bạn.', Flash::SUCCESS);
        } elseif (\App\Models\Cart::addCartItem($bookId )) {
            Flash::addMessage('Thêm sản phẩm vào giỏ hàng thành công.', Flash::SUCCESS);
        } else {
            Flash::addMessage('Thêm sản phẩm vào giỏ hàng thất bại.', Flash::WARNING);
        }
        $this->redirect('/books/detail/' . $bookId);
    }
}