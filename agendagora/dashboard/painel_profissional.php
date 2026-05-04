<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

// Dados do usuário
$nomeUsuario = $_SESSION['usuario_nome'] ?? 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>AgendAgora - Painel Profissional</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonte -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="app">

<!-- SIDEBAR -->

<?php include "includes/sidebar.php"; ?>

<!-- USUÁRIO -->
<div class="user-box">

<div class="user-avatar">
<?= strtoupper(substr($nomeUsuario,0,2)) ?>
</div>

<div class="user-info">
<div class="user-name"><?= htmlspecialchars($nomeUsuario) ?></div>
<div class="user-role">Profissional</div>
</div>

</div>

</aside>


<!-- CONTEÚDO -->
<main class="main">

<header class="header">

<div>
<h1>Olá, <?= htmlspecialchars($nomeUsuario) ?>!</h1>
<p>Sua agenda de hoje</p>
</div>

</header>


<!-- CARDS -->
<section class="stats">

<div class="stat-card">
<div class="stat-icon">📅</div>

<div>
<div class="stat-number">3</div>
<div class="stat-label">Agendamentos hoje</div>
</div>

</div>


<div class="stat-card">
<div class="stat-icon stat-icon-orange">⏰</div>

<div>
<div class="stat-number">12</div>
<div class="stat-label">Próximos 7 dias</div>
</div>

</div>


<div class="stat-card">
<div class="stat-icon stat-icon-green">💸</div>

<div>
<div class="stat-number">R$200</div>
<div class="stat-label">Faturamento hoje</div>
</div>

</div>


<div class="stat-card">
<div class="stat-icon stat-icon-yellow">👤</div>

<div>
<div class="stat-number">58</div>
<div class="stat-label">Clientes</div>
</div>

</div>

</section>

<section class="content-row">

<div class="card schedule-card">

<div class="card-header">
<h2>Agendamentos de hoje</h2>
</div>

<ul class="schedule-list">

<li class="schedule-item">

<div class="time">09:00</div>

<div class="info">
<div class="name">Maria Silva</div>
<div class="service">Reposição de Aula</div>
<div class="duration">⏱ 60 min</div>
</div>

<span class="badge badge-green">Confirmado</span>

</li>

<li class="schedule-item">

<div class="time">16:00</div>

<div class="info">
<div class="name">Carlos Mendes</div>
<div class="service">Sessão de Acompanhamento</div>
<div class="duration">⏱ 60 min</div>
</div>

<span class="badge badge-green">Confirmado</span>

</li>

</ul>

</div>

<div class="quick-card">

<h2 class="quick-title">👉 Acesso Rápido</h2>

<div class="quick-grid">

<div class="quick-item quick-blue">
<div class="icon">🧾</div>
<span>Adicionar Serviço</span>
</div>

<div class="quick-item quick-orange">
<div class="icon">📅</div>
<span>Agendar Cliente</span>
</div>

<div class="quick-item quick-purple">
<div class="icon">⚙️</div>
<span>Configurar Horários</span>
</div>

<div class="quick-item quick-green">
<div class="icon">⏳</div>
<span>Fila de Espera</span>
</div>

</div>

</div>

</section>


</main>

</div>


<!-- MODAL LOGOUT -->

<div id="modalLogout" class="modal">

<div class="modal-box">

<h2>Deseja sair?</h2>

<p>Você será desconectado da sua conta.</p>

<div class="modal-actions">

<button class="btn-cancelar" onclick="fecharModalLogout()">
Cancelar
</button>

<a href="../public/logout.php" class="btn-sair">
Sair
</a>

</div>

</div>

</div>



<script>

function abrirModalLogout(){
document.getElementById("modalLogout").style.display="flex";
}

function fecharModalLogout(){
document.getElementById("modalLogout").style.display="none";
}

</script>


</body>
</html>