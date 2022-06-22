<?php

namespace App\Controllers;

use App\Models\Book;
use Core\Controller;
use Core\View;
use App\Auth;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends Controller {

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction() {
        $book = new Book();
        $allbook = $book->findAll();
        View::renderTemplate('Home/index.twig', ['groups' => [1, 2, 3], 'books' => $allbook]);
    }
}
