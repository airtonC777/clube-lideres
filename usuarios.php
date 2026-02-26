<?php
session_start();
include 'conexao.php';

// 🔒 Verifica login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// 🔒 Somente admin pode acessar
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Acesso negado! Somente administradores podem acessar esta página.'); window.location='painel.php';</script>";
    exit();
}

// 🟢 Atualiza o papel (role) do usuário, se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['novo_role'])) {
    $id = intval($_POST['user_id']);
    $novoRole = $_POST['novo_role'];

    $stmt = $conn->prepare("UPDATE usuarios SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $novoRole, $id);
    if ($stmt->execute()) {
        $mensagem = "✅ Permissão atualizada com sucesso!";
    } else {
        $mensagem = "❌ Erro ao atualizar: " . $conn->error;
    }
}

// 🔹 Lista todos os usuários
$result = $conn->query("SELECT id, nome, email, role, data_registro FROM usuarios ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: #004aad;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
        }
        .container {
            width: 90%;
            margin: 40px auto;
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #004aad;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .mensagem {
            text-align: center;
            padding: 10px;
            font-weight: bold;
        }
        select {
            padding: 5px;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .voltar {
            display: inline-block;
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .voltar:hover {
            background: #555;
        }
    </style>
</head>
<body>
<header>👥 Gerenciar Usuários</header>

<div class="container">
    <a href="painel.php" class="voltar">⬅️ Voltar ao Painel</a>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?= $mensagem ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Função</th>
            <th>Data de Registro</th>
            <th>Ação</th>
        </tr>

        <?php while ($user = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['nome']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <select name="novo_role">
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="editor" <?= $user['role'] == 'editor' ? 'selected' : '' ?>>Editor</option>
                        <option value="leitor" <?= $user['role'] == 'leitor' ? 'selected' : '' ?>>Leitor</option>
                    </select>
                    <button type="submit">Salvar</button>
                </form>
            </td>
            <td><?= $user['data_registro'] ?></td>
            <td>
                <?php if ($user['email'] != $_SESSION['email']): ?>
                    <a href="excluir_usuario.php?id=<?= $user['id'] ?>" onclick="return confirm('Excluir este usuário?')">
                        🗑️ Excluir
                    </a>
                <?php else: ?>
                    (você)
                <?php endif; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
