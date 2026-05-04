<?php
session_start();
require_once __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$email = trim($_POST['email']);
$senha = $_POST['senha'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    die("E-mail ou senha inválidos.");
}

// cria sessão
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_tipo'] = $usuario['tipo'];

// redireciona
if ($usuario['tipo'] === 'cliente') {
    header("Location: ../dashboard/painel_cliente.php");
    exit;
}

if ($usuario['tipo'] === 'profissional') {
    header("Location: ../dashboard/painel_profissional.php");
    exit;
}

header("Location: login.php");
exit;