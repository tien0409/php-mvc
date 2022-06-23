<?php

namespace App\Controllers;

use App\Auth;
use App\Flash;
use App\Models\User;
use Core\View;

class Profile extends Authenticated {
    public function index() {
        $this->before();
        View::renderTemplate('Profile/index.twig', ['user' => $this->user]);
    }
    
    public function updateProfile() {
        if(User::updateProfile(Auth::getUser()->id, $_POST)) {
            Flash::addMessage('Cập nhật thành công');
        } else {
            Flash::addMessage('Cập nhật thất bại');
        }
        $this->redirect('/profile');
    }

    protected function before() {
        parent::before();
        $this->user = Auth::getUser();
    }
}