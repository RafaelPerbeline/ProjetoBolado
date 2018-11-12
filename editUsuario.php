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
$matricula = trim($_POST['txtMatricula']);
$nomeComp = trim($_POST['txtNomeCompleto']);
$email = trim($_POST['txtEmail']);
$telefone = trim($_POST['txtTelefone']);
$novaSenha1 = trim($_POST['txtNovaSenha']);
$novaSenha = md5($novaSenha1);
$verificacao = trim($_POST['txtAltTipUs']);
if(!empty($matricula) && !empty($nomeComp) && !empty($email) && !empty($telefone) && !empty($verificacao)){
	$query = "UPDATE usuario set nomeCompleto = '$nomeComp', email='$email', telefone = '$telefone', verificacaoADM = '$verificacao' where matricula = '$matricula';";
	$ins = mysqli_query($conexao,$query);
	if(!$ins){
		echo "ERRO AO ATUALIZAR PRODUTO";
	}
	if(!empty($novaSenha1)){
		$queryNS = "UPDATE usuario set senha = '$novaSenha' where matricula = '$matricula';";
		$insNS = mysqli_query($conexao,$queryNS);
	}
	header("location: lstUsuarios.php");
}
else{
	echo "PREENCHER OS CAMPOS verificacao";
}
?>