<?php
include("conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    // Busca o usuário pelo e-mail
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro no SQL: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $usuario["senha"])) {
            // Login bem-sucedido — cria as variáveis de sessão
            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nome"] = $usuario["nome"];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["role"] = $usuario["role"]; // ✅ salva o nível de acesso

            // Redireciona sempre para o painel
            header("Location: painel.php");
            exit();

        } else {
            echo "<script>alert('❌ Senha incorreta!'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('❌ Usuário não encontrado!'); window.history.back();</script>";
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
