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
$nome = trim($_POST['nome']);
$usuario = trim($_POST['twitter']);
$email = trim($_POST['email']);
$numero = trim($_POST['numero']);
$senha = md5(trim($_POST['password']));
$query = "SELECT * FROM usuario WHERE nome = '$usuario'";
$rs = mysqli_query($conexao,$query);
if (mysqli_num_rows($rs)>0) {
	?>
	<script>
		alert('USUARIO JA CADASTRADO');
		window.setTimeout("location.href='frmCadastroUsuario.php';", 5);
	</script>
	<?php	
}
else{
	$queryr = "INSERT INTO usuario (nomeCompleto, nome, email, telefone, senha, verificacaoADM) VALUES ('$nome', '$usuario', '$email', '$numero', '$senha', 'CLI');";
	$ins = mysqli_query($conexao,$queryr);
	if(!$ins){
		echo "ERRO AO INSERIR PRODUTO";
	}

}
header("location: index.php");
?>