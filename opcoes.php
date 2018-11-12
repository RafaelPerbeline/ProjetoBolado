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
$queryU = "SELECT * FROM usuario WHERE nome = '$nomeUs'";
$rsU = mysqli_query($conexao,$queryU);
$linhaU = mysqli_fetch_array($rsU)
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      <div class="container justify-content: center col-md-8">
            <h1>BIBLIOTECA ONLINE</h1>
            <div class="form-group col-md-8">
              <h2>Bem Vindo <?php echo $_SESSION['nome'] ?></h2>
              <h3>Tipo de Cadastro: <?php echo $linhaU ['verificacaoADM'] ?></h3>
            </div>
            <input type="button" id="btLstLivro" name="btLstLivro" class="btn btn-danger" value="LISTA DOS LIVROS" onclick="javascript:location.href='lstLivros.php'">
            <?php if($linhaU ['verificacaoADM'] != 'CLI'){ ?>
            <input type="button" id="btLstSessoes" name="btLstSessoes" class="btn btn-danger" value="LISTA DAS SESSÕES" onclick="javascript:location.href='lstSessoes.php'" disabled="disabled">
            <?php if($linhaU ['verificacaoADM'] != 'TRB'){ ?>
            <input type="button" id="btLstUsuario" name="btLstUsuario" class="btn btn-danger" value="LISTA DOS USUARIOS" onclick="javascript:location.href='lstUsuarios.php'">
            <?php }}?>
            <input type="button" id="btLogout" name="btLogout" class="btn btn-danger" value="LOGOUT" onclick="javascript:location.href='logout.php'">
      </div>
  </body>
</html>