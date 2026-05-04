<?php
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

$profissional_id = $_SESSION['usuario_id'];

/* ================================
   BUSCAR AGENDAMENTOS (SEM FILTRO TEMPORÁRIO)
================================ */
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
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$profissional_id]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 🔎 DEBUG TEMPORÁRIO (COLOCA AQUI)
echo "ID LOGADO: " . $profissional_id;

echo "<pre>";
print_r($agendamentos);
echo "</pre>";



/* evita erro caso não tenha dados */
if (!$agendamentos) {
    $agendamentos = [];
}

/* ================================
   ORGANIZAR PARA CALENDÁRIO
================================ */
$eventos = [];

foreach($agendamentos as $ag){
    $hora = (int) date('H', strtotime($ag['hora_inicio']));
    $diaSemana = (int) date('N', strtotime($ag['data_agendamento']));
    $eventos[$hora][$diaSemana] = $ag;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Agenda - AgendAgora</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../assets/css/style.css">

<style>
.agenda-calendar{
background:#fff;
border-radius:12px;
padding:20px;
margin-top:20px;
}

.row{
display:grid;
grid-template-columns:80px repeat(6,1fr);
border-top:1px solid #eee;
min-height:80px;
}

.cell{
border-left:1px solid #eee;
position:relative;
cursor:pointer;
}

.evento{
position:absolute;
top:5px;
left:5px;
right:5px;
background:#6c5ce7;
color:#fff;
padding:6px;
border-radius:6px;
font-size:12px;
}
</style>

</head>
<body>

<div class="app">

<!-- SIDEBAR -->
<?php include __DIR__ . "/includes/sidebar.php"; ?>

<!-- CONTEÚDO -->
<main class="main">

<header class="header">

<div>
<h1>Agenda</h1>
<p>Gerencie seus agendamentos</p>
</div>

<div class="header-actions">
<button class="btn-tab active" onclick="mostrarLista()">📋 Lista</button>
<button class="btn-tab" onclick="mostrarCalendario()">📅 Calendário</button>
<button class="btn-novo">+ Novo Agendamento</button>
</div>

</header>

<!-- CARDS -->
<section class="stats">

<div class="stat-card">
<div class="stat-icon">📅</div>
<div>
<div class="stat-number"><?= count($agendamentos) ?></div>
<div class="stat-label">Hoje</div>
</div>
</div>

<div class="stat-card">
<div class="stat-icon stat-icon-green">✔</div>
<div>
<div class="stat-number">--</div>
<div class="stat-label">Confirmados</div>
</div>
</div>

<div class="stat-card">
<div class="stat-icon stat-icon-orange">⚠</div>
<div>
<div class="stat-number">--</div>
<div class="stat-label">Pendentes</div>
</div>
</div>

<div class="stat-card">
<div class="stat-icon stat-icon-purple">👤</div>
<div>
<div class="stat-number"><?= count($agendamentos) ?></div>
<div class="stat-label">Total</div>
</div>
</div>

</section>

<!-- ================= LISTA ================= -->
<div id="listaView">

<section class="agenda-lista">
<h2>📅 Agendamentos</h2>

<?php if(count($agendamentos) === 0): ?>
<p style="padding:20px;">Nenhum agendamento encontrado.</p>
<?php endif; ?>

<?php foreach($agendamentos as $ag): ?>

<div class="agenda-card">

<div class="hora">
<strong><?= substr($ag['hora_inicio'],0,5) ?></strong>
<span><?= date('d/m/Y', strtotime($ag['data_agendamento'])) ?></span>
</div>

<div class="info">

<div class="top">
<strong><?= htmlspecialchars($ag['cliente_nome']) ?></strong>
</div>

<div class="desc"><?= htmlspecialchars($ag['nome_servico']) ?></div>

<div class="meta">
⏱ <?= $ag['duracao'] ?> min
</div>

</div>

</div>

<?php endforeach; ?>

</section>

</div>

<!-- ================= CALENDÁRIO ================= -->
<div id="calendarView" style="display:none;">

<div class="agenda-calendar">

<div class="row" style="font-weight:bold;">
<div>Hora</div>
<div>Seg</div>
<div>Ter</div>
<div>Qua</div>
<div>Qui</div>
<div>Sex</div>
<div>Sáb</div>
</div>

<?php for($h=8;$h<=18;$h++): ?>

<div class="row">

<div class="hora"><?= $h ?>:00</div>

<?php for($d=1;$d<=6;$d++): ?>

<div class="cell">

<?php if(isset($eventos[$h][$d])): 
$ev = $eventos[$h][$d];
?>

<div class="evento">
<strong><?= htmlspecialchars($ev['cliente_nome']) ?></strong><br>
<?= htmlspecialchars($ev['nome_servico']) ?>
</div>

<?php endif; ?>

</div>

<?php endfor; ?>

</div>

<?php endfor; ?>

</div>

</div>

</main>

</div>

<script>

function mostrarLista(){
document.getElementById("listaView").style.display = "block";
document.getElementById("calendarView").style.display = "none";
}

function mostrarCalendario(){
document.getElementById("listaView").style.display = "none";
document.getElementById("calendarView").style.display = "block";
}

</script>

</body>
</html>