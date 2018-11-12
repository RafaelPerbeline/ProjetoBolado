<?php 
session_start();
if(!isset($_SESSION['nome'])){
	header("location: frmLoginUsuario.php");
}
$conexao = mysqli_connect("localhost","root","");
if(!$conexao){
	echo "ERRO AO SE CONECTAR AO MYSQL <br/>";
	exit;
}
$banco = mysqli_select_db($conexao,"biblioteca");
if(!$banco){
	echo "ERRO AO SE CONECTAR AO BANCO DE DADOS BIBLIOTECA <br/>";
	exit;
}
$codLivro = trim($_POST['txtcodLivro']);

if(!empty($codLivro)){
	$query = "DELETE FROM livro WHERE codLivro = '$codLivro';";
	$ins = mysqli_query($conexao,$query);
	if(!$ins){
		echo "ERRO AO EXCLUIR PRODUTO";
	}
}
else{
	echo "PREENCHER OS CAMPOS TITULO E CODIGO DA SESSÃO";
}
header("location: lstLivros.php");
?>