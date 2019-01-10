<?php if (!$this->input->is_ajax_request()) include_once(dirname(__FILE__) . '/header.php'); ?>
<div class="main-panel">
    <div class="row">
        <div class="panel-heading">
            <h2>Alunos Inscritos</h2>
        </div>

        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-striped small">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Módulo</th>
                            <th>Nome</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itens as $row): ?>
                            <tr>
                                <td><?= $row->curso ?></td>
                                <td><?= $row->modulo ?></td>
                                <td><?= $row->nome ?></td>

                                <td class="acoes">
                                        <a class="btn btn-xs btn-info btn btn-info" href="" title="Visulizar este registro" class="btn btn-mini btn-warning"><i class="fa fa-eye"></i>Confirmar Presença</a>
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
