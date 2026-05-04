<?php
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    // Remove da tabela clientes primeiro
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE usuario_id = ?");
    $stmt->execute([$id]);

    // Remove da tabela usuarios
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ? AND tipo = 'cliente'");
    $stmt->execute([$id]);
}

header("Location: ../dashboard/clientes.php");
exit;
