<?php
    if (!isset($_GET["id_especie"]) || empty($_GET["id_especie"])) {
        die("ID da especie não informado.");
    }

    $id_especie = $_GET["id_especie"];

    require("../conecta_bd.php");
    session_start();

    $stmt = $conn->prepare("DELETE FROM especies WHERE id = ?");
    $stmt->bind_param("i", $id_especie);

    if ($stmt->execute()) {
        if ($stmt->affected_rows == 1) {
            $_SESSION["msg_sucesso"] = "Especie excluído com sucesso";
        } else {
            $_SESSION["msg_sucesso"] = "Nenhuma especie foi excluída (ID pode estar incorreto)";
        }
        header("Location: ../especie/gerenc_especie.php");
        exit;
    } else {
        echo("Houve um erro ao excluir o registro: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
?>
