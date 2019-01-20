<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<div class="content">
    <div class="row">
        <div class="panel-heading">
            <h2>Meus Agendamentos</h2>
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
                            <th>Tipo Aula</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($itens as $row): ?>
                            <tr>
                                <td><?= $row->nome ?></td>
                                <td><?= $row->curso ?></td>
                                <td><?= $row->modulo ?></td>
                                <td><?= formata_data($row->data) ?></td>
                                <td><?= $row->tipo ?></td>
                                <td class="acoes">
                                    <?php 
                                    if($this->session->userdata('admin')->tipo=="professor"){
                                        if(empty($row->presenca)){
                                        ?>
                                            <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="<?php echo $row->agenda_id ?>" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca/<?php echo $row->aluno_id ?>/<?php echo $row->agenda_id ?>/1" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Presença</a>
                                            <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="<?php echo $row->agenda_id ?>" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca/<?php echo $row->aluno_id ?>/<?php echo $row->agenda_id ?>/2" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Ausencia</a>
                                        <?php }else{?>
                                            <?php if($row->presenca=='sim'):?>
                                                <p><i class="pe-7s-check">Presente</i></p>
                                            <?php else:?>
                                                 <p><i class="pe-7s-close-circle">Ausente</i></p>
                                            <?php endif;?>
                                        <?php } ?>
                                    <?php }else{ 
                                        
                                            if(!is_null($row->presenca)){

                                                    if($row->presenca=='sim'):?>
                                                    <p><i class="pe-7s-check">Presente</i></p>
                                                  <?php else:?>
                                                    <p><i class="pe-7s-close-circle">Ausente</i></p>
                                                  <?php endif; ?>
                                            <?php }else{ ?>
                                                <?php if($row->tipo=='confirmar'):?>
                                                    <?php if($aulas[$row->modulos_id]=='sim'):?>
                                                        <a class="btn btn-xs btn-info btn btn-info confirmar" href="<?php echo site_url(); ?>/admin/agendamento/reagendamento/<?php echo $row->presenca_id ?>/revisao" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/reagendamento/<?php echo $row->presenca_id ?>/reposicao"><i class="fa fa-eye"></i>Confirmar Revisao</a>
                                                    <?php else: ?>
                                                        <a class="btn btn-xs btn-info btn btn-info confirmar" href="<?php echo site_url(); ?>/admin/agendamento/reagendamento/<?php echo $row->presenca_id ?>/reposicao" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/reagendamento/<?php echo $row->presenca_id ?>/revisao"><i class="fa fa-eye"></i>Confirmar Reposicao</a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php }?>
                                        
                                                
                                            
                                <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><!--/panel-body-->
    </div><!--/row-->
</div>
<?php include_once(dirname(__FILE__) . '/footer.php'); ?>  
