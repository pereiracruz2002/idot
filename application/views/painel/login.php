<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrar</title>

    <link href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/admin/css/login.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

        <?php echo (isset($msg) ? box_alert($msg) : ''); ?>
      <form class="form-signin"  method="post">
          <h2 class="form-signin-heading"><img src="<?php echo base_url() ?>assets/admin/images/logo.png" class="img-responsive" /></h2> 
          <div class="login-wrap">
              <div class="user-login-info">
                  <input type="text" class="form-control" name="login" placeholder="Login" required autofocus="" />
                  <input type="password" name="password" class="form-control" placeholder="Senha" required />
              </div>
              <div class="alert alert-block alert-danger <?php echo (!isset($error) ? 'hide' : 'fade in'); ?>">
                  <?php if (isset($error)) echo $error; ?>
              </div>
              <a id="modalForgot" data-toggle="modal" href="#forgotPassword">Esqueceu a senha?</a>
              <button class="btn btn-lg btn-login btn-block" type="submit">Entrar</button>
          </div>  
      </form>

    </div> <!-- /container -->
  </body>
</html>

