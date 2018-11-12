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
$op = trim($_POST['txtOp']);
$val = 'S';
$nomeUs = $_SESSION['nome'];
$querySU = "SELECT * FROM usuario where nome = '$nomeUs'";
$rs = mysqli_query($conexao,$querySU);
$linha = mysqli_fetch_array($rs);
if($linha ['verificacaoADM'] != 'CLI'){
	$matriculaAluno = trim($_POST['txtUsuarios']);
}
else {
	$matriculaAluno = trim($_POST['txtMatricula']);
}
$dataEmp = $_POST['txtDataE'];
$data = new DateTime($dataEmp);
$data -> add(new DateInterval('P30D'));
$dataDev = $data -> format('Y-m-d H:i:s');

$queryIE = "INSERT INTO emprestimo (dataEmp, dataDev, matriculaAluno, codLivro) VALUES ('$dataEmp', '$dataDev', '$matriculaAluno', '$codLivro');";
$insIE = mysqli_query($conexao,$queryIE);
if(!$insIE){
	echo "ERRO DE OPERAÇÃO 1";
}else{
	$query = "UPDATE livro set emprestado = '$val' where codLivro = '$codLivro';";
	$ins = mysqli_query($conexao,$query);

	if(!$ins){
		echo "ERRO AO ATUALIZAR PRODUTO";
	}
}


//$codigoEmprestimo = mysqli_insert_id($conexao); //pega ultima chave primaria que foi inserida 
header("location: lstLivros.php");
?>