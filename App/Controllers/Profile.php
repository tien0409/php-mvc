<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Profile extends Controller {
    public function index() {
        try {

//            $instance = $this->db->connect();
//            $query = $instance->prepare("SELECT * FROM User");
//            $query->execute();
//            $res = $query->get_result();
            View::renderTemplate('Profile/index.twig');
        } catch(\Exception $e) {
            $this->db->close();
            throw $e;
        }
    }
}