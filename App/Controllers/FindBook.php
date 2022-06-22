<?php

namespace App\Controllers;

use App\Models\Book;
use Core\Controller;
use Core\View;

class FindBook extends Controller
{
    public function index() {
        $book = new Book();
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $bookname = end($array);
        $allbook = $book->findByName($bookname);
        View::renderTemplate('Finder/index.twig', ['groups' => [1, 2, 3], 'books' => $allbook]);
    }
}