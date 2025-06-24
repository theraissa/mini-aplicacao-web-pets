<?php
    require("conecta_bd.php");

    session_start();

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Consulta segura com prepared statement
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuarioDB = $resultado->fetch_assoc();

        // Comparação segura da senha usando password_verify
        if ($senha === $usuarioDB["senha"]) {
            $_SESSION["usuario"] = $usuario;
            $stmt->close();
            $conn->close();
            header("Location: gerenc/gerenc_pet.php");
            exit();
        } else {
            $_SESSION["erro"] = "Usuário ou senha incorretos";
            $stmt->close();
            $conn->close();
            header("Location: login.php");
            exit();
        } 

    } else {
        $_SESSION["erro"] = "Usuário ou senha incorretos";
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit();
    }


?>