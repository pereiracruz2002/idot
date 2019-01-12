<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<div class="content">
    <div class="row">
        <div class="panel-heading">
            <h3 class="headline m-top-md"><a href="<?php echo site_url($this->base_url.'/listar') ?>" class="btn btn-warning btn-sm">Voltar</a> Associar Módulos<span class="line"></span></h3>
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success ?></div>
            <?php endif; ?>
        </div>
        <div class="panel table-responsive">
            <div class="panel-body">
                <form action="<?php echo site_url(); ?>/admin/aulas/add_modulos" method="post" class="form-horizontal no-margin form-border" enctype="multipart/form-data">
                    <h3>Associar Módulos</h3> 
                    <p>Associe os módulos que esta aula será associado.</p>
                    <div class="row">
                        <?php foreach ($modulos as $item): ?>
                            <div class="col-sm-4">
                                <label class="input-group">
                                    <span class="input-group-addon">
                                        <input style="opacity:10; position: initial;" type="checkbox" name="modulos[]" value="<?php echo $item->modulos_id ?>" <?php echo (in_array($item->modulos_id, $permissoes) ? 'checked' : '') ?>>
                                    </span>
                                    <p class="form-control"><?php echo $item->titulo ?></p>
                                </label>
                            </div>
                            
                        <?php endforeach; ?>                       
                    </div>
                    <input type="hidden" name="aula_id" value="<?php echo $aula_id;?>"/>
                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once(dirname(__FILE__) . '/footer.php'); ?>  