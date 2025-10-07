<?php
include "conexao.php";
if(isset($_POST['atualiza'])){
    $idatualiza = intval($_POST['id']);
    $Nome       = mysqli_real_escape_string($conexao, $_POST['Nome']);
    $Email      = mysqli_real_escape_string($conexao, $_POST['Email']);
    $Mensagem        = mysqli_real_escape_string($conexao, $_POST['Mensagem']);

    $sql = "UPDATE aluno SET Nome='$Nome', Email='$Email', Mensagem='$Mensagem' WHERE id=$idatualiza";
    mysqli_query($conexao, $sql) or die("Erro ao atualizar: " . mysqli_error($conexao));
    header("Location: moderar.php");
    exit;
}if(isset($_GET['acao']) && $_GET['acao'] == 'excluir'){
    $ID = intval($_GET['id']);
    mysqli_query($conexao, "DELETE FROM aluno WHERE ID=$ID") or die("Erro ao deletar: " . mysqli_error($conexao));
    header("Location: moderar.php");
    exit;}

    $editar_id = isset($_GET['acao']) && $_GET['acao'] == 'editar' ? intval($_GET['id']) : 0;
    $recado_editar = null;
    if($editar_id){
        $res = mysqli_query($conexao, "SELECT * FROM aluno WHERE id=$editar_id");
        $recado_editar = mysqli_fetch_assoc($res);
    }
    ?>
    <!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title> Moderar pedidos </title>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<div ID="main">
<div ID="geral">
<div ID="header">
    <h1>Mural de pedidos</h1>
</div>

<?php if($recado_editar): ?>
    <div id="formulario_mural">
    <form method="post">
        <label>Nome:</label>
        <input type="text" Name="Nome" value="<?php echo htmlspecialchars($recado_editar['Nome']); ?>"/><br/>
        <label>Email:</label>
        <input type="text" Name="Email" value="<?php echo htmlspecialchars($recado_editar['Email']); ?>"/><br/>
        <label>Mensagem:</label>
        <textarea name="Mensagem"><?php echo htmlspecialchars($recado_editar['Mensagem']); ?></textarea><br/>
        <input type="hidden" Name="id" value="<?php echo $recado_editar['ID']; ?>"/>
        <input type="submit" Name="atualiza" value="Modificar Recado" class="btn"/>
    </form>
    </div>
    <?php endif; ?>

    <?php
$seleciona = mysqli_query($conexao, "SELECT * FROM aluno ORDER BY id DESC");
if(mysqli_num_rows($seleciona) <= 0){
    echo "<p>Nenhum pedido no mural!</p>";
}else{
    while($res = mysqli_fetch_assoc($seleciona)){
        echo '<ul class="recados">';
        echo '<li><strong>ID:</strong> ' . $res['ID'] . ' |
              <a href="moderar.php?acao=excluir&id=' . $res['ID'] . '">Remover</a> |
              <a href="moderar.php?acao=editar&id=' . $res['ID'] . '">Modificar</a></li>';
        echo '<li><strong>Nome:</strong> ' . htmlspecialchars($res['Nome']) . '</li>';
        echo '<li><strong>Email:</strong> ' . htmlspecialchars($res['Email']) . '</li>';
        echo '<li><strong>Mensagem:</strong> ' . nl2br(htmlspecialchars($res['Mensagem'])) . '</li>';
        echo '</ul>';
    }
}
?>

<div id="footer">
</div>
</div>
</div>
</body>
</html>