<?php
// ==================== CONFIGURAÇÕES ====================
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 0);
ob_start(); // previne problemas de headers

include 'conexao.php';

// ==================== FILTROS ====================
$nome = $_GET['nome'] ?? '';
$regiao = $_GET['regiao'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$estado_clube = $_GET['estado_clube'] ?? '';
$sexo = $_GET['sexo'] ?? '';
$especialidade = $_GET['especialidade'] ?? '';
$idade_min = isset($_GET['idade_min']) ? (int)$_GET['idade_min'] : '';
$idade_max = isset($_GET['idade_max']) ? (int)$_GET['idade_max'] : '';

// ==================== QUERY ====================
$query = "SELECT * FROM inscritos WHERE 1=1";

if($nome != '') $query .= " AND nome LIKE '%$nome%'";
if($regiao != '') $query .= " AND regiao LIKE '%$regiao%'";
if($categoria != '') $query .= " AND categoria LIKE '%$categoria%'";
if($estado_clube != '') $query .= " AND estado_clube LIKE '%$estado_clube%'";
if($sexo != '') $query .= " AND sexo LIKE '%$sexo%'";
if($especialidade != '') $query .= " AND especialidade LIKE '%$especialidade%'";

if($idade_min !== '' && $idade_max !== ''){
    $query .= " AND idade BETWEEN $idade_min AND $idade_max";
} elseif($idade_min !== ''){
    $query .= " AND idade >= $idade_min";
} elseif($idade_max !== ''){
    $query .= " AND idade <= $idade_max";
}

$query .= " ORDER BY data_registro DESC";

// ==================== EXPORTAÇÃO ====================
if(isset($_GET['export'])) {
    $res_export = $conn->query($query);

    // ==================== EXPORTAR EXCEL ====================
    if($_GET['export']=='excel') {
        if(ob_get_length()) ob_end_clean();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="inscritos.csv"');
        echo "\xEF\xBB\xBF"; // BOM UTF-8
        $output = fopen('php://output','w');
        fputcsv($output, ['ID','Nome','Região','Distrito','Categoria','Especialidade','Idade','Sexo','Estado Civil','Estado no Clube']);
        while($row = $res_export->fetch_assoc()){
            fputcsv($output, [
                'INS-'.str_pad($row['id'],3,'0',STR_PAD_LEFT),
                $row['nome'],
                $row['regiao'],
                $row['distrito'],
                $row['categoria'],
                $row['especialidade'],
                $row['idade'],
                $row['sexo'],
                $row['estado_civil'],
                $row['estado_clube']
            ]);
        }
        fclose($output);
        exit;
    }

    // ==================== EXPORTAR PDF ====================
    if($_GET['export']=='pdf') {
        if(ob_get_length()) ob_end_clean();
        require_once(__DIR__.'/tcpdf_min/tcpdf.php');
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Lista de Inscritos');
        $pdf->AddPage();

        $html = '<h2>Lista de Inscritos</h2>';
        $html .= '<table border="1" cellpadding="4">';
        $html .= '<tr style="background-color:#1f2937;color:white;">
            <th>ID</th><th>Foto</th><th>Nome</th><th>Região</th><th>Distrito</th>
            <th>Categoria</th><th>Especialidade</th><th>Idade</th>
            <th>Sexo</th><th>Estado Civil</th><th>Estado no Clube</th>
        </tr>';

        while($row = $res_export->fetch_assoc()){
            $foto_path = realpath(__DIR__ . '/uploads/' . $row['foto']);
            $foto_html = '';
            if($foto_path && file_exists($foto_path)){
                $foto_html = '<img src="'.$foto_path.'" width="30" height="30">';
            }

            $html .= '<tr>
                <td>INS-'.str_pad($row['id'],3,'0',STR_PAD_LEFT).'</td>
                <td>'.$foto_html.'</td>
                <td>'.$row['nome'].'</td>
                <td>'.$row['regiao'].'</td>
                <td>'.$row['distrito'].'</td>
                <td>'.$row['categoria'].'</td>
                <td>'.$row['especialidade'].'</td>
                <td>'.$row['idade'].'</td>
                <td>'.$row['sexo'].'</td>
                <td>'.$row['estado_civil'].'</td>
                <td>'.$row['estado_clube'].'</td>
            </tr>';
        }

        $html .= '</table>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('inscritos.pdf','D');
        exit;
    }
}

// ==================== RESULTADO PARA HTML ====================
$result = $conn->query($query);
$total = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Lista de Inscritos</title>
<style>
/* --- CSS do layout --- */
body { font-family: 'Segoe UI', Arial, sans-serif; background:#f4f6f9; margin:0; }
header { background:#1f2937; color:white; padding:18px; text-align:center; font-size:22px; }
.container { width:95%; margin:30px auto; background:white; padding:25px; border-radius:12px; box-shadow:0 8px 25px rgba(0,0,0,0.06); }
.top-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; }
button { padding:9px 18px; border:none; border-radius:8px; font-weight:600; cursor:pointer; transition:all 0.2s ease; }
.btn-primary { background:#2563eb; color:white; } .btn-primary:hover { background:#1d4ed8; }
.btn-logout { background:#dc2626; color:white; } .btn-logout:hover { background:#b91c1c; }
.filtros { margin-bottom:20px; display:flex; gap:10px; flex-wrap:wrap; align-items:center; }
.filtros input, .filtros select { padding:8px; border-radius:6px; border:1px solid #d1d5db; }
.filtro-botoes { display:flex; gap:5px; }
.btn-filtrar { background:#2563eb; color:white; } .btn-filtrar:hover { background:#1d4ed8; }
.btn-limpar { background:#6b7280; color:white; } .btn-limpar:hover { background:#4b5563; }
table { width:100%; border-collapse:collapse; }
th { background:#1f2937; color:white; padding:12px; }
td { border-bottom:1px solid #e5e7eb; padding:10px; text-align:center; }
tr:hover { background:#f9fafb; }
img { width:60px; height:70px; object-fit:cover; border-radius:6px; }
.status { padding:5px 12px; border-radius:20px; color:white; font-size:13px; }
.ativo {background:#16a34a;} .passivo {background:#f59e0b;}
.btn-editar, .btn-excluir { background:#1e3a8a; color:white; margin:2px 0; } 
.btn-editar:hover, .btn-excluir:hover { background:#1e40af; }
.total { margin:15px 0; font-weight:600; color:#1f2937; }
.export-buttons { margin-bottom:15px; display:flex; gap:10px; }
</style>
</head>
<body>
<header>Lista de Inscritos</header>
<div class="container">

<div class="top-bar">
    <button class="btn-primary" onclick="window.location.href='principal.php'">+ Novo Cadastro</button>
    <button class="btn-logout" onclick="window.location.href='logout.php'">Sair</button>
</div>

<div class="export-buttons">
    <a href="?export=excel&<?= $_SERVER['QUERY_STRING'] ?>"><button class="btn-primary">Exportar Excel</button></a>
    <a href="?export=pdf&<?= $_SERVER['QUERY_STRING'] ?>"><button class="btn-primary">Exportar PDF</button></a>
</div>

<form method="GET" class="filtros">
    <input type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($nome) ?>">
    <input type="text" name="regiao" placeholder="Região" value="<?= htmlspecialchars($regiao) ?>">
    <select name="categoria">
        <option value="">Categoria</option>
        <option value="Junior" <?= $categoria=='Junior'?'selected':'' ?>>Junior</option>
        <option value="Senior" <?= $categoria=='Senior'?'selected':'' ?>>Senior</option>
    </select>
    <select name="sexo">
        <option value="">Sexo</option>
        <option value="Masculino" <?= $sexo=='Masculino'?'selected':'' ?>>Masculino</option>
        <option value="Feminino" <?= $sexo=='Feminino'?'selected':'' ?>>Feminino</option>
    </select>
    <select name="especialidade">
        <option value="">Especialidade</option>
        <option value="Aventureiro" <?= $especialidade=='Aventureiro'?'selected':'' ?>>Aventureiro</option>
        <option value="Desbravador" <?= $especialidade=='Desbravador'?'selected':'' ?>>Desbravador</option>
        <option value="Embaixador" <?= $especialidade=='Embaixador'?'selected':'' ?>>Embaixador</option>
        <option value="Jovens Adulto" <?= $especialidade=='Jovens Adulto'?'selected':'' ?>>Jovens Adulto</option>
    </select>
    <input type="number" name="idade_min" placeholder="Idade Min" value="<?= htmlspecialchars($idade_min) ?>" style="width:80px;">
    <input type="number" name="idade_max" placeholder="Idade Max" value="<?= htmlspecialchars($idade_max) ?>" style="width:80px;">
    <select name="estado_clube">
        <option value="">Estado no Clube</option>
        <option value="Activo" <?= $estado_clube=='Activo'?'selected':'' ?>>Activo</option>
        <option value="Passivo" <?= $estado_clube=='Passivo'?'selected':'' ?>>Passivo</option>
    </select>
    <div class="filtro-botoes">
        <button type="submit" class="btn-filtrar">Filtrar</button>
        <button type="button" class="btn-limpar" onclick="window.location='<?= basename($_SERVER['PHP_SELF']) ?>';">Limpar</button>
    </div>
</form>

<div class="total">Total de Inscritos: <?= $total ?></div>

<table>
<tr>
    <th>ID</th><th>Foto</th><th>Nome</th><th>Região</th><th>Distrito</th>
    <th>Categoria</th><th>Especialidade</th><th>Idade</th><th>Sexo</th>
    <th>Estado Civil</th><th>Estado no Clube</th><th>Ações</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td>INS-<?= str_pad($row['id'], 3, "0", STR_PAD_LEFT); ?></td>
    <td><img src="uploads/<?= $row['foto'] ?>"></td>
    <td><?= htmlspecialchars($row['nome']) ?></td>
    <td><?= htmlspecialchars($row['regiao']) ?></td>
    <td><?= htmlspecialchars($row['distrito']) ?></td>
    <td><?= htmlspecialchars($row['categoria']) ?></td>
    <td><?= htmlspecialchars($row['especialidade']) ?></td>
    <td><?= $row['idade'] ?></td>
    <td><?= htmlspecialchars($row['sexo']) ?></td>
    <td><?= htmlspecialchars($row['estado_civil']) ?></td>
    <td><?= ($row['estado_clube']=='Activo' ? "<span class='status ativo'>Activo</span>" : "<span class='status passivo'>Passivo</span>") ?></td>
    <td>
        <a href="editar.php?id=<?= $row['id'] ?>"><button class="btn-editar">Editar</button></a>
        <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este inscrito?')">
            <button class="btn-excluir">Excluir</button>
        </a>
    </td>
</tr>
<?php } ?>
</table>

</div>
</body>
</html>