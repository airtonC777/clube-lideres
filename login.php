<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* ====== ÁREA DO TOPO ====== */
        .topo {
            position: relative;
            width: 100%;
            height: 180px; /* ajusta a altura conforme tua imagem */
            overflow: hidden;
        }

        /* Imagem horizontal de fundo */
        .topo img.fundo {
            width: 100%;
            height: 100%;
            object-fit: cover; /* garante que preenche toda a área */
            display: block;
        }

        /* Logo AY centralizado por cima */
        .topo img.logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* centraliza perfeitamente */
            max-width: 220px;
            height: auto;
        }

        /* ====== FORMULÁRIO ====== */
        form {
            background-color: #fff;
            display: inline-block;
            margin-top: 40px;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input {
            width: 200px;
            padding: 8px;
            margin: 5px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #0077cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>

    <div class="topo">
        <img src="horizontal.jpg" alt="Imagem horizontal" class="fundo">
        <img src="AY-logo.png" alt="Logo AY" class="logo">
    </div>

    <form method="POST" action="autenticar.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>

</body>
</html>
