<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<div class="content">
    <div class="row">
        <div class="panel-heading">
            <h2>Meus Agendamentos</h2>
        </div>
       

        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped small">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Turma</th>
                                    <th>Nivel</th>
                                    <th>Módulo</th>
                                    <th>Professor</th>
                                    <th>Data do Curso</th>
                                    <th>Periodo</th>
                                    <th>Sala</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                if(count($itens)>0):

                                    foreach ($itens as $row): 

                                        $agenda_id = $row->agenda_id;
                                        $aluno_id = $row->aluno_id;

                                        
                                        $mesas = '';
                                        foreach ($mesas_ocupadas as $key => $value) {
                                            foreach ($value as $chave => $valor) {
                                                if(!is_null($value[$chave]->mesa)){
                                                    $mesas.= $value[$chave]->mesa.",";
                                                }
                                            }
                                            
                                        }


                                        echo "<script type='text/javascript'>";

                                        echo "var bookedSeats =[". substr($mesas, 0, -1). "];\n";
                                        echo "</script>";
                                        ?>
                                        <tr>
                                            <td><?= $row->status ?></td>
                                            <td><?= $row->turma ?></td>
                                            <td><?= $row->curso ?></td>
                                            <td><?= strip_tags($row->modulo) ?></td>
                                            <td><?= $row->professor ?></td>
                                            <td><?php 
                                            echo  "<input type='radio' checked='checked' class='data_dia' name='data_dia' value='".$row->data."'>".formata_data($row->data);
                                            echo "<br >";
                                            if($row->data_segunda!='0000-00-00'){
                                                echo  "<input type='radio' class='data_dia' name='data_dia' value='".$row->data_segunda."'>".formata_data($row->data_segunda);
                                                echo "<br >";

                                            }
                                            if($row->data_terceira!='0000-00-00'){
                                                echo  "<input type='radio' class='data_dia' name='data_dia' value='".$row->data_terceira."'>".formata_data($row->data_terceira);
                                                echo "<br >";
                                            }
                                            ?>
                                            </td>
                                            
                                            <td><?php $dias = unserialize($row->dias_semana);
                                                $i = 0;
                                                
                                                foreach ($dias as $key => $value) {
                                                    if($i==0){
                                                        echo "<input type='radio' class='dias_semana' checked='checked' name='dias_semana' value='".$value."'>".$value;
                                                        echo "<br />";
                                                    }else{
                                                        echo "<input type='radio' class='dias_semana' name='dias_semana' value='".$value."'>".$value;
                                                        echo "<br />";
                                                    }
                                                    $i++;
                                                    
                                                }
                                            ?></td>
                                            <td><?= $row->sala_id ?></td>
                                            <?php /*?>
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
                                                    
<<<<<<< HEAD
                                                            
                                                        
                                            <?php } ?>
                                            </td>
                                            <?php */?>
                                        </tr>

                                        <?php } ?>
                                        </td>
                                        <?php */?>
                                    </tr>

                                    <?php endforeach; ?>
                                <?php endif;?>
                            </tbody>
                        </table>

                        <?php if(count($itens)>0):?>

                            <div class="col-sm-12">
                                <form id="form1" runat="server">
                                    <h2 style="font-size:1.2em;"> Selecione a mesa:</h2>
                                   <div id="holder"> 
                                        <ul  id="place">
                                        </ul>    
                                    </div>
                                    <div style="width:600px;text-align:center;overflow:auto"> 
          
                                    </div>



                                    <input type="hidden" id="mesa" name="mesa" value="" />
                                    <input type="hidden" id="aluno_id" name="aluno_id" value="<?php echo $aluno_id ?>"/>
                                    <input type="hidden" id="minha_agenda_id" name="agenda_id" value="<?php echo $agenda_id ?>"/>

                                    <input type="hidden" name="mesa" value="" />

                                </form>
                            </div>
                            <?php if($this->session->userdata('admin')->tipo=="aluno"){?>
                                <div style="margin-top:10px;" class="col-sm-12">
                                    <?php 
                                    if(empty($row->presenca)){?>

                                        <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="1" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Presença</a>
                                        <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="2" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Ausencia</a>
                                    <?php }else{?>
                                        <?php if($row->presenca=='sim'):?>
                                            <p><i class="pe-7s-check">Confirmado</i></p>
                                            <p> <a  class="hide btn btn-xs btn-info btn btn-info confirmar_presenca" href="1" title="Editar Presença" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Editar Presença</a></p>

                                        <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="<?php echo $row->agenda_id ?>" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca/<?php echo $row->aluno_id ?>/<?php echo $row->agenda_id ?>/1" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Presença</a>
                                        <a class="btn btn-xs btn-info btn btn-info confirmar_presenca" href="<?php echo $row->agenda_id ?>" title="Visulizar este registro" data-confirm="<?php echo site_url(); ?>/admin/agendamento/checar_presenca/<?php echo $row->aluno_id ?>/<?php echo $row->agenda_id ?>/2" class="btn btn-mini btn-warning confirmar_presenca"><i class="fa fa-eye"></i>Confirmar Ausencia</a>
                                    <?php }else{?>
                                        <?php if($row->presenca=='sim'):?>
                                            <p><i class="pe-7s-check">Presente</i></p>

                                        <?php else:?>
                                             <p><i class="pe-7s-close-circle">Ausente</i></p>
                                        <?php endif;?>
                                    <?php } ?>
                                </div>

                           <?php }?>

                        <?php endif;?>
                    </div>
                </div>
            </div>

            

        </div><!--/panel-body-->
    </div><!--/row-->
</div>
<?php include_once(dirname(__FILE__) . '/footer.php'); ?>  
