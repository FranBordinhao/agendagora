<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro de Cliente | AgendAgora</title>

<style>

*{
    box-sizing:border-box;
    font-family:'Segoe UI', Tahoma, sans-serif;
}

body{
    margin:0;
    height:100vh;
    background:#f4f8fc;
    display:flex;
    align-items:center;
    justify-content:center;
}

.container{
    background:#ffffff;
    width:400px;
    padding:35px;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.logo{
    text-align:center;
    font-size:26px;
    font-weight:bold;
    color:#4da3ff;
}

.logo span{
    color:#1f2937;
}

h2{
    text-align:center;
    margin:20px 0;
    color:#1f2937;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #d1d5db;
    font-size:14px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#4da3ff;
    color:white;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#3b8be0;
}

.link{
    text-align:center;
    margin-top:20px;
    font-size:14px;
}

.link a{
    color:#4da3ff;
    text-decoration:none;
}

.link a:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<div class="container">

<div class="logo">
Agend<span>Agora</span>
</div>

<h2>Cadastro de Cliente</h2>

<form action="processa_cadastro_cliente.php" method="POST">

<input type="text" name="nome" placeholder="Nome completo" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="telefone" placeholder="Telefone" required>

<input type="password" name="senha" placeholder="Senha" required>

<button type="submit">
Cadastrar
</button>

</form>

<div class="link">
Já possui conta? <a href="login.php">Entrar</a>
</div>

</div>

</body>
</html>