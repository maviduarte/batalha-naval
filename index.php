<?php
// Inicia a sessão para armazenar dados do usuário
session_start();

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jogador = htmlspecialchars($_POST['jogador']);
    $_SESSION['nome'] = $jogador;
    
    // Redireciona para a página do jogo
    header("Location: game.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="files/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- script da biblioteca jQuery (importada via internet) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Batalha Naval - Iniciar</title>
</head>
<body>
    <!-- Fundo da página -->
    <div class="background">
        <div class="bolhas">
            <span style="--i:11"></span>
            <span style="--i:21"></span>
            <span style="--i:4"></span>
            <span style="--i:23"></span>
            <span style="--i:14"></span>
            <span style="--i:16"></span>
            <span style="--i:36"></span>
            <span style="--i:42"></span>
            <span style="--i:9"></span>
            <span style="--i:1"></span>
            <span style="--i:35"></span>
            <span style="--i:66"></span>
            <span style="--i:94"></span>
            <span style="--i:27"></span>
            <span style="--i:15"></span>
            <span style="--i:19"></span>
            <span style="--i:2"></span>
            <span style="--i:13"></span>
            <span style="--i:11"></span>
            <span style="--i:21"></span>
            <span style="--i:4"></span>
            <span style="--i:23"></span>
            <span style="--i:14"></span>
            <span style="--i:16"></span>
            <span style="--i:36"></span>
            <span style="--i:42"></span>
            <span style="--i:9"></span>
            <span style="--i:1"></span>
            <span style="--i:35"></span>
            <span style="--i:66"></span>
            <span style="--i:94"></span>
            <span style="--i:27"></span>
            <span style="--i:15"></span>
            <span style="--i:19"></span>
            <span style="--i:2"></span>
            <span style="--i:13"></span>
            <span style="--i:21"></span>
            <span style="--i:4"></span>
            <span style="--i:23"></span>
            <span style="--i:14"></span>
            <span style="--i:16"></span>
            <span style="--i:36"></span>
            <span style="--i:42"></span>
            <span style="--i:9"></span>
            <span style="--i:1"></span>
            <span style="--i:35"></span>
            <span style="--i:66"></span>
            <span style="--i:94"></span>
            <span style="--i:27"></span>
            <span style="--i:15"></span>
            <span style="--i:19"></span>
            <span style="--i:2"></span>
            <span style="--i:13"></span>
        </div>
    </div>
    <!-- Container principal -->
    <div class="container">
        <!-- Formulário de entrada -->
        <div class="form">
            <!-- Cabeçalho do formulário -->
            <div class="form-header">
                <h1>Batalha Naval</h1>
            </div>
            <!-- Formulário para capturar o nome do jogador -->
            <form action="create.php" method="post">
                <div class="group">
                    <!-- Caixa de entrada para o nome do jogador -->
                    <div class="input-box">
                        <input type="text" name="jogador" title="Esperando você digitar..." placeholder="Digite seu Nickname" required>
                    </div>
                    <!-- Botão para iniciar o jogo -->
                    <div class="start-button">
                        <button type="submit">Iniciar Batalha</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Checkbox para habilitar e desabilitar som de fundo -->
        <label class="sound-checkbox">
            <input type="checkbox" id="sound-checkbox" checked>
            <span class="checkstyle"></span>
            Som
        </label>
    </div>
    
    <!-- Som de fundo -->
    <audio id="intro" loop>
        <source src="sounds/intro.mp3">
        <source src="sounds/intro.wav">
    </audio>

    <!-- Script para controlar o som de fundo -->
    <script>
        var check = document.getElementById('sound-checkbox');
        var audio = document.getElementById('intro');
        audio.play();

        check.addEventListener('change', () => {
            if(check.checked) {
                audio.play();
            } else {
                audio.pause();
                audio.currentTime = 0;
            }
        })
    </script>
</body>
</html>