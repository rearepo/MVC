<?php

class LoggedinController {
    public function index() {
      require_once('views/pages/loggedin.php');
      $email = $_GET['email'];
     $_SESSION['email'] = $email;
    }
}

   
