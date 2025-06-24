<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espécie</title>
    <link rel="stylesheet" href="../styles/gerenc.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        $id_especie = $_GET["id_especie"] ? (int) $_GET["id_especie"] : 0; 
        
        require("../conecta_bd.php"); 
        if (!$conn){
            die("Houve um erro ao conectar com o banco de dados");
        }   

        $sql = "SELECT * FROM especies WHERE id = ?";

        $stmt = $conn->prepare($sql);    
        $stmt->bind_param("i", $id_especie); 
        $stmt->execute(); 
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $especies = $resultado->fetch_assoc();

            $especie = $especies["especie"];
        } else {
            header("location: ../especie/gerenc_especie.php");
        }
        
        $stmt->close(); 
        $conn->close(); 
    ?>
    <div class="main-container">
        <h1>Editar Espécie</h1>

        <div class="section-container">
            <h2>Alterar Nome da Espécie</h2>
            <form action="../especie/valida_especie.php" method="POST">
                <input type="hidden" name="id_especie" value="<?= $id_especie ?>"> 
                <div class="form-group">
                    <label for="species-name-edit">Novo Nome da Espécie:</label>
                    <input type="text" id="species-name-edit" name="especie" value="<?= $especie?>" placeholder="Ex: Gato" required>
                </div>
            
                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                    <button class="secondary-btn" type="submit" onclick="window.location.href='../especie/gerenc_especie.php'">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
