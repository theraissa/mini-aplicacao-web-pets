<?php
    $conn = mysqli_connect("127.0.0.1", "root", "", "petshop");

    if (!$conn){
        die("Houve um erro ao conectar com o banco de dados");
    }
?>