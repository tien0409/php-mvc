<?php

namespace App\Controllers;

use App\Models\Book;
use Core\View;


class Books {
    public function index() {
        View::renderTemplate('Books/index.twig', ['groups' => [1, 2, 3], 'books' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 9, 2]]);
    }

    public function detail() {
        $book = new Book();
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $bookId = end($array);
        $_book = $book->findByID($bookId);
        $allbook = Book::findAll();
        View::renderTemplate('Books/detail.twig',
            ['groups' => [1, 2, 3], 'name' => $_book->getName(),
                'description' => $_book->description,
                'price' => $_book->getPrice(),
                'banner_link' => $_book->getLink(),
                'books' => $allbook,
                'id' => $_book->id
            ]);
    }

    public function read() {
        $book = new Book();
        $array = explode('/', $_SERVER['REQUEST_URI']);
        $bookId = end($array);
        $_book = $book->findByID($bookId);
        View::renderTemplate('Books/read.twig', ['books' => $_book->book_details]);
    }
}