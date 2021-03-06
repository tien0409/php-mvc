<?php

namespace App\Controllers;

use Core\Controller;

/**
 * Authenticated base controller
 *
 * PHP version 7.0
 */
abstract class Authenticated extends Controller
{
    /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    protected function before()
    {
        $this->requireLogin();
    }

    protected function checkAdmin() {
        $this->isAdmin();
    }
}

