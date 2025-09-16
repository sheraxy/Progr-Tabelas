<?php
include "conexao.php"; // inclui o arquivo de conexão

$result = mysqli_query($conexao, "SELECT * FROM aluno"); // exemplo de consulta

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <title> alunos </title>
<form class="josefina">
<h3> Cadastro </h3>
<input type="text" placeholder="nome" ID="nome">
<input type="e-mail" placeholder="e-mail" ID="e-mail">
<input type="text" placeholder="mensagem" ID="mensagem">
<input type="submit" onclick="logar(); return false">
</form>
</body>
</html>