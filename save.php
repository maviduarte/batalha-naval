<?php
// Conexão com o banco de dados
require "db.php";
// Recebe os dados enviados via POST
$dados = json_decode(file_get_contents("php://input"), true);

// Prepara e executa a inserção dos dados no banco de dados
$jogador = $dados["jogador"] ?? "Jogador indefinido";
$bombas = $dados["bombas"] ?? 0;
$acertos = $dados["acertos"] ?? 0;
$taxa = $dados["taxa"] ?? 0;
$resultado = $dados["resultado"] ?? 'indefinido';

// Insere os dados na tabela ranking
$stmt = $pdo->prepare("INSERT INTO ranking (jogador, bombas, acertos, taxa, resultado, data_jogo) VALUES (?, ?, ?, ?, ?, NOW())");
$executou = $stmt->execute([$jogador, $bombas, $acertos, $taxa, $resultado]);

// Retorna uma resposta JSON indicando sucesso ou falha
if ($executou) {
    echo json_encode(["status" => "ok", "msg" => "Estatísticas salvas com sucesso!"]);
} else {
    echo json_encode(["status" => "error", "msg" => "Falha ao salvar as estatísticas."]);
}
?>
