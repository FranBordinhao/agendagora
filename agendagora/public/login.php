<?php
session_start();

// Se já estiver logado, redireciona
if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_tipo'])) {

    if ($_SESSION['usuario_tipo'] === 'cliente') {
        header("Location: ../dashboard/painel_cliente.php");
        exit;
    }

    if ($_SESSION['usuario_tipo'] === 'profissional') {
        header("Location: ../dashboard/painel_profissional.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login | AgendAgora</title>

    <!-- CSS GLOBAL -->
<link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body class="auth-page">

<div class="login-container">
        
    <div class="logo">
        Agend<span>Agora</span>
    </div>

    <div class="subtitle">
        Agendamento Inteligente
    </div>

    <h2>Entrar</h2>

    <?php if (isset($_GET['erro'])): ?>
        <div class="erro">E-mail ou senha inválidos.</div>
    <?php endif; ?>

    <form action="processa_login.php" method="POST">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

    <div class="link">
        Ainda não tem conta?
        <a href="cadastro.php">Crie seu cadastro</a>
    </div>

</div>

</body>
</html>