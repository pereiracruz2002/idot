<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/sidebar.php'); ?>

<div id="main-container" class="associar-departamentos">
    <div class="col-sm-12">
        <h3 class="headline m-top-md"><a href="<?php echo site_url($this->base_url.'/listar') ?>" class="btn btn-warning btn-sm">Voltar</a> Associar Departamentos<span class="line"></span></h3>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success ?></div>
        <?php endif; ?>
        <div class="panel table-responsive">
            <div class="panel-body">
                <form action="/admin/nivel/add_departamentos" method="post" class="form-horizontal no-margin form-border" enctype="multipart/form-data">
                    <h3>Relatórios</h3> 
                    <p>Associe os departamentos que este nível poderá gerenciar.</p>
                    <div class="row">
                        <?php foreach ($departamentos as $item): ?>
                            <div class="col-sm-4">
                                <label class="input-group">
                                    <span class="input-group-addon">
                                        <input style="opacity:10; position: initial;" type="checkbox" name="departamento[]" value="<?php echo $item->departamento_id ?>" <?php echo (in_array($item->departamento_id, $permissoes) ? 'checked' : '') ?>>
                                    </span>
                                    <p class="form-control"><?php echo $item->titulo ?></p>
                                </label>
                            </div>
                            
                        <?php endforeach; ?>                       
                    </div>
                    <h3>Funcionalidades</h3>
                    <p>Associe as funcionalidades que este nível poderá acessar.</p>
                    <div class="row">
                        <?php foreach ($funcionalidades as $key => $item): ?>
                            <div class="col-sm-4">
                                <label class="input-group">
                                    <span class="input-group-addon">
                                        <input style="opacity:10; position: initial;" type="checkbox" name="<?php echo $key ?>" <?php echo (in_array($key, $nivel_permissoes) ? 'checked' : '') ?>>
                                    </span>
                                    <p class="form-control"><?php echo $item; ?></p>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="id_nivel" value="<?php echo $id_nivel;?>"/>
                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once(dirname(__FILE__) . '/footer.php'); ?>  