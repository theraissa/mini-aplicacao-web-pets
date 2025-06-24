<?php
    if (!isset($_GET["id_pet"]) || empty($_GET["id_pet"])) {
        die("ID do pet não informado.");
    }

    $id = $_GET["id_pet"];

    require("../conecta_bd.php");
    session_start();

    $stmt = $conn->prepare("DELETE FROM pet WHERE id_pet = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows == 1) {
            $_SESSION["msg_sucesso"] = "Pet excluído com sucesso";
        } else {
            $_SESSION["msg_sucesso"] = "Nenhum pet foi excluído (ID pode estar incorreto)";
        }
        header("Location: ../gerenc/gerenc_pet.php");
        exit;
    } else {
        echo("Houve um erro ao excluir o registro: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
?>
