<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro | AgendAgora</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: #f4f8fc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #ffffff;
            width: 380px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            text-align: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #4da3ff;
        }

        .logo span {
            color: #1f2937;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 30px;
        }

        h2 {
            margin-bottom: 25px;
            color: #1f2937;
        }

        .opcao {
            display: block;
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #1f2937;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .opcao:hover {
            border-color: #4da3ff;
            background: #f0f7ff;
        }

        .link {
            margin-top: 25px;
            font-size: 14px;
        }

        .link a {
            color: #4da3ff;
            text-decoration: none;
            font-weight: 500;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="logo">
        Agend<span>Agora</span>
    </div>

    <div class="subtitle">
        Agendamento Inteligente
    </div>

    <h2>Criar cadastro</h2>

    <a href="cadastro_cliente.php" class="opcao">
        Sou Cliente
    </a>

    <a href="cadastro_profissional.php" class="opcao">
        Sou Profissional
    </a>

    <div class="link">
        Já tem conta?
        <a href="login.php">Entrar</a>
    </div>

</div>

</body>
</html>