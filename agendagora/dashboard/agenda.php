<?php
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

$profissional_id = $_SESSION['usuario_id'];

$sql = "
SELECT 
    a.*,
    u.nome AS cliente_nome,
    s.nome_servico,
    s.duracao
FROM agendamentos a
JOIN clientes c ON c.id = a.cliente_id
JOIN usuarios u ON u.id = c.usuario_id
JOIN servicos s ON s.id = a.servico_id
WHERE a.profissional_id = ?
ORDER BY a.data_agendamento ASC, a.hora_inicio ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$profissional_id]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$agendamentos) {
    $agendamentos = [];
}

$eventos = [];
foreach ($agendamentos as $ag) {
    $hora = (int) date('H', strtotime($ag['hora_inicio']));
    $diaSemana = (int) date('N', strtotime($ag['data_agendamento']));
    $eventos[$hora][$diaSemana] = $ag;
}
?>
