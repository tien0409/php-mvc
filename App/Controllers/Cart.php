<?php

namespace App\Controllers;

use Core\View;

class Cart {
    public function index() {
        View::renderTemplate('Cart/index.twig', ['groups' => [1, 2, 3], 'books' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 9, 2]]);
    }
}