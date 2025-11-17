<?php
// Obtém o nome do jogador da URL, se disponível
$jogador = $_GET['jogador'] ?? 'JogadorDesconhecido';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="files/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/start.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- script da biblioteca jQuery (importada via internet) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>Batalha Naval</title>
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
        <!-- Header do jogo -->
        <div class="header">
            <h1>Batalha Naval</h1>
            <!--<p>Prepare-se para a batalha!</p>-->
        </div>
        <!-- Área do jogo -->
        <div class="game-board">
            <section id="game"></section>
        </div>
        <!-- Botões de ação -->
        <div class="buttons">
            <!-- Botão de reiniciar -->
            <div class="restart-button">
                <button onclick="location.reload()">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
              <!-- Botão de ranking -->
            <div class="score-button">
                <button onclick="btn_ranking()" id="btnScore">Ranking</button>
           </div>
            <!-- Botão de novo jogo -->
            <div class="new-button">
               <button onclick="document.location='index.php'">Novo Jogo</button>
            </div>
            <!-- Botão de manual -->
            <div class="manual-button">
                <button id="btnManual" onclick="btn_manual()">Manual</button>
            </div>
       </div>
       <!-- Checkbox para habilitar e desabilitar som de fundo -->
        <label class="sound-checkbox">
            <input type="checkbox" id="sound-checkbox" checked>
            <span class="checkstyle"></span>
            Som
        </label>
    </div>
    <!-- Sons do jogo -->
    <audio id="melody" loop>
            <source src="sounds/melody.mp3">
            <source src="sounds/melody.wav">
        </audio>
        <audio id="miss">
            <source src="sounds/miss.mp3">
            <source src="sounds/miss.wav">
        </audio>
        <audio id="hit">
            <source src="sounds/hit.mp3">
            <source src="sounds/hit.wav">
        </audio>
        <audio id="win">
            <source src="sounds/win.mp3">
            <source src="sounds/win.wav">
        </audio>
        <audio id="gameover">
            <source src="sounds/gameover.mp3">
            <source src="sounds/gameover.wav">
        </audio>
        <audio id="click">
            <source src="sounds/click.mp3">
            <source src="sounds/click.wav">
        </audio>
    <!-- Scripts -->
<!-- script da biblioteca SweetAlert2 (importada via file) -->
<script src="js/sweetalert2.js"></script> 
<!-- Passa o nome do jogador para o JavaScript -->    
<script>
    const jogador = <?php echo json_encode($_GET['jogador'] ?? 'Desconhecido'); ?>;
</script>
    <!-- script do jogo -->
<script src="./js/game.js"></script>
</body>
</html>