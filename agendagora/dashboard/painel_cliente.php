<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'cliente') {
    header("Location: ../public/login.php");
    exit;
}

$nomeUsuario = $_SESSION['nome'] ?? 'Cliente';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Cliente | AgendAgora</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: #f4f8fc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #ffffff;
            width: 420px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            text-align: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #4da3ff;
        }

        .logo span {
            color: #1f2937;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        h2 {
            margin-bottom: 25px;
            color: #1f2937;
        }

        .menu a {
            display: block;
            margin-bottom: 12px;
            padding: 12px;
            background: #4da3ff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .menu a:hover {
            background: #3694f0;
        }

        .logout {
            margin-top: 20px;
        }

        .logout a {
            color: #6b7280;
            font-size: 14px;
            text-decoration: none;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            Agend<span>Agora</span>
        </div>
        <div class="subtitle">
            Agendamento Inteligente
        </div>

        <h2>Olá, <?= htmlspecialchars($nomeUsuario) ?> 👋</h2>

        <div class="menu">
            <a href="#">Agendar Horário</a>
            <a href="#">Meus Agendamentos</a>
            <a href="#">Meu Perfil</a>
        </div>

        <div class="logout">
            <a href="../public/logout.php">Sair</a>
        </div>
    </div>

</body>
</html>
