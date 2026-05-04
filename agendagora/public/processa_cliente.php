<?php
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $telefone = trim($_POST["telefone"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $tipo = "cliente";

    // Verifica email duplicado
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verifica->execute([$email]);
    if ($verifica->rowCount() > 0) {
        die("Este e-mail já está cadastrado.");
    }

    // Insere em usuarios
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, senha, tipo) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $senha, $tipo]);
    $usuario_id = $pdo->lastInsertId();

    // Insere em clientes
    $stmt2 = $pdo->prepare("INSERT INTO clientes (usuario_id, telefone) VALUES (?, ?)");
    $stmt2->execute([$usuario_id, $telefone]);

    header("Location: ../dashboard/clientes.php");
    exit;
}
