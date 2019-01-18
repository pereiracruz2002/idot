<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<div class="content">
    <div class="row">
        <div class="panel-heading">
            <h2>Cursos 
                
                    <a href="/admin/cursos/novo" class="btn btn-primary"><span>Novo</span></a>
                
                
            </h2>
        </div>

        <div class="panel-body">
            
                <div class="well">
                    <form method="post" class="form-inline filtro" action="/admin/cursos/listar">
                        <fieldset>
                            <legend>Buscar</legend>
                            <input name="" type="text" value="" placeholder="" class="form-control input-sm" />
                            
                            <input type="submit" value="Procurar" class="btn btn-sm btn-primary" />
                        </fieldset>
                    </form>
                </div>
            

            <?php if (!$itens): ?>
                <div class="alert alert-danger">Nenhum registro encontrado</div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-striped small">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Stautus</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itens as $campo): ?>
                            <tr>
                                <td class=""><?php echo $campo->titulo ?></td>
                                <td class=""><?php echo $campo->status ?></td>
                                <td class="acoes">
                                    
                                        <a class="btn btn-xs btn-info btn btn-warning" href="/admin/cursos/editar/<?= $campo->cursos_id?>" title="Editar este registro" class="btn btn-mini btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                   
                                        <a class="btn btn-xs btn btn-danger delete" href="#" data-remove="/admin/cursos/deletar/<?= $campo->cursos_id?>" title="Deletar este registro"><i class="fa fa-times-circle"></i> Deletar</a>
                                        <?php
                                        if($campo->nivel==2):?>

                                            <a href="/admin/encontros/listar/<?= $campo->cursos_id?>" class="btn btn-xs btn-info btn btn-warning" >Adicionar Encontros</a>
                                        
                                        <?php else:?>
                                            <a href="/admin/modulos/listar/<?= $campo->cursos_id?>" class="btn btn-xs btn-info btn btn-warning" >Adicionar Módulos</a>
                                        <?php endif;?>
                                   
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            
        </div><!--/panel-body-->
    </div><!--/row-->
</div>
<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/footer.php'); ?>
