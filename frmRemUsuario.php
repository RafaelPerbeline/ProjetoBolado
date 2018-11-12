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
$matricula = trim($_REQUEST['matricula']);//codigo que vai editar 
$query = "SELECT * FROM usuario where matricula =".$matricula;
$rs = mysqli_query($conexao,$query);
$edita  = mysqli_fetch_array($rs); 
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Excluir Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1>EXCLUIR USUARIO</h1>
		<form id="frmRemUsuario" name="frmRemUsuario" method="POST" action="remUsuarios.php">
			<div class="form-group col-md-8">
				<label for="lbltxtMatricula">MATRICULA: </label>
				<input type="text" class="form-control col-md-5" id="txtMatricula" name="txtMatricula" value="<?php echo $edita['matricula'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblTitulo">NOME COMPLETO: </label>
				<input type="text" class="form-control col-md-5" id="txtNomeCompleto" name="txtNomeCompleto" value="<?php echo $edita['nomeCompleto'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblNome">NOME DE USUARIO: </label>
				<input type="text" class="form-control col-md-5" id="txtNome" name="txtNome" value="<?php echo $edita['nome'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblEmail">EMAIL: </label>
				<input class="form-control col-md-5" id="txtEmail" name="txtEmail" value="<?php echo $edita['email'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblTelefone">TELEFONE: </label>
				<input class="form-control col-md-5" id="txtTelefone" name="txtTelefone" value="<?php echo $edita['telefone'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblVerif">TELEFONE: </label>
				<input class="form-control col-md-5" id="txtVerif" name="txtVerif" value="<?php echo $edita['verificacaoADM'] ?>" readonly="readonly">
			</div>
			<input type="submit" id="btEnviar" name="btEnviar" class="btn btn-success" value="EXCLUIR">
			<input type="button" id="btCancel" name="btCancel" class="btn btn-danger" value="CANCELAR" onclick="javascript:location.href='lstUsuarios.php'">
		</form>
	</div>
		</form>
</body>
</html>