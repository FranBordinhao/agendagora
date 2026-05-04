<?php
session_start();
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = 'cliente';

    // Verifica email duplicado
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verifica->execute([$email]);

    if ($verifica->rowCount() > 0) {
        die("Este e-mail já está cadastrado.");
    }

    // Insere em usuarios
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, senha, tipo) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $senha, $tipo]);

    $id = $pdo->lastInsertId();

    // Insere também na tabela clientes
    $stmtCliente = $pdo->prepare("INSERT INTO clientes (usuario_id, telefone) VALUES (?, ?)");
    $stmtCliente->execute([$id, $telefone]);

    // Cria sessão
    $_SESSION['usuario_id'] = $id;
    $_SESSION['usuario_nome'] = $nome;
    $_SESSION['usuario_tipo'] = 'cliente';

    header("Location: ../dashboard/painel_cliente.php");
    exit;
}
