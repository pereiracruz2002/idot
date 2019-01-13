<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<div class="content">
    <div class="row">
        <div class="panel-heading">
            <h2>Alunos Inscritos</h2>
        </div>

        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-striped small">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>Módulo</th>
                            <th>Data</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itens as $row): ?>
                            <tr>
                                <td><?= $row->nome ?></td>
                                <td><?= $row->curso ?></td>
                                <td><?= $row->modulo ?></td>
                                <td><?= formata_data($row->data) ?></td>

                                <td class="acoes">
                                    <?php if(is_null($row->presenca_id)):?>
                                        <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="<?php echo $row->agenda_id ?>" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca/<?php echo $row->aluno_id ?>/<?php echo $row->agenda_id ?>" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Presença</a>
                                    <?php else:?>
                                        <p><i class="fa fa-eye"></i>Presente</p>
                                        
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
<?php include_once(dirname(__FILE__) . '/footer.php'); ?>  
