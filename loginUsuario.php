<?php 
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
$usuario = trim($_POST['usuario']);//codigo que vai editar 
$senha = trim($_POST['password']);
$senha = md5($senha);
$query = "SELECT * FROM usuario where nome like '$usuario'";
$rs = mysqli_query($conexao,$query);
$linha  = mysqli_fetch_array($rs);
if($senha==$linha['senha']){
	session_start();
	$_SESSION['nome'] = $usuario;
	header("location: opcoes.php");
}
else{
?>
	<script>
	alert('USUARIO OU SENHA NÃO COINCIDEM');
	window.setTimeout("location.href='frmLoginUsuario.php';", 5);
	</script>
<?php 
}
?>