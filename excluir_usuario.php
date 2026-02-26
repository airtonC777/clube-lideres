<?php
session_start();
include 'conexao.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: painel.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Evita excluir a si mesmo
    if ($_SESSION['id'] == $id) {
        echo "<script>alert('Você não pode excluir a si mesmo!'); window.location='usuarios.php';</script>";
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: usuarios.php");
    exit();
}
