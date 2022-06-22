<?php

namespace App\Models;

class BookDetails
{
    public $id;
    public $page_link;
    public $book;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPageLink()
    {
        return $this->page_link;
    }

    /**
     * @param mixed $page_link
     */
    public function setPageLink($page_link): void
    {
        $this->page_link = $page_link;
    }

    /**
     * @return mixed
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook($book): void
    {
        $this->book = $book;
    }

}