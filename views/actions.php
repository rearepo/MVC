
<?php if(isset($_SESSION['email'])) { ?>
      <a href='/php_mvc'>Home</a>
      <a href='?controller=posts&action=index'>Posts</a>
      <a href='?controller=loggedin&action=index'>Logged In</a>
<?php } elseif (!isset($_SESSION['email'])){ ?>
      <a href='/php_mvc'>Home</a>
      <a href='?controller=home&action=index' id="signup">Register</a>
<?php } ?>