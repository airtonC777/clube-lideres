<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logout - Ministério da Juventude</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .caixa {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #004aad;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 30px;
        }
        a {
            background: #004aad;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.3s;
        }
        a:hover {
            background: #00337a;
        }
    </style>
</head>
<body>
    <div class="caixa">
        <h2>Ministério da Juventude</h2>
        <p>Sessão encerrada com sucesso.</p>
        <a href="login.php">Voltar para o Login</a>
    </div>
</body>
</html>
