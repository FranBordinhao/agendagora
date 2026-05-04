<?php
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

$nomeUsuario = $_SESSION['usuario_nome'] ?? 'Usuário';

/* FILTROS */
$busca = $_GET['busca'] ?? '';
$letra = $_GET['letra'] ?? '';

$sql = "SELECT * FROM usuarios WHERE tipo = 'cliente'";

$params = [];

if ($busca) {
    $sql .= " AND (nome LIKE ? OR email LIKE ? OR telefone LIKE ?)";
    $params[] = "%$busca%";
    $params[] = "%$busca%";
    $params[] = "%$busca%";
}

if ($letra) {
    $sql .= " AND nome LIKE ?";
    $params[] = "$letra%";
}

$sql .= " ORDER BY nome ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Clientes</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

.clientes-container{
padding:30px;
}

/* TOPO */

.top-actions{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.busca{
padding:10px;
border:1px solid #ddd;
border-radius:8px;
width:280px;
}

/* ALFABETO */

.alfabeto{
display:flex;
gap:6px;
flex-wrap:wrap;
margin-bottom:20px;
}

.alfabeto a{
padding:6px 10px;
border-radius:6px;
background:#f3f4ff;
text-decoration:none;
font-size:13px;
color:#333;
}

.alfabeto a:hover{
background:#dfe3ff;
}

/* LISTA */

.lista-clientes{
background:white;
border-radius:12px;
padding:10px;
height:420px;
overflow-y:auto;
box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.linha{
display:flex;
justify-content:space-between;
padding:12px;
border-bottom:1px solid #eee;
align-items:center;
}

.linha:hover{
background:#f9f9ff;
}

.info{
display:flex;
flex-direction:column;
}

.nome{
font-weight:600;
}

.sub{
font-size:13px;
color:#777;
}

.acoes a{
margin-left:10px;
text-decoration:none;
font-size:13px;
}

.excluir{
color:red;
}

/* BOTÃO */

.btn-add{
background:#4c7cf3;
color:white;
border:none;
padding:10px 15px;
border-radius:8px;
cursor:pointer;
}

/* MODAL */

.modal{
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,0.4);
align-items:center;
justify-content:center;
}

.modal-box{
background:white;
padding:25px;
border-radius:10px;
width:320px;
}

.modal-box input{
width:100%;
padding:10px;
margin-bottom:10px;
border:1px solid #ddd;
border-radius:6px;
}

</style>

</head>

<body>

<div class="app">

<?php include "includes/sidebar.php"; ?>

<main class="main">

<h1>Clientes</h1>

<div class="clientes-container">

<!-- TOPO -->
<div class="top-actions">

<form method="GET">
<input class="busca" type="text" name="busca" placeholder="Buscar cliente..." value="<?= htmlspecialchars($busca) ?>">
</form>

<button class="btn-add" onclick="abrirModal()">+ Novo Cliente</button>

</div>

<!-- ALFABETO -->

<div class="alfabeto">
<a href="clientes.php">Todos</a>

<?php foreach(range('A','Z') as $l): ?>
<a href="?letra=<?= $l ?>"><?= $l ?></a>
<?php endforeach; ?>

</div>

<!-- LISTA -->

<div class="lista-clientes">

<?php if(count($clientes) == 0): ?>
<p>Nenhum cliente encontrado.</p>
<?php endif; ?>

<?php foreach($clientes as $c): ?>

<div class="linha">

<div class="info">
<div class="nome"><?= htmlspecialchars($c['nome']) ?></div>
<div class="sub"><?= htmlspecialchars($c['telefone']) ?> • <?= htmlspecialchars($c['email']) ?></div>
</div>

<div class="acoes">
<a href="#">Editar</a>
<a class="excluir" href="../public/excluir_cliente.php?id=<?= $c['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
</div>

</div>

<?php endforeach; ?>

</div>

</div>

</main>

</div>

<!-- MODAL CADASTRO -->

<div id="modal" class="modal">

<div class="modal-box">

<h3>Novo Cliente</h3>

<form action="../public/processa_cliente.php" method="POST">

<input type="text" name="nome" placeholder="Nome" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text" name="telefone" placeholder="Telefone" required>
<input type="password" name="senha" placeholder="Senha" required>

<button class="btn-add" type="submit">Salvar</button>

</form>

</div>

</div>

<script>

function abrirModal(){
document.getElementById("modal").style.display="flex";
}

</script>

</body>
</html>