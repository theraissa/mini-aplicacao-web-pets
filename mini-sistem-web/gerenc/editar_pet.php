<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pet</title>
    <link rel="stylesheet" href="../styles/gerenc.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        $id_pet = $_GET["id_pet"] ? (int) $_GET["id_pet"] : 0; 
        
        require("../conecta_bd.php"); 
        if (!$conn){
            die("Houve um erro ao conectar com o banco de dados");
        }   

        $stmt = $conn->prepare("SELECT id_pet, nome_pet, nasc_pet, especie_pet, genero_pet, prontuario_pet FROM pet WHERE id_pet = ?");
        $stmt->bind_param("i", $id_pet); 
        $stmt->execute(); 
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $pets = $resultado->fetch_assoc();

            $nome_pet = $pets["nome_pet"];
            $nasc_pet = $pets["nasc_pet"];
            $especie_pet = $pets["especie_pet"];
            $genero_pet = $pets["genero_pet"];
            $prontuario_pet = $pets["prontuario_pet"];
        } else {
            header("location: ../gerenc/gerenc_pet.php");
        }

        $stmt->close(); 
        $conn->close(); 
    ?>
    <div class="main-container">
        <h1>Editar Pet</h1>

        <div class="section-container">
            <h2>Alterar Informações do Pet</h2>
            <form action="../gerenc/valida_gerenc.php" method="POST">
                <input type="hidden" name="id_pet" value="<?= $id_pet ?>"> 
                
                <div class="form-group">
                    <label for="pet-name">Nome do Pet:</label>
                    <input type="text" id="pet-name" name="nome_pet" value="<?= $nome_pet ?>" placeholder="Nome do pet" required>
                </div>
                <div class="form-group">
                    <label for="pet-birthdate">Nascimento:</label>
                    <input type="date" id="pet-birthdate" name="nasc_pet" value="<?= $nasc_pet ?>" required>
                </div>
                <div class="form-group">
                    <label for="pet-species">Espécie:</label>
                    <select id="pet-species" name="especie_pet" value="<?= $especie_pet ?>" required>                        
                        <?php
                            require("../conecta_bd.php");
                            
                            $stmt = $conn->prepare("SELECT * FROM especies");
                            $stmt->execute(); 
                            $resultado = $stmt->get_result();

                            while ($row = mysqli_fetch_assoc($resultado)):
                                $selected = ($row['id'] == $especie_pet) ? 'selected' : '';
                            ?>

                            <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row["especie"] ?></option>

                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gênero:</label>
                    <div class="radio-group">
                        <label for="gender-macho">
                            <input type="radio" id="gender-macho" name="genero_pet" value="Macho" <?= ($genero_pet == "Macho") ? 'checked' : '' ?>>
                            Macho
                        </label>
                            <label for="gender-femea">
                            <input type="radio" id="gender-femea" name="genero_pet" value="Fêmea" <?= ($genero_pet == "Fêmea") ? 'checked' : '' ?>>
                            Fêmea
                        </label>
                    </div>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="pet-medical-record">Prontuário:</label>
                    <textarea id="pet-medical-record" name="prontuario_pet" rows="4"><?= htmlspecialchars($prontuario_pet ?? '') ?></textarea>
                </div>
                <div class="form-actions" style="grid-column: 1 / -1;">
                    <button type="submit">Salvar Alterações</button>
                    <button type="button" class="secondary-btn" onclick="window.location.href='../gerenc/gerenc_pet.php'">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
