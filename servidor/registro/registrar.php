<?php 
    include "../../clases/Auth.php";

    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];  
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $Auth = new Auth();

    if ($Auth->registrar($nombre, $dni, $email, $password)) {
        header("location: ./../../index.php");
    } else {
        echo "No se pudo registrar <hr>";
        echo "<a href='./../../index.php'> Salir</a>";
    }

?>