<html>
<head>
	<title>LOGIN</title>
	<meta charset="utf-8">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<form id="frmLogin" name="frmLogin" method="POST" action="loginUsuario.php">
<div class="container">

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form">
			<fieldset>
				<h2>Por Favor, Insira As Informações</h2>
				<hr>
				<div class="form-group">
                    <input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="USUARIO">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="SUA SENHA">
				</div>
				<div class="row">
					<hr>
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Entrar">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
                     	<input type="button" id="btRegistrar" name="btRegistrar" class="btn btn-lg btn-primary btn-block" value="Registrar" onclick="javascript:location.href='frmCadastroUsuario.php'">
					</div>
				</div>
				<hr>
				<div class="col-xs-6 col-sm-6 col-md-6">
               		<input type="button" id="btVoltar" name="btVoltar" class="btn btn-lg btn-primary btn-block" value="Voltar" onclick="javascript:location.href='index.php'">
				</div>
			</fieldset>
		</form>
	</div>
</div>

</div>
	</form>
</body>
</html>