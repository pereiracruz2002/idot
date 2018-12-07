<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrativo</title>
    <link href="<?php echo base_url() ?>painel-assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>painel-assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>painel-assets/css/dashboard.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>painel-assets/fancybox/jquery.fancybox.css" rel="stylesheet">
    <script>var base_url = '<?php echo base_url() ?>';</script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('meu-painel-wvtodoz') ?>">Let`s Work</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs"><a href="<?php echo site_url('meu-painel-wvtodoz/clientes') ?>">Clientes</a></li>
            <li class="visible-xs"><a href="<?php echo site_url('meu-painel-wvtodoz/parceiros') ?>">Parceiros</a></li>
            <li><a href="<?php echo site_url('meu-painel-wvtodoz/login/sair') ?>">Sair</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="<?php echo site_url('meu-painel-wvtodoz/clientes/') ?>" method="post">
            <input type="text" class="form-control" name="empresa_id" placeholder="Procurar..." value="<?php echo $this->input->post('empresa_id') ?>">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="<?php echo site_url('admin/admins') ?>">Administradores</a></li>
            <li><a href="<?php echo site_url('admin/professores') ?>">Professores</a></li>
            <li><a href="<?php echo site_url('admin/alunos') ?>">Alunos</a></li>
            <li><a href="<?php echo site_url('admin/salas') ?>">Salas</a></li>
            <li><a href="<?php echo site_url('admin/cursos') ?>">Cursos</a></li>
            <li><a href="<?php echo site_url('admin/modulos') ?>">Módulos</a></li>
            <li><a href="<?php echo site_url('admin/aulas') ?>">Aulas</a></li>
            <li><a href="<?php echo site_url('admin/departamentos') ?>">Departamentos</a></li>
            <li><a href="<?php echo site_url('admin/nivel') ?>">Nível</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

