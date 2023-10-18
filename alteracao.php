<?php

$nome_usuario = $_POST['nome_usuario'];
$id =$_POST['id'];


include_once("conexao.php");
$result_usuario = "UPDATE tabela_teste SET nome = '$nome_usuario' WHERE id='$id'";
$resultado_usuario = mysqli_query($connection, $result_usuario);

?>