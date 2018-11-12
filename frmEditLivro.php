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
$queryS = "SELECT * FROM sessao";
$rsS = mysqli_query($conexao,$queryS);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Livro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1>EDITAR LIVRO</h1>
		<form id="frmEditarLivro" name="frmEditarLivro" method="POST" action="editLivro.php">
			<div class="form-group col-md-8">
				<label for="lbltxtcodLivro">CODIGO DO LIVRO: </label>
				<input type="text" class="form-control col-md-5" id="txtcodLivro" name="txtcodLivro" value="<?php echo $edita['codLivro'] ?>" readonly="readonly">
			</div>
			<div class="form-group col-md-8">
				<label for="lblTitulo">TITULO: </label>
				<input type="text" class="form-control col-md-5" id="txtTitulo" name="txtTitulo" value="<?php echo $edita['titulo'] ?>">
			</div>
			<div class="form-group col-md-8">
				<label for="lblAutor">AUTOR: </label>
				<input type="text" class="form-control col-md-5" id="txtAutor" name="txtAutor" value="<?php echo $edita['autor'] ?>">
			</div>
			<div class="form-group col-md-8">
				<label for="lblcodSessao">VAI MUDAR A SESSÃO? </label>
				<input list="codSessao" class="form-control col-md-5" id="txtcodSessao" name="txtcodSessao" value="<?php echo $edita['codSessao'] ?>">
				<datalist id="codSessao">
					<?php while ($linha = mysqli_fetch_array($rsS)) { ?>
					<option value="<?php echo $linha ['codSessao']; ?>"><?php echo $linha ['nome']; ?></option>
					<?php } ?>
				</datalist>
			</div>
			<input type="submit" id="btEnviar" name="btEnviar" class="btn btn-success" value="GRAVAR">
			<input type="reset" id="btLimpar" name="btLimpar" class="btn btn-secondary" value="LIMPAR">
			<input type="button" id="btCancel" name="btCancel" class="btn btn-danger" value="CANCELAR" onclick="javascript:location.href='lstLivros.php'">
		</form>
	</div>
		</form>
</body>
</html>