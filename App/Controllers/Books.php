<?php

namespace App\Controllers;

use Core\View;

class Books {
    public function index() {
        View::renderTemplate('Books/index.twig', ['groups' => [1, 2, 3], 'books' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 9, 2]]);
    }

    public function detail() {
        View::renderTemplate('Books/detail.twig', ['groups' => [1, 2, 3], 'books' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 9, 2]]);
    }

    public function read() {
        View::renderTemplate('Books/read.twig', []);
    }
}