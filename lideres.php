<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Formulário de Inscrição</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #1e3c72, #2a5298);
    display: flex;
    justify-content: center;
    padding: 40px;
}

.container {
    background: #fff;
    width: 700px;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* TOPO COM FOTO */
.top-section {
    display: flex;
    margin-bottom: 20px;
}

.photo-box {
    width: 160px;
    height: 180px;
    border: 2px dashed #999;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    margin-right: 20px;
    background-color: #f4f4f4;
}

.photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-upload {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.form-group label {
    width: 180px;
    font-weight: bold;
}

.form-group input,
.form-group select {
    flex: 1;
    padding: 7px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* BOTÕES */
.button-group {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.button-group button {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    color: white;
    cursor: pointer;
}

.btn-salvar {
    background: #28a745;
}

.btn-ver {
    background: #17a2b8;
}

.btn-voltar {
    background: #6c757d;
}

.btn-salvar:hover { background:#218838; }
.btn-ver:hover { background:#138496; }
.btn-voltar:hover { background:#5a6268; }

</style>

<script>
function previewFoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</head>
<body>

<div class="container">
<h2>Cadastramento</h2>

<form method="POST" action="processar.php" enctype="multipart/form-data">

    <div class="top-section">
        <div class="photo-box">
            <img id="preview" src="" alt="Foto">
        </div>

        <div class="photo-upload">
            <label><strong>Carregar Foto:</strong></label>
            <input type="file" name="foto" accept="image/*" onchange="previewFoto(event)" required>
        </div>
    </div>

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" required>
    </div>

    <div class="form-group">
        <label>Igreja:</label>
        <input type="text" name="igreja" required>
    </div>

    <div class="form-group">
        <label>Região:</label>
        <select name="regiao" required>
            <option value="">Selecione</option>
            <option>Belas Norte</option>
            <option>Belas Sul</option>
            <option>Cabinda</option>
            <option>Centro de Viana</option>
            <option>Kilamba Kiaxe A</option>
            <option>Kilamba Kiaxe B</option>
            <option>Samba e Mainga</option>
            <option>Sul de Viana</option>
            <option>Talatona Norte</option>
            <option>Talatona Sul</option>
        </select>
    </div>

    <div class="form-group">
        <label>Distrito:</label>
        <input type="text" name="distrito" required>
    </div>

    <div class="form-group">
        <label>Categoria:</label>
        <select name="categoria" required>
            <option>Junior</option>
            <option>Senior</option>
        </select>
    </div>

    <div class="form-group">
        <label>Especialidade:</label>
        <select name="especialidade" required>
            <option>Aventureiro</option>
            <option>Desbravador</option>
            <option>Embaixador</option>
            <option>Jovens Adulto</option>
        </select>
    </div>

    <div class="form-group">
        <label>Idade:</label>
        <input type="number" name="idade" required>
    </div>

    <div class="form-group">
        <label>Sexo:</label>
        <select name="sexo" required>
            <option>Masculino</option>
            <option>Feminino</option>
        </select>
    </div>

    <div class="form-group">
        <label>Estado Civil:</label>
        <select name="estado_civil" required>
            <option>Solteiro</option>
            <option>Casado</option>
            <option>Divorciado</option>
        </select>
    </div>

    <div class="form-group">
        <label>Estado no Clube:</label>
        <select name="estado_clube" required>
            <option>Activo</option>
            <option>Passivo</option>
        </select>
    </div>

    <div class="button-group">
        <button type="submit" class="btn-salvar">💾 Salvar</button>

        <button type="button" class="btn-ver"
            onclick="window.location.href='listar_inscritos.php'">
            📋 Ver Inscritos
        </button>

        <button type="button" class="btn-voltar"
            onclick="history.back()">
            ⬅ Voltar
        </button>
    </div>

</form>
</div>

</body>
</html>