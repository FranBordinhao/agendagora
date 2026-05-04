<?php 
session_start();
require_once "../config/conexao.php";

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'profissional') {
    header("Location: ../public/login.php");
    exit;
}

$profissional_id = $_SESSION['usuario_id'];
$nomeUsuario = $_SESSION['nome'] ?? 'Profissional';

/* BUSCAR SERVIÇOS */

$sql = "SELECT * FROM servicos WHERE profissional_id = ? ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$profissional_id]);
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">
<title>AgendAgora - Serviços</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../assets/css/style.css">

<style>

.main-servicos{
padding:30px;
}

.servicos-container{
display:flex;
gap:30px;
}

.form-card{
background:white;
padding:25px;
border-radius:10px;
width:380px;
box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.lista-servicos{
flex:1;
}

.card-servico{
background:white;
padding:18px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.05);
margin-bottom:15px;
display:flex;
justify-content:space-between;
align-items:center;
}

.badge{
background:#eef2ff;
color:#4c7cf3;
padding:4px 8px;
border-radius:6px;
font-size:12px;
margin-left:8px;
}

.descricao{
font-size:14px;
color:#666;
margin-top:5px;
}

.preco{
font-weight:bold;
margin-top:6px;
}

.acoes{
display:flex;
gap:8px;
}

.btn{
padding:6px 12px;
border-radius:6px;
font-size:13px;
text-decoration:none;
color:white;
}

.editar{
background:#ffb020;
}

.excluir{
background:#ff4d4d;
}

input, textarea{
width:100%;
padding:10px;
margin-top:6px;
margin-bottom:15px;
border:1px solid #ddd;
border-radius:6px;
}

button{
width:100%;
background:#4c7cf3;
border:none;
color:white;
padding:12px;
border-radius:6px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="app">

<!-- SIDEBAR -->

<?php include "includes/sidebar.php"; ?>

<!-- CONTEÚDO -->

<main class="main">

<header class="header">

<div>
<h1>Serviços</h1>
<p>Gerencie os serviços oferecidos</p>
</div>

</header>

<div class="main-servicos">

<div class="servicos-container">

<!-- FORM -->

<div class="form-card">

<h3>Cadastrar Serviço</h3>

<form action="../public/processa_servicos.php" method="POST">

<input type="hidden" name="profissional_id" value="<?= $profissional_id ?>">

<label>Nome do serviço</label>
<input type="text" name="nome_servico" required>

<label>Preço (R$)</label>
<input type="number" step="0.01" name="preco" required>

<label>Duração (minutos)</label>
<input type="number" name="duracao" required>

<label>Descrição</label>
<textarea name="descricao"></textarea>

<button type="submit">
Cadastrar Serviço
</button>

</form>

</div>

<!-- LISTA -->

<div class="lista-servicos">

<h3>Serviços cadastrados</h3>

<?php if(count($servicos) == 0): ?>

<p>Nenhum serviço cadastrado.</p>

<?php else: ?>

<?php foreach($servicos as $servico): ?>

<div class="card-servico">

<div>

<h4>

<?= htmlspecialchars($servico['nome_servico'] ?? 'Serviço') ?>

<span class="badge">
<?= $servico['duracao'] ?? 0 ?> min
</span>

</h4>

<div class="descricao">

<?= substr(htmlspecialchars($servico['descricao'] ?? ''),0,80) ?>

</div>

<div class="preco">

R$ <?= number_format($servico['preco'] ?? 0,2,',','.') ?>

</div>

</div>

<div class="acoes">

<a class="btn editar"
href="editar_servico.php?id=<?= $servico['id'] ?>">
Editar
</a>

<a class="btn excluir"
href="../public/excluir_servico.php?id=<?= $servico['id'] ?>"
onclick="return confirm('Excluir serviço?')">
Excluir
</a>

</div>

</div>

<?php endforeach; ?>

<?php endif; ?>

</div>

</div>

</div>

</main>

</div>

</body>
</html>