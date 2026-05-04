<?php
session_start();
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = 'cliente';

    // verifica email duplicado
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $verifica->bindParam(':email', $email);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {
        die("Este e-mail já está cadastrado.");
    }

    $sql = "INSERT INTO usuarios (nome, email, telefone, senha, tipo)
            VALUES (:nome, :email, :telefone, :senha, :tipo)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);

    $stmt->execute();

    $id = $pdo->lastInsertId();

    // cria sessão automática
    $_SESSION['usuario_id'] = $id;
    $_SESSION['usuario_nome'] = $nome;
    $_SESSION['usuario_tipo'] = 'cliente';

    // vai direto para o painel
    header("Location: ../dashboard/painel_cliente.php");
    exit;
}
?>