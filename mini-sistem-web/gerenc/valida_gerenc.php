<?php

    //Gerenciar Pets
    $nome_pet = $_POST["nome_pet"];
	$nasc_pet = $_POST["nasc_pet"];
	$especie_pet = $_POST["especie_pet"];
	$genero_pet = $_POST["genero_pet"];
	$prontuario_pet = $_POST["prontuario_pet"];

    $erros = [];	

    //validação
	if (empty($nome_pet)) $erros[] = "Preencha o <b>nome do pet</b>";
	if (empty($nasc_pet)) $erros[] = "Preencha a <b>data de nascimento</b>";
	if (empty($especie_pet)) $erros[] = "Preencha a <b>espécie</b>";
	if (empty($genero_pet)) $erros[] = "Preencha o <b>gênero</b>";
	if (empty($prontuario_pet)) $erros[] = "Preencha o <b>prontuário</b>";

    
	if (count($erros) === 0) {
		require("../conecta_bd.php");

		if ($conn) {
			$id_pet = $_POST["id_pet"] ?? null;

			if (!empty($id_pet)) {
				$sql = "UPDATE pet SET nome_pet = ?, nasc_pet = ?, especie_pet = ?, genero_pet = ?, prontuario_pet = ? WHERE id_pet = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ssissi", $nome_pet, $nasc_pet, $especie_pet, $genero_pet, $prontuario_pet, $id_pet);
			} else {
				$sql = "INSERT INTO pet (nome_pet, nasc_pet, especie_pet, genero_pet, prontuario_pet) VALUES (?, ?, ?, ?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ssiss", $nome_pet, $nasc_pet, $especie_pet, $genero_pet, $prontuario_pet);
			}

			if ($stmt->execute()) {
				session_start();
				$_SESSION["msg_sucesso"] = !empty($id_pet) ? "Pet atualizado com sucesso" : "Pet inserido com sucesso";
				header("Location: ../gerenc/gerenc_pet.php");
				exit;
			} else {
				echo "Erro ao executar a query: " . $stmt->error;
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