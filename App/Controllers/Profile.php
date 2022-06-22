<?php

namespace App\Controllers;

use App\Auth;
use Core\View;

class Profile extends Authenticated {
    public function index() {
        $this->before();
        View::renderTemplate('Profile/index.twig', ['user' => $this->user]);
    }

    protected function before() {
        parent::before();
        $this->user = Auth::getUser();
    }
}