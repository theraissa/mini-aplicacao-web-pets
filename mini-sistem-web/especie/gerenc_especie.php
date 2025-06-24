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
        <button class="btn_gerenciar" type="submit" onclick="window.location.href='../gerenc/gerenc_pet.php'">Gerenciar Pet</button>

        <!-- Seção de Gerenciamento de Espécies -->
        <div class="section-container">
            <h2>Gerenciar Espécies</h2>
            <form action="../especie/valida_especie.php" method="POST">
                <input type="hidden" name="species_id" value="">
                <div class="form-group">
                    <label for="species-name">Nome da Espécie:</label>
                    <input type="text" id="species-name" name="especie" placeholder="Ex: Cachorro" required>
                </div>
                <div class="form-actions">
                    <button type="submit">Adicionar Espécie</button>
                </div>
            </form>
            <?php
                require("../conecta_bd.php");

                if (!$conn){
                    die("Houve um erro ao conectar com o banco de dados");
                }
                
                $stmt = $conn->prepare("SELECT id, especie FROM especies");
                $stmt->execute(); 
                $resultado = $stmt->get_result();

                if (mysqli_num_rows($resultado) > 0) {
                    echo ('<div class="table-responsive">
                        <table id="species-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>');

                while ($row = mysqli_fetch_assoc($resultado) ){
                    $id = htmlspecialchars(urlencode($row['id']));

                    echo ("<tr>");  
                    echo ("<td>" . htmlspecialchars($row["id"]) . "</td>");
                    echo ("<td>" . htmlspecialchars($row["especie"]) . "</td>");
                    echo ("<td><a class='button' href='../especie/editar_especie.php?id_especie=$id'>Editar</a>");
                    echo ("<a class='button' id='delete-btn' href='../especie/excluir_especie.php?id_especie=$id'>Excluir</a><td>");       
                    echo ("</tr>"); 
                }
                echo ("</tbody></table>"); 

                } else {
                    echo ("<h1>Não há nada para ser exibido</h1>");
                }

                $stmt->close();
                $conn->close();
            ?>
            </div>
        </div>
    </div>
</body>
</html>
