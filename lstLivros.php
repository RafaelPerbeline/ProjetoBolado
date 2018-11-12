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
$query = "SELECT * FROM livro";
$queryS = "SELECT * FROM sessao";
$queryU = "SELECT * FROM usuario WHERE nome = '$nomeUs'";
$rs = mysqli_query($conexao,$query);
$rsS = mysqli_query($conexao,$queryS);
$rsU = mysqli_query($conexao,$queryU);
$linhaU = mysqli_fetch_array($rsU);
$usuario = $linhaU ['matricula'];

$queryE = "SELECT * FROM emprestimo WHERE matriculaAluno = '$usuario';";
$rsE = mysqli_query($conexao,$queryE);
//$linhaE = mysqli_fetch_array($rsE);
$emprestadoE = '';
if(!empty($linhaE)){
	if (!empty($linhaE['dataDev'])) {
		$emprestadoE = $linhaE[''];
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>LISTA DOS LIVROS DISPONIVEIS</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
	<h1>LIVROS DA BIBLIOTECA</h1>
	<br>
	<?php if($linhaU ['verificacaoADM'] != 'CLI'){ ?>
	<input type="button" id="btAdicionar" name="btAdicionar" class="btn btn-primary" value="ADICIONAR" onclick="javascript:location.href='frmInsLivro.php'">
	<?php } ?>
	<input type="button" id="btVoltarOp" name="btVoltarOp" class="btn btn-danger" value="VOLTAR" onclick="javascript:location.href='opcoes.php'">
	<br>
	<br>
	<table class="table table-dark table table-hover table-bordered col-md-10">
		<tr>
			<th>Codigo do Livro</th>
			<th>Titulo</th>
			<th>Autor</th>
			<th>Codigo da Sessão</th>
			<th>Foi Emprestado?</th>
			<th colspan="4" class="text-center">OPERAÇÕES </th>
		</tr>
		<?php while ($linha = mysqli_fetch_array($rs)) { 
			
			?>
				<tr>
					<td><?php echo $linha ['codLivro']; ?></td>
					<td><?php echo $linha ['titulo']; ?></td>
					<td><?php echo $linha ['autor']; ?></td>
					<td><?php echo $linha ['codSessao']; ?></td>
					<td><?php echo $linha ['emprestado']; ?></td>
					<?php if($linhaU ['verificacaoADM'] != 'CLI'){ ?>
                    <td>
                     	<button  class="btn btn-warning bt-sm" onclick="javascript: location.href='frmEditLivro.php?codLivro= <?php echo $linha['codLivro']; ?>'">EDITAR</button>
                    </td>
                    <td>
                     	<button  class="btn btn-danger bt-sm" onclick="javascript: location.href='frmRemLivro.php?codLivro= <?php echo $linha['codLivro']; ?>'">EXCLUIR</button>
                    </td>
                    <?php
                    	if($linha['emprestado'] == 'N' || empty($linha['emprestado'])) {
                    ?>
                    <td>
                     	<button  class="btn btn-primary bt-sm" onclick="javascript: location.href='frmEmpLivro.php?codLivro= <?php echo $linha['codLivro']; ?>'">EMPRESTAR</button>
                    </td>
                    <?php }
                    	if($linha['emprestado'] == 'S' || empty($linha['emprestado'])){
                    ?>
                    <td>
                     	<button  class="btn btn-info bt-sm" onclick="javascript: location.href='frmDevLivro.php?codLivro= <?php echo $linha['codLivro']; ?>'">DEVOLVER</button>
                    </td>
                    <td>
                    </td>
                    <?php }}
                    if ($linhaU ['verificacaoADM'] == 'CLI') { 
                    	if($linha['emprestado'] == 'N' || empty($linha['emprestado'])) {
                    ?>
                    <td>
                     	<button  class="btn btn-primary bt-sm" onclick="javascript: location.href='frmEmpLivro.php?codLivro= <?php echo $linha['codLivro']; ?>'">EMPRESTAR</button>
                    </td>
                    <?php }
                    if($linha['emprestado'] == 'S' || empty($linha['emprestado'])){
                    	//echo "A";
                    while($linhaE = mysqli_fetch_array($rsE)) {//echo "B";
                    	if($linhaE['codLivro']==$linha['codLivro']){//echo "C"; 
                    ?>
                    <td>
                     	<button  class="btn btn-info bt-sm" onclick="javascript: location.href='frmDevLivro.php?codLivro= <?php echo $linha['codLivro']; ?>'">DEVOLVER</button>
                    	<h6>DEVOLVER ATÉ: <?php echo $linhaE['dataDev']; ?></h6>
                    </td>
                    <?php }}$rsE = mysqli_query($conexao,$queryE);} ?>  
				</tr>
		<?php }} ?>
	</table>
	<table class="table table-dark table table-hover col-md-3">
		<tr>
			<th>LEGENDA CODIGO DA SESSÃO</th>
		</tr>
		<?php while ($linhaS = mysqli_fetch_array($rsS)) { ?>
				<tr>
					<td><?php echo $linhaS ['codSessao']; ?> - <?php echo $linhaS ['nome']; ?></td>
				</tr>
		<?php } ?>
	</table>
	</div>
</body>
</html>