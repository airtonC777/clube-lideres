<?php
include 'conexao.php';

$id = intval($_POST['id']);
$nome = $_POST['nome'];
$igreja = $_POST['igreja'];
$regiao = $_POST['regiao'];
$distrito = $_POST['distrito'];
$categoria = $_POST['categoria'];
$especialidade = $_POST['especialidade'];
$idade = intval($_POST['idade']);
$sexo = $_POST['sexo'];
$estado_civil = $_POST['estado_civil'];
$estado_clube = $_POST['estado_clube'];

// Tratar upload da foto
if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
    $fotoNome = time() . "_" . $_FILES['foto']['name'];
    $destino = "uploads/" . $fotoNome;
    move_uploaded_file($_FILES['foto']['tmp_name'], $destino);

    $stmt = $conn->prepare("UPDATE inscritos SET foto=?, nome=?, igreja=?, regiao=?, distrito=?, categoria=?, especialidade=?, idade=?, sexo=?, estado_civil=?, estado_clube=? WHERE id=?");
    $stmt->bind_param("ssssssissssi", $fotoNome, $nome, $igreja, $regiao, $distrito, $categoria, $especialidade, $idade, $sexo, $estado_civil, $estado_clube, $id);
} else {
    $stmt = $conn->prepare("UPDATE inscritos SET nome=?, igreja=?, regiao=?, distrito=?, categoria=?, especialidade=?, idade=?, sexo=?, estado_civil=?, estado_clube=? WHERE id=?");
    $stmt->bind_param("ssssssisssi", $nome, $igreja, $regiao, $distrito, $categoria, $especialidade, $idade, $sexo, $estado_civil, $estado_clube, $id);
}

$stmt->execute();
header("Location: listar_inscritos.php");
exit();