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
$codLivro = trim($_REQUEST['codLivro']);//codigo que vai editar 
$query = "SELECT * FROM livro where codLivro =".$codLivro;
$rs = mysqli_query($conexao,$query);
$edita  = mysqli_fetch_array($rs); 
$nomeUs = $_SESSION['nome'];
$queryU = "SELECT * FROM usuario where nome = '$nomeUs'";
$rsU = mysqli_query($conexao,$queryU);
$editaU  = mysqli_fetch_array($rsU); 
$queryUs = "SELECT * FROM usuario";
$rsUs = mysqli_query($conexao,$queryUs);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Devolução de Livro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1>DEVOLUÇÃO DE LIVRO</h1>
		<form id="frmDevLivro" name="frmDevLivro" method="POST" action="devLivro.php">
			<div class="form-group col-md-8">
				<label for="lbltxtcodLivro">CODIGO DO LIVRO: </label>
				<input type="text" class="form-control col-md-5" id="txtcodLivro" name="txtcodLivro" value="<?php echo $edita['codLivro'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblTitulo">TITULO: </label>
				<input type="text" class="form-control col-md-5" id="txtTitulo" name="txtTitulo" value="<?php echo $edita['titulo'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblAutor">AUTOR: </label>
				<input type="text" class="form-control col-md-5" id="txtAutor" name="txtAutor" value="<?php echo $edita['autor'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblcodSessao">CODIGO SESSÃO </label>
				<input class="form-control col-md-5" id="txtcodSessao" name="txtcodSessao" value="<?php echo $edita['codSessao'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<input type="hidden" class="form-control col-md-5" id="txtOp" name="txtOp" value="<?php $edita['emprestado'] ?>">
			</div>
			<h2>Informações do Emprestimo</h2>
			<div class="form-group col-md-8">
				<label for="lblMatricula">Matricula: </label>
				<input type="text" class="form-control col-md-5" id="txtMatricula" name="txtMatricula" value="<?php echo $editaU['matricula'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblNome">Usuario: </label>
				<input type="text" class="form-control col-md-5" id="txtNome" name="txtNome" value="<?php echo $editaU['nome'] ?>" readonly="readonly">
			</div>
			<?php if ($editaU['verificacaoADM'] != 'CLI') { ?>
			<div class="form-group col-md-8">
				<label for="lblUsuarios">Qual Usuario Emprestou?: </label>
				<input list="Usuarios" class="form-control col-md-5" id="txtUsuarios" name="txtUsuarios" placeholder="INFORME O USUARIO">
				<datalist id="Usuarios" required>
					<?php while ($linha = mysqli_fetch_array($rsUs)) { ?>
					<option value="<?php echo $linha ['matricula']; ?>"><?php echo $linha ['nome']; ?></option>
					<?php } ?>
				</datalist>
			</div>
			<?php } ?>
			<div class="form-group col-md-8">
				<label for="lblDataD">Data Devolução: </label>
				<input type="date" class="form-control col-md-5" id="txtDataD" name="txtDataD" value="" required>
			</div>
			<hr>
			<input type="submit" id="btEnviar" name="btEnviar" class="btn btn-success" value="DEVOLVER">
			<input type="button" id="btCancel" name="btCancel" class="btn btn-danger" value="CANCELAR" onclick="javascript:location.href='lstLivros.php'">
		</form>
	</div>
		</form>
</body>
</html>