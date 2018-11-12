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
$matricula = trim($_REQUEST['matricula']);//matricula que vai editar 
$query = "SELECT * FROM usuario where matricula =".$matricula;
$rs = mysqli_query($conexao,$query);
$edita  = mysqli_fetch_array($rs);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Tipo De Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>EDITAR TIPO DE USUARIO</h1>
		<form id="frmEditarTipUsu" name="frmEditarTipUsu" method="POST" action="editUsuario.php">
			<div class="form-group col-md-8">
				<label for="lbltxtMatricula">MATRICULA: </label>
				<input type="text" class="form-control col-md-5" id="txtMatricula" name="txtMatricula" value="<?php echo $edita['matricula'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblNomeCompleto">NOME COMPLETO: </label>
				<input type="text" class="form-control col-md-5" id="txtNomeCompleto" name="txtNomeCompleto" value="<?php echo $edita['nomeCompleto'] ?>">
			</div>
			<div class="form-group col-md-8">
				<label for="lblNomeUsu">NOME DE USUARIO: </label>
				<input type="text" class="form-control col-md-5" id="txtNomeUsu" name="txtNomeUsu" value="<?php echo $edita['nome'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblEmail">EMAIL: </label>
				<input type="text" class="form-control col-md-5" id="txtEmail" name="txtEmail" value="<?php echo $edita['email'] ?>">
			</div>
			<div class="form-group col-md-8">
				<label for="lblTelefone">TELEFONE: </label>
				<input type="text" class="form-control col-md-5" id="txtTelefone" name="txtTelefone" value="<?php echo $edita['telefone'] ?>">
			</div>
			<div class="form-group col-md-8">
				<hr>
				<label for="lblNovaSenha">NovaSenha?: </label><br>
				<input type="checkbox" name="NovaSenha" id="NovaSenha"> NÃO
				<input type="text" class="form-control col-md-5" id="txtNovaSenha" name="txtNovaSenha" placeholder="INFORME A NOVA SENHA">
				<script type="text/javascript">
					$('[name="NovaSenha"]').change(function() {
  						$('[name="txtNovaSenha"]').toggle(200);
					});
				</script>
				<hr>
			</div>
			<div class="form-group col-md-8">
				<label for="lblAltTipUs">Alterar Tipo De Usuario? </label>
				<input list="AltTipUs" class="form-control col-md-5" id="txtAltTipUs" name="txtAltTipUs" value="<?php echo $edita['verificacaoADM'] ?>">
				<datalist id="AltTipUs">
					<option value="ADM">Administrador</option>
					<option value="TRB">Trabalhador</option>
					<option value="CLI">Cliente</option>
				</datalist>
			</div>
			<input type="submit" id="btEnviar" name="btEnviar" class="btn btn-success" value="GRAVAR">
			<input type="reset" id="btLimpar" name="btLimpar" class="btn btn-secondary" value="LIMPAR">
			<input type="button" id="btCancel" name="btCancel" class="btn btn-danger" value="CANCELAR" onclick="javascript:location.href='lstUsuarios.php'">
		</form>
	</div>
		</form>
</body>
</html>