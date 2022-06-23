<?php

namespace App\Controllers;

use App\Flash;
use Core\Controller;
use \Core\View;
use \App\Models\User;

/**
 * Signup controller
 *
 * PHP version 7.0
 */
class Signup extends Controller
{

    /**
     * Show the signup page
     *
     * @return void
     */
    public function index()
    {
        View::renderTemplate('Signup/index.twig');
    }

    /**
     * Sign up a new user
     *
     * @return void
     */
    public function create()
    {
        $user = new User($_POST);

        if ($user->save()) {
            Flash::addMessage('Đăng ký thành công', Flash::WARNING);
            $this->redirect('/login');

        } else {
            View::renderTemplate('Signup/index.twig', [
                'user' => $user
            ]);

        }
    }
}
