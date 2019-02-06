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
<body class="<?php echo $this->uri->segment(2);?>">
<div class="sidebar" data-color="purple" data-image="/assets/admin/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active">
                <a href="<?php echo site_url('admin/painel') ?>">
                    <i class="pe-7s-graph"></i>
                    <p>Painel</p>
                </a>
            </li>
            <?php if($this->session->userdata('admin')->tipo=="admin"):?>
            <li>
                <a href="<?php echo site_url('admin/admins') ?>">
                    <i class="pe-7s-user"></i>
                    <p>Administradores</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/professor') ?>">
                    <i class="pe-7s-user"></i>
                    <p>Professores</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/alunos') ?>">
                    <i class="pe-7s-user"></i>
                    <p>Alunos</p>
                </a>
            </li>
            <li>
                <!-- <a href="<?php echo site_url('admin/cursos') ?>">
                    <i class="pe-7s-note2"></i>
                    <p>Cursos</p>
                </a> -->
                <a href="<?php echo site_url('admin/agendamento') ?>">
                    <i class="pe-7s-note2"></i>
                    <p>Cursos</p>
                </a>
            </li>
            <li> 
                <a href="<?php echo site_url('admin/salas') ?>">
                    <i class="pe-7s-home"></i>
                    <p>Salas</p>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/avisos') ?>">
                    <i class="pe-7s-bell"></i>
                    <p>Notificações</p>
                </a>
            </li>
            <!-- <li>
                <a href="<?php echo site_url('admin/agendamento') ?>">
                    <i class="pe-7s-date"></i>
                    <p>Agendamentos</p>
                </a>
            </li> -->
            <?php elseif ($this->session->userdata('admin')->tipo=="professor"):?>
                <li>
                    <a href="<?php echo site_url('admin/agendamento') ?>">
                        <i class="pe-7s-date"></i>
                        <p>Meus Agendamentos</p>
                    </a>
                </li>

            <?php else:?>
                <li>
                <a href="<?php echo site_url('admin/agendamento/ver_minha_agenda') ?>">
                    <i class="pe-7s-date"></i>
                    <p>Meus Agendamentos</p>
                </a>
            </li>
            <?php endif;?>
        </ul>
    </div>
</div>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Painel</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                                <p class="hidden-lg hidden-md">Painel</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                                <p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('login/sair') ?>">
                                <p>Sair</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>