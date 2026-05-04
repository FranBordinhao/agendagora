<?php

session_start();
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$profissional_id = $_POST['profissional_id'];
$nome_servico = $_POST['nome_servico'];
$descricao = $_POST['descricao'] ?? '';
$duracao = $_POST['duracao'];
$preco = $_POST['preco'];

$sql = "INSERT INTO servicos 
(profissional_id, nome_servico, descricao, duracao, preco, status) 
VALUES (?, ?, ?, ?, ?, 'ativo')";

$stmt = $pdo->prepare($sql);

$stmt->execute([
$profissional_id,
$nome_servico,
$descricao,
$duracao,
$preco
]);

header("Location: ../dashboard/servicos.php");
exit;

}