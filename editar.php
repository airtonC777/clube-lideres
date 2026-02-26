<?php
include 'conexao.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM inscritos WHERE id = $id");

if($result->num_rows == 0){
    die("Inscrito não encontrado.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Editar Inscrito</title>
<style>
body {font-family: Arial; background:#f5f6fa; margin:0; padding:40px; display:flex; justify-content:center;}
.container {background:white; padding:30px; border-radius:10px; width:700px; box-shadow:0 5px 20px rgba(0,0,0,0.3);}
h2 {text-align:center; margin-bottom:20px;}
.form-group {display:flex; margin-bottom:15px; align-items:center;}
.form-group label {width:180px; font-weight:bold;}
.form-group input, .form-group select {flex:1; padding:7px; border-radius:5px; border:1px solid #ccc;}
button {padding:10px 20px; background:#1e3c72; color:white; border:none; border-radius:5px; cursor:pointer; margin-right:10px;}
button:hover {background:#16325c;}
.photo-box {width:160px; height:180px; border:2px dashed #999; border-radius:8px; display:flex; justify-content:center; align-items:center; overflow:hidden; margin-bottom:10px; background-color:#f4f4f4;}
.photo-box img {width:100%; height:100%; object-fit:cover;}
</style>

<script>
function previewFoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</head>
<body>

<div class="container">
<h2>Editar Inscrito</h2>

<form method="POST" action="atualizar.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <div class="form-group">
        <label>Foto Atual:</label>
        <div class="photo-box">
            <img id="preview" src="uploads/<?= $row['foto'] ?>" alt="Foto">
        </div>
    </div>

    <div class="form-group">
        <label>Alterar Foto:</label>
        <input type="file" name="foto" accept="image/*" onchange="previewFoto(event)">
    </div>

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($row['nome']) ?>" required>
    </div>

    <div class="form-group">
        <label>Igreja:</label>
        <input type="text" name="igreja" value="<?= htmlspecialchars($row['igreja']) ?>" required>
    </div>

    <div class="form-group">
        <label>Região:</label>
        <select name="regiao" required>
            <?php 
            $regioes = ["Belas Norte","Belas Sul","Cabinda","Centro de Viana","Kilamba Kiaxe A","Kilamba Kiaxe B","Mainga","Samba","Sul de Viana","Talatona Norte","Talatona Sul"];
            foreach($regioes as $r){
                $sel = ($row['regiao']==$r) ? "selected" : "";
                echo "<option value='$r' $sel>$r</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Distrito:</label>
        <input type="text" name="distrito" value="<?= htmlspecialchars($row['distrito']) ?>" required>
    </div>

    <div class="form-group">
        <label>Categoria:</label>
        <select name="categoria" required>
            <option value="Junior" <?= $row['categoria']=='Junior'?'selected':'' ?>>Junior</option>
            <option value="Senior" <?= $row['categoria']=='Senior'?'selected':'' ?>>Senior</option>
        </select>
    </div>

    <div class="form-group">
        <label>Especialidade:</label>
        <select name="especialidade" required>
            <?php 
            $especialidades = ["Aventureiro","Desbravador","Embaixador","Jovens Adulto"];
            foreach($especialidades as $e){
                $sel = ($row['especialidade']==$e) ? "selected" : "";
                echo "<option value='$e' $sel>$e</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Idade:</label>
        <input type="number" name="idade" value="<?= $row['idade'] ?>" required>
    </div>

    <div class="form-group">
        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="Masculino" <?= $row['sexo']=='Masculino'?'selected':'' ?>>Masculino</option>
            <option value="Feminino" <?= $row['sexo']=='Feminino'?'selected':'' ?>>Feminino</option>
        </select>
    </div>

    <div class="form-group">
        <label>Estado Civil:</label>
        <select name="estado_civil" required>
            <option value="Solteiro" <?= $row['estado_civil']=='Solteiro'?'selected':'' ?>>Solteiro</option>
            <option value="Casado" <?= $row['estado_civil']=='Casado'?'selected':'' ?>>Casado</option>
            <option value="Divorciado" <?= $row['estado_civil']=='Divorciado'?'selected':'' ?>>Divorciado</option>
        </select>
    </div>

    <div class="form-group">
        <label>Estado no Clube:</label>
        <select name="estado_clube" required>
            <option value="Activo" <?= $row['estado_clube']=='Activo'?'selected':'' ?>>Activo</option>
            <option value="Passivo" <?= $row['estado_clube']=='Passivo'?'selected':'' ?>>Passivo</option>
        </select>
    </div>

    <button type="submit">Atualizar</button>
    <button type="button" onclick="window.location.href='listar_inscritos.php'">Voltar</button>
</form>
</div>

</body>
</html>