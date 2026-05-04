<?php
session_start();
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $especialidade = $_POST['especialidade'];
    $descricao = $_POST['descricao'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = 'profissional';

    $sql = "INSERT INTO usuarios 
            (nome, email, telefone, senha, tipo, especialidade, descricao)
            VALUES 
            (:nome, :email, :telefone, :senha, :tipo, :especialidade, :descricao)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':especialidade', $especialidade);
    $stmt->bindParam(':descricao', $descricao);

    $stmt->execute();

    $id = $pdo->lastInsertId();

    $_SESSION['usuario_id'] = $id;
    $_SESSION['usuario_nome'] = $nome;
    $_SESSION['usuario_tipo'] = 'profissional';

    header("Location: ../dashboard/painel_profissional.php");
    exit;
}
?>