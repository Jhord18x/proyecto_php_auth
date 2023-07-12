<?php 
    include "../../clases/Auth.php";
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Auth = new Auth();
    $existe = $Auth->logear($email, $password); //verifica si existe el usuario. (devuelve un boolean)
    if ($existe) {
        $response = array("status" => true);
    } else {
        $response = array("status" => false);
    }
    echo json_encode($response);
?>
