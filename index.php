<?php
// session_start();
 
 $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

 $routes = [
  '/' => './views/index.php',
  '/admin' => './views/admin.php',
  '/login' => './controllers/login.php',
  '/dashboard' => './views/dashboard.php',
  // '/db_seed' => './controllers/db_seed.php',
  '/logout' => './controllers/logout.php',
  '/reviews' => './views/admin_reviews.php',
  '/album' => './views/admin_album.php',
  '/process_new_review'=>'./controllers/process_new_review.php',
  '/edit_review'=>'./controllers/edit_review.php',
  '/delete_image'=>'./controllers/delete_image.php',
  '/add_album_item'=>'./controllers/add_album_item.php',
  '/contacts'=>'./views/contacts.php',
  '/update_contact_status'=>'./controllers/update_contact_status.php',
 ] ;

 if(array_key_exists($uri, $routes) ){
  require ($routes[$uri]);
 } elseif ($partials = explode('/',$uri)) {
    // handle dynamic uri
    // edit reviews
    if($partials[1]=="r" && isset($partials[2])){
      $_POST['rid']=$partials[2];
      require ('./views/edit_review.php');
    }
 } else {
    http_response_code(404);
    require ('./views/404.php');
  // die('requested resource does not exist.');
 }