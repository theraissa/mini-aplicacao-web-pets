<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Pet</title>
    <link rel="stylesheet" href="../styles/gerenc.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        require("../conecta_bd.php");
        if (!$conn){
            die("Erro fatal: Não foi possível conectar ao banco de dados.");
        }

        $pet_id = 0;
        $pet_data = [];
        $pet_id = isset($_GET["id_pet"]) ? (int) $_GET["id_pet"] : 0; 

        if ($pet_id <= 0) {
            header("Location: ../gerenc/gerenc_pet.php?status=error&message=" . urlencode("ID do pet inválido para visualização."));
            exit();
        }

        $sql_select_pet = "SELECT p.id_pet, p.nome_pet, p.nasc_pet, e.especie AS nome_especie, p.genero_pet, p.prontuario_pet 
                        FROM pet p
                        JOIN especies e ON p.especie_pet = e.id
                        WHERE p.id_pet = ?";
        $stmt_select_pet = $conn->prepare($sql_select_pet);

        if ($stmt_select_pet === false) {
            die("Erro na preparação da consulta SELECT do pet: " . mysqli_error($conn));
        }

        $stmt_select_pet->bind_param("i", $pet_id);
        $stmt_select_pet->execute();
        $resultado_pet = $stmt_select_pet->get_result();

        if ($resultado_pet->num_rows == 1) {
            $pet_data = $resultado_pet->fetch_assoc(); 
            $pet_data['nasc_pet_formatado'] = date('d/m/Y', strtotime($pet_data['nasc_pet']));

        } else {
            header("Location: ../gerenc/gerenc_pet.php?status=error&message=" . urlencode("Pet não encontrado para visualização."));
            exit();
        }
        $stmt_select_pet->close(); 
        $conn->close(); 
    ?>
    
    <div class="main-container">
        <h1>Detalhes do Pet</h1>

        <div class="section-container">
            <h2>Informações do Pet: <?= htmlspecialchars($pet_data['nome_pet'] ?? 'N/A'); ?></h2>
    
            <div class="form-group">
                <label>Nome do Pet:</label>
                <div><?= htmlspecialchars($pet_data['nome_pet'] ?? 'N/A'); ?></div><br>
            </div>
            <div class="form-group">
                <label>Nascimento:</label>
                <div><?= htmlspecialchars($pet_data['nasc_pet_formatado'] ?? 'N/A'); ?></div><br>
            </div>
            <div class="form-group">
                <label>Espécie:</label>
                <div><?= htmlspecialchars($pet_data['nome_especie'] ?? 'N/A'); ?></div><br>
            </div>
            <div class="form-group">
                <label>Gênero:</label>
                <div><?= htmlspecialchars($pet_data['genero_pet'] ?? 'N/A'); ?></div><br>
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <label>Prontuário:</label>
                <div><?= nl2br(htmlspecialchars($pet_data['prontuario_pet'] ?? 'N/A')); ?></div>
            </div>
            <div class="form-actions">
                <button type="button" class="secondary-btn" onclick="window.location.href='../gerenc/gerenc_pet.php'">Voltar para Gerenciamento de Pets</button>
            </div>
        </div>
    </div>
</body>
</html>
