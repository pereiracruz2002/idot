<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php base_url();?>assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Sistema IDOT</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="/assets/admin/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/admin/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/assets/admin/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/assets/admin/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style>
        body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
    color: #fff;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
    </style>
 </head>

    <body class="login-body">
   
        


    <div class="container">
        <div class="card card-container">

            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <?php echo (isset($msg) ? box_alert($msg) : ''); ?>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text"name="login"  id="inputLogin" class="form-control" placeholder="Login" required autofocus>
                <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form><!-- /form -->
             <a id="modalForgot" class="forgot-password" data-toggle="modal" href="#forgotPassword">Esqueceu a senha?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

        <div aria-hidden="true" aria-labelledby="forgotPassword" role="dialog" tabindex="-1" id="forgotPassword" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-forgot" id="forgot" action="/admin/login/forgotPassword" method="post">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
                            <h4 class="modal-title">Recuperar a senha</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-block alert-danger <?php echo (!isset($error_forgot) ? 'hide' : 'fade in'); ?>">
                                <?php if (isset($error_forgot)) echo $error_forgot; ?>
                            </div>
                            <div class="alert alert-block alert-success <?php echo (!isset($success_forgot) ? 'hide' : 'fade in'); ?>">
                                <?php if (isset($success_forgot)) echo $success_forgot; ?>
                            </div>
                            <div>
                                <p>Digite o seu email para receber um link de recuperação de senha.</p>
                                <input type="email" name="email" placeholder="Email" autocomplete="on" class="form-control placeholder-no-fix" autofocus="" required="" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!--   Core JS Files   -->
        <script src="/assets/admin/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="/assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                <?php if (isset($error_forgot) || isset($success_forgot)): ?>
                    $("#modalForgot").trigger("click");
                <?php endif; ?>
                    
                $("form").on("submit", function () {
                    $(this).find("button").each(function () {
                        $(this).attr("disabled", "disabled").html('<i class="fa ico-spinner3 fa-spin"></i>');
                    });
                });
            });
        </script>
    </body>
</html>

