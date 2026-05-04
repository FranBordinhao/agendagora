<?php
require_once "../config/conexao.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM usuarios WHERE id = ? AND tipo = 'cliente'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header("Location: ../dashboard/clientes.php");
exit;