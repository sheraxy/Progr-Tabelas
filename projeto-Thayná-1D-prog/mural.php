<?php
include "conexao.php";
if(isset($_POST['cadastro'])){
    $Nome  = mysqli_real_escape_string($conexao, $_POST['Nome']);
    $Email = mysqli_real_escape_string($conexao, $_POST['Email']);
    $Mensagem   = mysqli_real_escape_string($conexao, $_POST['Mensagem']);

    $sql = "INSERT INTO aluno (Nome, Email, Mensagem) VALUES ('$Nome', '$Email', '$Mensagem')";
    mysqli_query($conexao, $sql) or die("Erro ao inserir dados: " . mysqli_error($conexao));
    header("Location: mural.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Mural de pedidos</title>
<link rel="stylesheet" href="style.css"/>
<script src="scripts/jquery.js"></script>
<script src="scripts/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    $("#mural").validate({
        rules: {
            Nome: { required: true, minlength: 4 },
            Email: { required: true, Email: true },
            Mensagem: { required: true, minlength: 10 }
        },
        messages: {
            Nome: { required: "Digite o seu nome", minlength: "O nome deve ter no mínimo 4 caracteres" },
            Email: { required: "Digite o seu e-mail", Email: "Digite um e-mail válido" },
            Mensagem: { required: "Digite sua mensagem", minlength: "A mensagem deve ter no mínimo 10 caracteres" }
        }
    });
});
</script>
</head>

<body>
<div id="main">
<div id="geral">
<div id="header">
    <h1>Mural de pedidos</h1>
</div>

<div id="formulario_mural">
<form id="mural" method="post">
    <label>Nome:</label>
    <input type="text" name="Nome"/><br/>
    <label>Email:</label>
    <input type="text" name="Email"/><br/>
    <label>Mensagem:</label>
    <textarea name="Mensagem"></textarea><br/>
    <input type="submit" value="Publicar no Mural" name="cadastro" class="btn"/>
</form>
</div>

<?php
$seleciona = mysqli_query($conexao, "SELECT * FROM aluno ORDER BY ID DESC");
while($res = mysqli_fetch_assoc($seleciona)){
    echo '<ul class="recados">';
    echo '<li><strong>ID:</strong> ' . $res['ID'] . '</li>';
    echo '<li><strong>Nome:</strong> ' . htmlspecialchars($res['Nome']) . '</li>';
    echo '<li><strong>Email:</strong> ' . htmlspecialchars($res['Email']) . '</li>';
    echo '<li><strong>Mensagem:</strong> ' . nl2br(htmlspecialchars($res['Mensagem'])) . '</li>';
    echo '</ul>';
}
?>

<div ID="footer">

</div>
</div>
</div>
</body>
</html>