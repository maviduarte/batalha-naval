<?php
    // Conexão com o banco de dados
    require 'db.php';

    // Consulta para obter os 10 melhores jogadores ordenados por acertos e taxa
    $stmt = $pdo->query("SELECT jogador, bombas, taxa, resultado, data_jogo 
                     FROM ranking 
                     ORDER BY acertos DESC, taxa DESC 
                     LIMIT 10");
    // Executa a consulta e obtém os resultados
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="files/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/score.css" type="text/css">
    <title>Ranking de Pontuação</title>
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
    </div>
    <!-- Container principal -->
    <div class="container">
        <!-- Tabela de ranking -->
        <div class="table">
            <table class="table-content">
                <!-- Cabeçalho da tabela -->
                <div class="table-header">
                    <h1>Ranking de Pontuação</h1><br>
                    <p>Abaixo estão listados os jogadores com suas respectivas pontuações.</p>
                </div>
                <!-- Corpo da tabela -->
                <table>
                    <tr>
                        <th>Jogador</th><th>Tentativas</th><th>Taxa (%)</th><th>Resultado</th><th>Data</th>
                    </tr>
                    <!-- Linhas de dados -->
                    <?php foreach ($dados as $linha): ?>
                    <tr>
                        <td><?= htmlspecialchars($linha['jogador']) ?></td>
                        <td><?= $linha['bombas'] ?></td>
                        <td><?= $linha['taxa'] ?></td>
                        <td><?= $linha['resultado'] ?></td>
                        <td><?= $linha['data_jogo'] ? date("d/m/Y H:i", strtotime($linha['data_jogo'])) : '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <!-- Botão de novo jogo -->
                <div class="new-button">
                    <button onclick="document.location='index.php'">Novo Jogo</button>
                </div>
            </table>
        </div>
    </div>
    <!-- Checkbox para habilitar e desabilitar som de fundo -->
    <label class="sound-checkbox">
        <input type="checkbox" id="sound-checkbox" checked>
        <span class="checkstyle"></span>
        Som
    </label>
    
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