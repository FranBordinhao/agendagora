<?php
session_start();
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $especialidade = trim($_POST['especialidade']);
    $descricao = trim($_POST['descricao']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = 'profissional';

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

    // Insere em profissionais
    $stmt2 = $pdo->prepare("INSERT INTO profissionais (usuario_id, especialidade, descricao) VALUES (?, ?, ?)");
    $stmt2->execute([$usuario_id, $especialidade, $descricao]);

    // Cria sessão
    $_SESSION['usuario_id'] = $usuario_id;
    $_SESSION['usuario_nome'] = $nome;
    $_SESSION['usuario_tipo'] = 'profissional';

    header("Location: ../dashboard/painel_profissional.php");
    exit;
}
