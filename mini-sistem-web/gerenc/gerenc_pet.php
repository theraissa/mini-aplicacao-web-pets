<?php
    //$especie_pet pega o id da especie
    function especiePorID($conn, $especie_pet) {
        $stmt = $conn->prepare("SELECT especie FROM especies WHERE id = ?");
        $stmt->bind_param("i", $especie_pet);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $especie = $resultado->fetch_assoc()["especie"] ?? 'N/A';
        $stmt->close();
        return $especie;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pet Shop</title>
    <link rel="stylesheet" href="../styles/gerenc.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body id="gerenc_pet_especie">
    <div class="main-container">
        <h1>Gerenciamento de Pet Shop</h1>
        <button class="btn_gerenciar" type="button" onclick="window.location.href='../especie/gerenc_especie.php'">Gerenciar Espécies</button>

        <!-- Seção de Gerenciamento de Pets -->
        <div class="section-container">
            <h2>Gerenciar Pets</h2>
            <form action="../gerenc/valida_gerenc.php" method="POST">
                <input type="hidden" name="id_pet">
                <div class="form-group">
                    <label for="pet-name">Nome do Pet:</label>
                    <input type="text" id="pet-name" name="nome_pet" placeholder="Nome do pet" required>
                </div>
                <div class="form-group">
                    <label for="pet-birthdate">Nascimento:</label>
                    <input type="date" id="pet-birthdate" name="nasc_pet" required>
                </div>
                <div class="form-group">
                    <label for="pet-species">Espécie:</label>
                    <select name="especie_pet">
                        <?php
                            require("../conecta_bd.php");

                           $stmt = $conn->prepare("SELECT * FROM especies");
                            $stmt->execute();
                            $resultado = $stmt->get_result();

                            while ($row = mysqli_fetch_assoc($resultado) ):
                        ?>
                        <option value="<?=$row['id']?>"><?= $row["especie"]?></option>

                        <?php
                            endwhile;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gênero:</label>
                    <div class="radio-group">
                        <label for="gender-macho">
                            <input type="radio" id="gender-macho" name="genero_pet" value="Macho" required>
                            Macho
                        </label>
                        <label for="gender-femea">
                            <input type="radio" id="gender-femea" name="genero_pet" value="Fêmea" required>
                            Fêmea
                        </label>
                    </div>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="pet-medical-record">Prontuário:</label>
                    <textarea id="pet-medical-record" name="prontuario_pet" rows="4" placeholder="Informações clínicas, histórico, etc."></textarea>
                </div>
                <div class="form-actions" style="grid-column: 1 / -1;">
                    <button type="submit">Adicionar Pet</button>
                </div>
            </form>
            <?php
                require("../conecta_bd.php");

                if (!$conn){
                    die("Houve um erro ao conectar com o banco de dados");
                }
                
                $stmt = $conn->prepare("SELECT id_pet, nome_pet, DATE_FORMAT(nasc_pet, '%d/%m/%Y') AS nasc_pet, especie_pet, genero_pet, prontuario_pet FROM pet");
                $stmt->execute();
                $resultado = $stmt->get_result();

                if (mysqli_num_rows($resultado) > 0) {
                    echo ('<div class="table-responsive">
                        <table id="species-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Nascimento</th>
                                    <th>Espécie</th>
                                    <th>Gênero</th>
                                    <th>Prontuário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>');

                while ($row = mysqli_fetch_assoc($resultado) ){
                    echo ("<tr class='clickable-row' onclick=\"window.location.href='../gerenc/mostrar_pet.php?id_pet=" . $row['id_pet'] . "'\">");
                    echo ("<td>" . htmlspecialchars($row["id_pet"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["nome_pet"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["nasc_pet"]) . "</td>");
                    echo ("<td>" . especiePorID($conn, $row["especie_pet"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["genero_pet"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["prontuario_pet"]) . "</td>");
                    echo ("<td><a class='button' form='species-form' href='../gerenc/editar_pet.php?id_pet=" . urlencode($row['id_pet'])) . "'>Editar</a>";
                    echo ("<a class='button' form='species-form' id='delete-btn' href='../gerenc/excluir_pet.php?id_pet=" . urlencode($row['id_pet'])) . "'>Excluir</a></td>";         
                    echo ("</tr>"); 
                }
                
                echo ("</tbody></table>"); 
                } else {
                    echo ("<h1>Não há nada para ser exibido</h1>");
                }
            ?>  
            </div>
        </div>
    </div>
</body>
</html>
