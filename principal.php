<?php 
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
session_start(); 

// se o usuário não estiver logado, redireciona 
if (!isset($_SESSION['email'])) { 
    header("Location: login.php"); 
    exit(); 
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Ministérios da Juventude</title>

<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
}

header {
    background: #004aad;
    color: white;
    text-align: center;
    padding: 25px 0;
    font-size: 28px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

nav {
    background: white;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

nav a {
    color: #004aad;
    text-decoration: none;
    padding: 15px 30px;
    font-weight: bold;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

nav a:hover {
    background: #004aad;
    color: white;
}

.conteudo {
    text-align: center;
    margin-top: 40px;
    font-size: 20px;
}

.logout {
    position: absolute;
    top: 20px;
    right: 30px;
}

.logout a {
    background: #dc3545;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
}

.logout a:hover {
    background: #b02a37;
}

/* BOTÃO VOLTAR */
.voltar {
    text-align: center;
    margin-top: 20px;
}

.voltar a {
    background: #6c757d;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: bold;
    transition: 0.3s;
}

.voltar a:hover {
    background: #545b62;
}
</style>
</head>

<body>

<header>
    Ministérios da Juventude
</header>

<div class="logout">
    <a href="logout.php">Sair</a>
</div>

<nav>
    <a href="aventureiros.php">Aventureiros</a>
    <a href="desbravadores.php">Desbravadores</a>
    <a href="embaixadores.php">Embaixadores</a>
    <a href="jovens_adultos.php">Jovens Adultos</a>
</nav>

<!-- BOTÃO VOLTAR PARA PAINEL -->
<div class="voltar">
    <a href="painel.php">⬅ Voltar ao Painel</a>
</div>

<div class="conteudo">
    <p>Bem-vindo, <strong><?php echo $_SESSION['email']; ?></strong>!</p>
    <p>Escolha uma das opções acima para continuar.</p>
</div>

</body>
</html>