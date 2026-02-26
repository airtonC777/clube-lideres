<?php
include 'conexao.php';

// Upload da foto
$fotoNome = time() . "_" . $_FILES['foto']['name'];
$destino = "uploads/" . $fotoNome;
move_uploaded_file($_FILES['foto']['tmp_name'], $destino);

// Inserir no banco
$stmt = $conn->prepare("INSERT INTO inscritos 
(foto, nome, igreja, regiao, distrito, categoria, especialidade, idade, sexo, estado_civil, estado_clube) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssss",
    $fotoNome,
    $_POST['nome'],
    $_POST['igreja'],
    $_POST['regiao'],
    $_POST['distrito'],
    $_POST['categoria'],
    $_POST['especialidade'],
    $_POST['idade'],
    $_POST['sexo'],
    $_POST['estado_civil'],
    $_POST['estado_clube']
);

$stmt->execute();

header("Location: listar_inscritos.php");
exit();
?>