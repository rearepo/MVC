<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');
    switch($controller) {
      case 'home':
        $controller = new HomeController();
      break;
      case 'posts':
        // we need the model to query the database later in the controller
        require_once('models/post.php');
        $controller = new PostsController();
      break;
      case 'loggedin':
        $controller = new LoggedinController();
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('home' => ['index','error'],
                       'posts' => ['index', 'show'],
                       'loggedin' => ['index','error']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('home', 'error');
    }
  } else {
    call('home', 'error');
  }
?>