<?php
include 'conexao.php';

if(isset($_GET['id'])) {

    $id = intval($_GET['id']);

    // Primeiro pega a foto para apagar o arquivo
    $result = $conn->query("SELECT foto FROM inscritos WHERE id = $id");
    $row = $result->fetch_assoc();

    if($row){
        unlink("uploads/" . $row['foto']);
    }

    // Deleta do banco
    $conn->query("DELETE FROM inscritos WHERE id = $id");

}

header("Location: listar_inscritos.php");
exit();
?>