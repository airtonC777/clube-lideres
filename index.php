<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Ministérios da Juventude - Clube de Lideres</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom, #f0f4ff, #e0f0ff);
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    /* Logo Igreja centralizada */
    .logo-igreja {
        display: block;
        margin: 50px auto 0 auto;
        width: 420px;
        height: auto;
        position: relative;
        z-index: 3;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        border-radius: 12px;
        animation: fadeInDown 2s ease forwards;
    }

    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-50px);}
        100% { opacity: 1; transform: translateY(0);}
    }

    /* Logo JA rolando */
    .logo-ja {
        position: absolute;
        top: 55%;
        left: 100%;
        transform: translateY(-50%);
        width: 750px;
        animation: moverJA 20s linear infinite;
        z-index: 2;
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }

    @keyframes moverJA {
        0% { left: 100%; }
        100% { left: -780px; }
    }

    /* Barra horizontal com brilho neon */
    .barra-horizontal {
        position: absolute;
        bottom: 180px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        height: 18px;
        background: linear-gradient(90deg, #0077ff, #00e5ff, #0077ff);
        border-radius: 10px;
        animation: neon 3s linear infinite;
        box-shadow: 0 0 25px rgba(0,120,255,0.9), 0 0 50px rgba(0,200,255,0.6);
        z-index: 1;
    }

    @keyframes neon {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Texto central - sempre em uma linha */
    .texto-barra {
        position: absolute;
        bottom: 220px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 65px;
        font-weight: bold;
        color: #222;
        z-index: 3;
        text-shadow: 2px 2px 12px rgba(0,0,0,0.4), 0 0 20px rgba(0,200,255,0.4);
        animation: glowText 2.5s ease-in-out infinite alternate;
        white-space: nowrap; /* impede quebra de linha */
    }

    @keyframes glowText {
        0% { text-shadow: 2px 2px 12px rgba(0,0,0,0.4), 0 0 20px rgba(0,200,255,0.3); }
        100% { text-shadow: 2px 2px 16px rgba(0,0,0,0.5), 0 0 35px rgba(0,200,255,0.6); }
    }

    /* Container de botões */
    .botoes {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-wrap: wrap; /* permite quebra de linha */
        justify-content: center;
        gap: 15px;
        z-index: 3;
    }

    /* Botões padrão */
    button {
        padding: 24px 50px;
        font-size: 24px;
        color: white;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 15px rgba(0,0,0,0.35);
        font-weight: bold;
        text-align: center;
        min-width: 150px;
        flex: 1 1 auto; /* permite que cresça ou encolha */
        max-width: 300px;
    }

    .login {
        background: linear-gradient(45deg, #0077ff, #00cfff);
    }

    .login:hover {
        background: linear-gradient(45deg, #005fa3, #00aacc);
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }

    .registrar {
        background: linear-gradient(45deg, #28a745, #5cd65c);
    }

    .registrar:hover {
        background: linear-gradient(45deg, #1e7e34, #40c040);
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }

    /* === Responsividade === */
    @media (max-width: 1400px) {
        .logo-igreja { width: 350px; }
        .logo-ja { width: 600px; }
        .texto-barra { font-size: 55px; bottom: 200px; }
        .barra-horizontal { height: 14px; bottom: 160px; }
        button { font-size: 22px; padding: 20px 42px; min-width: 140px; }
    }

    @media (max-width: 1024px) {
        .logo-igreja { width: 280px; }
        .logo-ja { width: 450px; }
        .texto-barra { font-size: 42px; bottom: 160px; }
        .barra-horizontal { height: 12px; bottom: 140px; }
        button { font-size: 20px; padding: 18px 36px; min-width: 130px; }
    }

    @media (max-width: 768px) {
        .logo-igreja { width: 220px; }
        .logo-ja { width: 350px; }
        .texto-barra { font-size: 32px; bottom: 120px; }
        .barra-horizontal { height: 10px; bottom: 100px; }
        button { font-size: 18px; padding: 14px 28px; min-width: 120px; }
    }

    @media (max-width: 480px) {
        .logo-igreja { width: 180px; }
        .logo-ja { width: 250px; }
        .texto-barra { font-size: 24px; bottom: 80px; }
        .barra-horizontal { height: 8px; bottom: 70px; }
        button { 
            font-size: 16px; 
            padding: 10px 16px; 
            flex: 1 1 45%; /* ocupa metade da tela */
            min-width: 0;
            max-width: none;
        }
    }

</style>
</head>
<body>
<div class="container">
    <!-- Logo Igreja -->
    <img src="igreja-logoP.jpg" alt="Logo Igreja" class="logo-igreja">

    <!-- Logo JA -->
    <img src="JA-logo.jpg" alt="Logo JA" class="logo-ja">

    <!-- Barra horizontal com brilho neon -->
    <div class="barra-horizontal"></div>

    <!-- Texto central -->
    <div class="texto-barra">Ministérios da Juventude</div>

    <!-- Botões -->
    <div class="botoes">
        <button class="login" onclick="window.location.href='login.php'">Entrar no Sistema</button>
        <button class="registrar" onclick="window.location.href='registro.php'">Registrar Novo Usuário</button>
    </div>
</div>
</body>
</html>
