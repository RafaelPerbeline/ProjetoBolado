<html>
  <head>
    <meta charset="utf-8">
    <title>CADASTRO USUARIO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/validator.min.js"></script>
  </head>
  <body>
     <div class="container">
        <h1>Cadastro de Usuario</h1>
        <form id="frmValida" role="form" data-toggle="validator" method="POST" action="cadastroUsuario.php">
          <div class="form-group ">
            <label for="inputName" class="control-label">Nome</label>
            <input type="text" class="form-control" id="inputName" name="nome" placeholder="" maxlength="40" required>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="inputTwitter" class="control-label">Usurio</label>
               <input type="text" maxlength="35" class="form-control" id="inputTwitter" name="twitter" placeholder="" required>
            <div class="help-block with-errors">Nome que sera usado para login</div>
          </div>
          <div class="form-group ">
             <label for="inputEmail" class="control-label">Email: </label>
             <input type="email" class="form-control" id="inputEmail" name="email" placeholder="E-mail" data-error="e-mail invalido" maxlength="50" required>
          <div class="help-block with-errors"></div>
          </div>           
          <div class="form-group">
                <label for="inputNumber" class="control-label">Telefone: </label>
                <input type="text" class="form-control col-sm-3" id="inputNumber" name="numero" placeholder="Informe Número" data-error="Informe seu numero de telefone" maxlength="35" required>
                <div class="help-block with-errors"></div>
          </div>  
          <br><br>
          <div class="form-group">
            <label for="inputPassword" class="control-label">Senha:</label>
            <div class="form-inline row">
               <div class="form-group col-sm-6">
                  <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
                  <div class="help-block">Tamanho mínimo: 6 caracteres</div>
               </div>
               <div class="form-group col-sm-6">
                 <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Campo senha e confirma diferentes!!!" placeholder="Repita a Senha" required>
                 <div class="help-block with-errors"></div>
               </div>
            </div>
          </div>
        <div class="form-group">
            <input type="submit" id="btEnviar" name="btEnviar" class="btn btn-success" value="CADASTRAR">
            <br><br>
            <input type="button" id="btCancel" name="btCancel" class="btn btn-danger" value="VOLTAR" onclick="javascript:location.href='index.php'">
        </div>
        </form>
     </div>
  </body>
</html>