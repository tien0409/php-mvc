<?php

namespace App\Controllers;

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
        View::renderTemplate('Home/index.twig', ['groups' => [1, 2, 3], 'books' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 9, 2]]);
    }
}
