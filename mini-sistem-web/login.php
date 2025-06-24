<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pet Shop</title>
    <link rel="stylesheet" href="styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
     <!-- Mensagem de sucesso -->
    <?php
        if (isset($_SESSION["msg_sucesso"])) :
    ?>
        <div class="alert">
            <?php echo ($_SESSION["msg_sucesso"]); ?>
        </div>
    <?php 
        unset($_SESSION["msg_sucesso"]);  
        endif;
    ?>

    <div class="login-container">
        <h2>Bem-vindo(a) de volta!</h2>
        <form method="POST" action="valida_login.php">
            <div class="input-group">
                <label for="username">Usuário ou E-mail</label>
                <input type="text" id="username" name="usuario" placeholder="Seu usuário ou e-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="senha" placeholder="Sua senha" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        <div class="links-adicionais">
            <a href="#">Esqueceu a senha?</a>
            <span>•</span>
            <a href="#">Cadastre-se</a>
        </div>
    </div>
</body>
</html>