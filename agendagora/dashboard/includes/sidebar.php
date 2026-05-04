<?php

// inicia sessão somente se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$paginaAtual = basename($_SERVER['PHP_SELF']);
$nomeUsuario = $_SESSION['usuario_nome'] ?? 'Usuário';

?>

<aside class="sidebar">

<div class="logo-box">
<div class="logo-icon">✨</div>

<div class="logo-text">
<span class="logo-title">AgendAgora</span>
<span class="logo-subtitle">Agendamento Inteligente</span>
</div>
</div>

<nav class="menu">

<p class="menu-title">MENU PRINCIPAL</p>

<a class="menu-item <?= ($paginaAtual == 'painel_profissional.php') ? 'active' : '' ?>" href="painel_profissional.php">
<span class="menu-icon">🏠</span>
<span>Painel</span>
</a>

<a class="menu-item <?= ($paginaAtual == 'agenda.php') ? 'active' : '' ?>" href="agenda.php">
<span class="menu-icon">📅</span>
<span>Agenda</span>
</a>

<a class="menu-item <?= ($paginaAtual == 'clientes.php') ? 'active' : '' ?>" href="clientes.php">
<span class="menu-icon">👥</span>
<span>Clientes</span>
</a>

<a class="menu-item" href="#">
<span class="menu-icon">⏳</span>
<span>Fila de Espera</span>
</a>

<a class="menu-item <?= ($paginaAtual == 'servicos.php') ? 'active' : '' ?>" href="servicos.php">
<span class="menu-icon">🧾</span>
<span>Serviços</span>
</a>

<a class="menu-item" href="#">
<span class="menu-icon">📊</span>
<span>Relatórios</span>
</a>

<a class="menu-item" href="#">
<span class="menu-icon">⚙️</span>
<span>Configurações</span>
</a>

</nav>

<!-- BOTÃO SAIR -->
<a class="menu-item logout" href="#" onclick="abrirModalLogout()">
<span class="menu-icon">🚪</span>
<span>Sair</span>
</a>

<!-- USUÁRIO -->
<div class="user-box">

<div class="user-avatar">
<?= strtoupper(substr($nomeUsuario,0,1)) ?>
</div>

<div class="user-info">
<div class="user-name"><?= htmlspecialchars($nomeUsuario) ?></div>
<div class="user-role">Profissional</div>
</div>

</div>

</aside>

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