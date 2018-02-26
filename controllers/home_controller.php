<?php
require_once ('models/Users.php');

  class HomeController {
    public function index() {
        if(isset($_POST['register'])) {
            $name = mysql_real_escape_string($_POST['name']);
            $email = mysql_real_escape_string($_POST['email']);
            $password1 = mysql_real_escape_string($_POST['password1']); 
            $password2 = mysql_real_escape_string($_POST['password2']); 
            $result = Users::find($email);
            $success = false;
            if($result == 0) {
                $token = $this->getToken();
                $password = sha1($password1);
                $inserted = Users::insert($name, $email, $password, $token);
                if (!$inserted) {
                    $register_message = "Unable to insert record!";
                } else {
                    $success = true;
                    $register_message = "Sucessfully registered this email. Please check your email to confirm your registation.";
                    $to = "xyz@somedomain.com";
         $subject = "NoReply@php-stuff.com";
         $message = "Please click the activation link below to active your account.\r\n";
         $message .="http://php-stuff.com/?controller=home&action=activation&email=".$email."&token=".$token;
         $header = "From:admin@php-stuff.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
                }
            } elseif ($result > 0) {
                $success = false;
                $register_message = "Email already exists. Please try another email address.";
            }
        } elseif (!isset($_POST['register'])) {
            $register_message = NULL;
        } 

        if (isset($_POST['login'])) {
            $email = mysql_real_escape_string($_POST['email']);
            $password = sha1(mysql_real_escape_string($_POST['password']));
            $result = Users::find($email);
            $db_password = $result['password'];
            if($password != $db_password) {
                $login_message = "Unable to login. Please try again.";
            } else {
                header('Location: ?controller=loggedin&action=index&email='.$email);   
            }
        }

        require_once('views/pages/home.php');
    }

    public function activation() {
        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token'])){
            
          $confirm = Users::find($email);
            
            if ($confirm) {
                $db_token = $confirm['token'];  
                if ($token == $db_token) {
                    $update = Users::update($email);
                    if ($update) {
                        $register_message = "Thank you. Your email has been confirmed. You may login.";
                        $_SESSION['email'] = $email;
                    } else {
                        $register_messsage =  "Error. Unable to update!";
                    }
                } 
            } else {
                $register_message = "Username and token do not match";
            }
        }
    }

    private function crypto_rand_secure($min, $max) {
      $range = $max - $min;
      if ($range < 1) return $min; // not so random...
      $log = ceil(log($range, 2));
      $bytes = (int) ($log / 8) + 1; // length in bytes
      $bits = (int) $log + 1; // length in bits
      $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
      do {
          $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
          $rnd = $rnd & $filter; // discard irrelevant bits
      } while ($rnd > $range);
      return $min + $rnd;
    }
  
    private function getToken(){
      $token = "";
      $length = 9;
      $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
      $codeAlphabet.= "0123456789";
      $max = strlen($codeAlphabet); // edited
  
      for ($i=0; $i < $length; $i++) {
          $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
      }
  
      return $token;
    }

    public function error() {
      require_once('views/pages/error.php');
    }
}
