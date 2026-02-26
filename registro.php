<?php
include("conexao.php");

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se o e-mail já existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro ao preparar SELECT: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $mensagem = "❌ Este e-mail já está cadastrado!";
    } else {
        // Criptografa a senha
        $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

        // Define o papel padrão do usuário
        $role = 'leitor'; // todos começam com acesso de leitura

        // Insere o novo usuário com a role 'leitor'
        $sql = "INSERT INTO usuarios (nome, email, senha, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar INSERT: " . $conn->error);
        }

        $stmt->bind_param("ssss", $nome, $email, $senhaSegura, $role);

        if ($stmt->execute()) {
            $mensagem = "✅ Usuário cadastrado com sucesso! Agora você pode fazer login.";
        } else {
            $mensagem = "❌ Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow-x: hidden;
        }

        .barra-vertical {
            position: fixed;
            right: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background: url('barra-v.jpg') no-repeat center top;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            z-index: 2;
            box-shadow: -3px 0 6px rgba(0, 0, 0, 0.2);
        }

        .barra-vertical img {
            width: 180px;
            height: auto;
            margin-bottom: 15px;
        }

        .logo-ja {
            margin-top: 40px;
            width: 600px;
            height: auto;
            max-width: 90%;
            z-index: 1;
        }

        .barra-horizontal {
            width: 100%;
            height: 130px;
            background: url('barra-h.jpg') no-repeat center center;
            background-size: cover;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 0;
        }

        .barra-horizontal h1 {
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
            margin: 0;
        }

        .container {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #003366;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .mensagem {
            margin-bottom: 15px;
            color: #d9534f;
        }

        .mensagem.sucesso {
            color: #28a745;
        }
    </style>
</head>
<body>

    <div class="barra-vertical">
        <img src="igreja-logoP.jpg" alt="Logo Igreja Adventista">
    </div>

    <img src="JA-logo.jpg" alt="Logo JA" class="logo-ja">

    <div class="barra-horizontal">
        <h1>Ministérios da Juventude</h1>
    </div>

    <div class="container">
        <?php if ($mensagem != ""): ?>
            <div class="mensagem <?php echo (str_contains($mensagem, '✅') ? 'sucesso' : ''); ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <h2>Registrar Novo Usuário</h2>

            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>

            <p style="text-align:center;margin-top:15px;">
                Já tem conta? <a href="login.php">Fazer login</a>
            </p>
        </form>
    </div>

</body>
</html>
