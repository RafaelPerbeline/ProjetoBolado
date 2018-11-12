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
$query = "SELECT * FROM sessao";
$rs = mysqli_query($conexao,$query);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>INSERIR LIVROS</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1>CADASTRAR NOVO LIVRO</h1>
		<form id="frmNovoLivro" name="frmNovoLivro" method="POST" action="insLivro.php">
			<div class="form-group col-md-8">
				<label for="lblTitulo">TITULO</label>
				<input type="text" class="form-control col-md-5" id="txtTitulo" name="txtTitulo" placeholder="INFORME O TITULO DO LIVRO">
			</div>
			<div class="form-group col-md-8">
				<label for="lblAutor">AUTOR</label>
				<input type="text" class="form-control col-md-5" id="txtAutor" name="txtAutor" placeholder="INFORME O AUTOR DO LIVRO">
			</div>
			<div class="form-group col-md-8">
				<label for="lblcodSessao">CODIGO DA SESSÃO</label>
				<input list="codSessao" class="form-control col-md-5" id="txtcodSessao" name="txtcodSessao" placeholder="INFORME O CODIGO DA SESSÃO">
				<datalist id="codSessao">
					<?php while ($linha = mysqli_fetch_array($rs)) { ?>
					<option value="<?php echo $linha ['codSessao']; ?>"><?php echo $linha ['nome']; ?></option>
					<?php } ?>
				</datalist>
			</div>
			<input type="submit" id="btEnviar" name="btEnviar" class="btn btn-success" value="GRAVAR">
			<input type="reset" id="btLimpar" name="btLimpar" class="btn btn-secondary" value="LIMPAR">
			<input type="button" id="btCancel" name="btCancel" class="btn btn-danger" value="CANCELAR" onclick="javascript:location.href='lstLivros.php'">
		</form>
	</div>
</body>
</html>