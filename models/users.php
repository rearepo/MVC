<?php

  class Users {
    public static function find($email) {
      $dbh = Db::getInstance();
      $stmt = $dbh->prepare("SELECT * 
                            FROM users 
                            WHERE email='$email'
                            AND active = 1");
      $stmt->execute(array('email' => $email));
   
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data = $row;
    
        return $data;
      }
    }
    
    public static function insert($name, $email, $password, $token) {
      $db = Db::getInstance();
      $stmt = $db->prepare("INSERT INTO users (name, email, password, token) 
                           VALUES('$name', '$email', '$password','$token')");
      $stmt->execute(array('email' => $email,
                          'name' => $name, 
                          'password'=> $password, 
                          'token' => $token)
                         );
      if($stmt) return true;
    }

    public static function update($email) {
        $db = Db::getInstance();

        $stmt = $db->prepare("SET SQL_SAFE_UPDATES=0");
        $stmt->execute();
         
        $stmt = $db->prepare("UPDATE users SET active = 1, token ='' WHERE email='email'");
        $stmt->execute(array('email' => $email));
    }
  }
?>