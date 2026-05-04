<?php
session_start();
require_once "../config/conexao.php";

$profissional_id = $_SESSION['usuario_id'];

$cliente = $_POST['cliente_id'];
$servico = $_POST['servico_id'];
$hora = $_POST['hora'];
$dia = $_POST['dia'];

/* gera data baseada no dia da semana */
$data = date('Y-m-d', strtotime("next monday +".($dia-1)." days"));

$sql = "INSERT INTO agendamentos 
(cliente_id, profissional_id, servico_id, data_agendamento, hora_inicio, hora_fim)
VALUES (?,?,?,?,?,?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
$cliente,
$profissional_id,
$servico,
$data,
"$hora:00:00",
"$hora:59:00"
]);

header("Location: ../dashboard/agenda.php");
exit;