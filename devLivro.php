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
$nomeUs = $_SESSION['nome'];
$querySU = "SELECT * FROM usuario where nome = '$nomeUs';";
$rs = mysqli_query($conexao,$querySU);
$linha = mysqli_fetch_array($rs);
if($linha ['verificacaoADM'] != 'CLI'){
	$matriculaAluno = trim($_POST['txtUsuarios']);
}
else {
	$matriculaAluno = trim($_POST['txtMatricula']);
}
$codLivro = trim($_POST['txtcodLivro']);
$op = trim($_POST['txtOp']);
$val = 'N';
$dataDev = $_POST['txtDataD'];
$querySE = "SELECT * FROM emprestimo WHERE matriculaAluno = '$matriculaAluno' AND codLivro = '$codLivro';";
$rsSE = mysqli_query($conexao,$querySE);
$linhaSE = mysqli_fetch_array($rsSE);
if (!$linhaSE) {
	?>
	<script>
		alert('ERRO DE OPERAÇÃO');
		window.setTimeout("location.href='lstLivros.php';", 5);
	</script>
	<?php
}else{
if(mysqli_num_rows($rsSE)>0){
if($dataDev<=$linhaSE['dataDev']){
	$query = "UPDATE livro set emprestado = '$val' where codLivro = '$codLivro';";
	$ins = mysqli_query($conexao,$query);
	$codEmp = $linhaSE['codEmprestimo'];
	$queryDelEmp = "DELETE FROM emprestimo WHERE codEmprestimo = '$codEmp';";
	$insDelEmp = mysqli_query($conexao,$queryDelEmp);
	if(!$ins && !$insDelEmp){
		echo "ERRO AO ATUALIZAR PRODUTO";
	}
	header("location: lstLivros.php");
}
else{
	?>
	<script>
		alert('DATA DA DEVOLUÇÃO FOI ULTRAPASSADA, POR FAVOR CONVERSAR COM A RECEPÇÃO');
		window.setTimeout("location.href='lstLivros.php';", 5);
	</script>
	<?php	
}
}
else{
	?>
	<script>
		alert('NÃO EXISTE REGISTRO DE EMPRESTIMO DESSEE USUARIO');
		window.setTimeout("location.href='lstLivros.php';", 5);
	</script>
	<?php	
}
}
?>