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
$query = "SELECT * FROM usuario";
$rs = mysqli_query($conexao,$query);
$queryU = "SELECT * FROM usuario WHERE nome = '$nomeUs'";
$rsU = mysqli_query($conexao,$queryU);
$linhaU = mysqli_fetch_array($rsU);
$usuario = $linhaU ['matricula'];
$queryE = "SELECT * FROM emprestimo;";
$rsE = mysqli_query($conexao,$queryE);
//$linhaE = mysqli_fetch_array($rsE);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>LISTA DOS LIVROS DISPONIVEIS</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
	<h1>LISTA DE USUARIOS</h1>
	<br>
	<input type="button" id="btVoltarOp" name="btVoltarOp" class="btn btn-danger" value="VOLTAR" onclick="javascript:location.href='opcoes.php'">
	<br>
	<br>
	<table class="table table-dark table table-hover table-bordered col-md-10">
		<tr>
			<th>MATRICULA</th>
			<th>NOME COMPLETO</th>
			<th>NOME DE USUARIO</th>
			<th>EMAIL</th>
			<th>TELEFONE</th>
			<th>TIPO DE USUARIO</th>
			<th colspan="4" class="text-center">OPERAÇÕES </th>
		</tr>
		<?php while ($linha = mysqli_fetch_array($rs)) { 
			?>
				<tr>
					<td><?php echo $linha ['matricula']; ?></td>
					<td><?php echo $linha ['nomeCompleto']; ?></td>
					<td><?php echo $linha ['nome']; ?></td>
					<td><?php echo $linha ['email']; ?></td>
					<td><?php echo $linha ['telefone']; ?></td>
					<td><?php echo $linha ['verificacaoADM']; ?></td>
					<?php if($linhaU ['verificacaoADM'] == 'ADM'){ ?>
                    <td>
                     	<button  class="btn btn-warning bt-sm" onclick="javascript: location.href='frmEditUsuario.php?matricula= <?php echo $linha['matricula']; ?>'">ATUALIZAR REGISTROS</button>
                    </td>
                    <?php if($linha['matricula'] != $linhaU['matricula']){ ?>
                    <td>
                     	<button  class="btn btn-danger bt-sm" onclick="javascript: location.href='frmRemUsuario.php?matricula= <?php echo $linha['matricula']; ?>'">EXCLUIR</button>
                    </td>  
				</tr>
		<?php }}} ?>
	</table>
	<table class="table table-dark table table-hover col-md-7">
		<h2>USUARIOS DEVENDO</h2>
		<tr>
			<th>MATRICULA</th>
			<th>LIVRO DEVENDO</th>
			<th>DATA DO EMPRESTIMO</th>
			<th>DATA MAXIMA PRA DEVOLVER</th>
		</tr>
		<?php while ($linhaE = mysqli_fetch_array($rsE)) { ?>
				<tr>
					<td><?php echo $linhaE ['matriculaAluno']; ?></td>
					<td><?php echo $linhaE ['codLivro']; ?></td>
					<td><?php echo $linhaE ['dataEmp']; ?></td>
					<td><?php echo $linhaE ['dataDev']; ?></td>
				</tr>
		<?php } ?>
	</table>
	</div>
</body>
</html>