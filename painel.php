<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Pega os dados da sessão
$nome = $_SESSION['nome'] ?? 'Usuário';
$email = $_SESSION['email'];
$role = $_SESSION['role'] ?? 'leitor';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background: #004aad;
            color: white;
            padding: 20px;
            font-size: 26px;
            font-weight: bold;
        }
        .painel {
            background: white;
            width: 450px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #004aad;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .botoes a {
            display: block;
            background: #004aad;
            color: white;
            padding: 12px;
            margin: 10px auto;
            width: 80%;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }
        .botoes a:hover {
            background: #003680;
        }
        .sair {
            background: #dc3545 !important;
        }
        .sair:hover {
            background: #a71d2a !important;
        }
    </style>
</head>
<body>

<header>Painel do Sistema</header>

<div class="painel">
    <h2>Bem-vindo, <?= htmlspecialchars($nome) ?>!</h2>
    <p>Email: <strong><?= htmlspecialchars($email) ?></strong></p>
    <p>Permissão: <strong><?= strtoupper($role) ?></strong></p>

    <div class="botoes">
        <?php if ($role === 'admin'): ?>
            <a href="principal.php">📋 Cadastrar Lideres</a>
            <a href="listar_inscritos.php">📄 Ver Listagem</a>
            <a href="usuarios.php">👥 Gerenciar Usuários</a>
        <?php elseif ($role === 'editor'): ?>
            <a href="listar_inscritos.php">📄 Listar e Editar inscritos</a>
        <?php else: ?>
            <a href="listar_inscritos.php.php">📄 Ver Listagem</a>
        <?php endif; ?>
        <a href="logout.php" class="sair">🚪 Sair</a>
    </div>
</div>

</body>
</html>
