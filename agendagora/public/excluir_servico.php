<?php

require_once "../config/conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM servicos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../dashboard/servicos.php");
exit;