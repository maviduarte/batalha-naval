<?php
// Recebe o nome do jogador via POST
$jogador = trim($_POST['jogador'] ?? 'JogadorDesconhecido');
$jogador = urlencode($jogador);

// Redireciona para game.php com o nome do jogador na URL
header("Location: game.php?jogador=$jogador");
exit;
?>
