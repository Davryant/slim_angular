<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->post('/login', function (Request $request, Response $response, array $args) {
   // Get params from request.
   $user = $request -> getParam('username');
   $pass = $request -> getParam('password');

   // Get db connection
   $query = "SELECT * FROM user WHERE username='$user' AND password='$pass'";

   try{
       $db = new Db;
       $db = $db -> connect();

       $statement = $db -> query($query);
       $statement -> execute();
       $result = $statement -> fetchAll(PDO::FETCH_OBJ);
        // $status = $response->$result;
        // echo $status;
       
        if($result){
            $jibu['status'] = 'success';
            $jibu['user'] = $result;
            $response = json_encode($jibu);
        }else{
            $jibu['status'] = 'failed';
            $response = json_encode($jibu);
        }

   } catch(PDOException $e) {
       $response = '{"error": {"message":' .$e->getMessage().' }}';
   } 

   return $response;
});

$app->post('/register', function (Request $request, Response $response, array $args) {
    // Get params from request.
    $firstname = $request -> getParam('firstname');
    $lastname = $request -> getParam('lastname');
    $username = $request -> getParam('username');
    $password = $request -> getParam('password');

    $response = 'Request received!';

    // Get db connection
    $query = "INSERT INTO user(firstname, lastname, username, password) 
            VALUES(:firstname, :lastname, :username, :password)";

    try {
        $db = new Db;
        $db = $db -> connect();
        $statement = $db -> prepare($query);
        $statement -> bindParam(':firstname', $firstname);
        $statement -> bindParam(':lastname', $lastname);
        $statement -> bindParam(':username', $username);
        $statement -> bindParam(':password', $password);

        // Execute query
        $statement -> execute();
        $response = '{"success": {"message": "User has been registered."} }';

    } catch(PDOException $e) {
        $response = '{"error": {"message":' .$e->getMessage().' }}';
    } 

    return $response;
});

$app->delete('/deleteuser/{username}', function (Request $request, Response $response, array $args) {
    $username = $request -> getAttribute('username');

    $query = "DELETE FROM user WHERE username='$username'";

    try{
        $db = new Db;
        $db = $db -> connect();

        $statement = $db -> prepare($query);
        $statement -> execute();
        $response = '{"success": {"message": "User has been deleted."} }';

    } catch(PDOException $e) {
        $response = '{"error": {"message":' .$e->getMessage().' }}';
    } 

    return $response;
});

$app->get('/readdata', function (Request $request, Response $response, array $args) {
    $response = 'Read data route.';
    $query = "SELECT * FROM user";

    try{
        $db = new Db;
        $db = $db -> connect();

        $statement = $db -> query($query);
        $users = $statement -> fetchAll(PDO::FETCH_OBJ);

        $response = json_encode($users);

    } catch(PDOException $e) {
        $response = '{"error": {"message":' .$e->getMessage().' }}';
    } 

    return $response;
});

$app->get('/readdata/{id}', function (Request $request, Response $response, array $args) {
    $id = $request -> getAttribute('id');

    $query = "SELECT * FROM user WHERE id=$id";

    try{
        $db = new Db;
        $db = $db -> connect();

        $statement = $db -> query($query);
        $users = $statement -> fetchAll(PDO::FETCH_OBJ);

        $response = json_encode($user);

    } catch(PDOException $e) {
        $response = '{"error": {"message":' .$e->getMessage().' }}';
    } 

    return $response;
});

$app->put('/updatedata/{id}', function (Request $request, Response $response, array $args) {
    $id = $request -> getAttribute('id');
    $firstname = $request -> getParam('firstname');
    $lastname = $request -> getParam('lastname');
    $username = $request -> getParam('username');

    $query = "UPDATE user SET username=:username, firstname=:firstname, lastname=:lastname WHERE id=$id";

try {
    $db = new Db;
    $db = $db -> connect();
    $statement = $db -> prepare($query);
    $statement -> bindParam(':username', $username);
    $statement -> bindParam(':firstname', $firstname);
    $statement -> bindParam(':lastname', $lastname);

    // Execute query
    $statement -> execute();
    $response = '{"success": {"message": "User has been updated."} }';

} catch(PDOException $e) {
    $response = '{"error": {"message":' .$e->getMessage().' }}';
} 

    return $response;
});