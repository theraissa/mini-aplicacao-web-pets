<?php
	$nome_especie = $_POST["especie"];

    $erros = [];	

    //validação
    if (empty($nome_especie) ){$erros[] = "Preencha o <b>nome da especie</b>";}

	if (count($erros) === 0) {
		require("../conecta_bd.php");

		if ($conn) {
			$id_especie = $_POST["id_especie"] ?? null;

			if (!empty($id_especie)) {
				$sql = "UPDATE especies SET especie = ? WHERE id = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("si", $nome_especie, $id_especie);
			} else {
				$sql = "INSERT INTO especies (especie) VALUES (?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("s", $nome_especie);
			}

			if ($stmt->execute()) {
				session_start();
				$_SESSION["msg_sucesso"] = !empty($id_especie) ? "Espécie atualizada com sucesso" : "Espécie inserida com sucesso";
				header("location: ../especie/gerenc_especie.php");
				exit;
			} else {
				echo "Erro ao executar: " . $stmt->error;
			}

			$stmt->close();
			$conn->close();

		} else {
			die("Houve um erro ao conectar com o banco de dados");
		}

	} else {
		foreach ($erros as $erro) {
			echo $erro . "<br>";
		}
	}

?>