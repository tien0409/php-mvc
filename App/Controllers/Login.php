<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\User;
use App\Auth;
use App\Flash;

/**
 * Login controller
 *
 * PHP version 7.0
 */
class Login extends Controller {
    public function index() {
        if(Auth::getUser()) {
            $this->redirect("/");
        }
        View::renderTemplate('Login/index.twig');
    }

    /**
     * Log in a user
     *
     * @return void
     */
    public function new() {
        $user = User::authenticate($_POST['username'], $_POST['password']);
        $remember_me = isset($_POST['remember_me']);

        if ($user) {
            Auth::login($user, $remember_me);
            Flash::addMessage('Login successful');
            $this->redirect(Auth::getReturnToPage());
        } else {
            Flash::addMessage('Login unsuccessful, please try again', Flash::WARNING);
            View::renderTemplate('Login/index.twig', ['email' => $_POST['email'], 'remember_me' => $remember_me]);
        }
    }

    /**
     * Log out a user
     *
     * @return void
     */
    public function destroy() {
        Auth::logout();

        Flash::addMessage('Logout successful');
        $this->redirect('/');
    }
}
