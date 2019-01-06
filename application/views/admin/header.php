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
    
    <?php
        if (isset($cssFiles)):
            foreach ($cssFiles as $v):
                ?>
                <link rel="stylesheet" type="text/css"  href="<?php echo base_url() ?>assets/admin/css/<?php echo $v ?>">
                <?php
            endforeach;
        endif;
        ?>
        <script>var base_url = '<?php echo site_url('admin') ?>/';</script> 
        <script>var base = '<?php echo base_url() ?>';</script>

</head>
<body>
<div class="sidebar" data-color="purple" data-image="/assets/admin/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="sidebar-wrapper">
        <div class="logo">
            Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
            </a>
        </div>

        <ul class="nav">
            <li class="active">
                <a href="<?php echo site_url('admin/painel') ?>">
                    <i class="pe-7s-graph"></i>
                    <p>Painel</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/admins') ?>">
                    <i class="pe-7s-user"></i>
                    <p>Administradores</p>
                </a>
            </li>
            <li>
                <a href="user.html">
                    <i class="pe-7s-user"></i>
                    <p>Professores</p>
                </a>
            </li>
            <li>
                <a href="user.html">
                    <i class="pe-7s-user"></i>
                    <p>Alunos</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/cursos') ?>">
                    <i class="pe-7s-note2"></i>
                    <p>Cursos</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/modulos') ?>">
                    <i class="pe-7s-note2"></i>
                    <p>Módulos</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/aulas') ?>">
                    <i class="pe-7s-note2"></i>
                    <p>Aulas</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/salas') ?>">
                    <i class="pe-7s-home"></i>
                    <p>Salas</p>
                </a>
            </li>
            <li>
                <a href="notifications.html">
                    <i class="pe-7s-bell"></i>
                    <p>Notificações</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/agendamentos') ?>">
                    <i class="pe-7s-date"></i>
                    <p>Agendamentos</p>
                </a>
            </li>
        </ul>
    </div>
</div>