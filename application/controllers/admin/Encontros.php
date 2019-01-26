<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Encontros extends BaseCrud
{
    var $modelname = 'modulos';
    var $base_url = 'admin/encontros';
    var $actions = 'CRUD';
    var $titulo = 'Encontros';
    var $tabela = 'titulo_sub,modulos';
    var $campos_busca = 'titulo';
    var $acoes_controller = array();
    var $acoes_extras = array();
    var $selects = "modulos.*,submodulo.titulo as titulo_sub, cursos.titulo as curso, GROUP_CONCAT(modulos.titulo SEPARATOR ', ') as modulos,GROUP_CONCAT(modulos.modulos_id SEPARATOR ', ') as modulos_ids,GROUP_CONCAT(modulos.status SEPARATOR ', ') as modulos_status";
    var $joins = array('cursos' => 'cursos.cursos_id=modulos.curso_id','submodulo'=>'submodulos_id=modulos.submodulo'); 
    // var $joins = array('cursos' => 'cursos.cursos_id=modulos.curso_id', 'encontros'=>array('encontros.modulo_id=modulos.modulos_id','left') );
    var $group= array('modulos.submodulo');
    //var $acoes_extras = array(array('url'=>'novo','title'=>'Adicionar Encontros','class'=>'btn btn-xs btn-info btn btn-warning'));


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'modulos';
    }



    public function _pre_form(&$model) 
    {

        if($this->uri->segment(5)){

            $this->load->model('modulos_model','modulos');

            $where = array('modulos_id'=>$this->uri->segment(5));
            $this->db->select('submodulo');
            $result = $this->modulos->get_where($where)->row();

            $model->fields['submodulo']['type'] = 'hidden';
            $model->fields['submodulo']['value'] = $result->submodulo;

        }else{
            $this->load->model('submodulo_model','submodulo');
            $where['submodulos_id >'] =0;

            $cursos = $this->submodulo->get_where($where)->result();
        
            foreach ($cursos as $key => $value) {
                $model->fields['submodulo']['values'][$value->submodulos_id] = $value->titulo;
            }  
        }

        
      
      $model->fields['titulo']['label'] = 'Encontros';

      $model->fields['curso_id']['type'] = 'hidden';
      $model->fields['curso_id']['label'] = '';
      $model->fields['curso_id']['value'] = $this->uri->segment(4);

    }

    

    public function _filter_pre_read(&$data) 
    {

        foreach($data as $chave => $campos){
            if(isset($campos->modulos)){
                $modulos_explode = explode(',', $campos->modulos);
                $modulos_ids_explode = explode(',',$data[$chave]->modulos_ids);
                $modulos_status_explode = explode(',',$data[$chave]->modulos_status);
                $string_btn_editar = '<ul class="list-unstyled">';
                foreach($modulos_explode as $chave_explode => $explode){
                    $string_btn_editar.= '<li style="margin-top:5px;">'.$explode.'<a style="margin-left:10px; margin-right:10px;" class="btn btn-xs btn-info btn btn-warning" title="Editar este registro" href="'.site_url().'/admin/encontros/editar/'.$modulos_ids_explode[$chave_explode].'">Editar</a>  <a class="btn btn-xs btn btn-danger delete" href="#" title="Deletar este registro" data-remove="'.site_url().'/admin/encontros/deletar/'.$modulos_ids_explode[$chave_explode].'"><i class="fa fa-times-circle"></i> Deletar</a><span style="margin-left:5px;">'.$modulos_status_explode[$chave_explode].'</span>';
                }

                $string_btn_editar.= '</ul>';


                $data[$chave]->modulos = $string_btn_editar;
               
            }
          
        }

    

        $url = "admin/encontros/novo/". $this->uri->segment(4);
        $this->acoes_extras = array(array('url'=>$url,'title'=>'+ Encontros','class'=>'btn btn-xs btn-info btn btn-info'));
        // $this->db->select('cursos.nivel');
        // $this->load->model('cursos_model','cursos');
        // foreach($data as $d){
        //     $where = array('cursos_id'=>$d->curso_id);
        //     $result = $this->cursos->get_where($where)->row(); 
        //     if($result->nivel==2){
        //         $url = "admin/encontros/novo";
        //         $this->acoes_extras = array(array('url'=>$url,'title'=>'Adicionar Encontros','class'=>'btn btn-xs btn-info btn btn-warning'));
        //     }
        // }
        
      
       

    }

    public function _filter_pre_listar(&$where, &$like) 
    {

        $this->model->fields['curso'] = array(
          'label' => 'Curso',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['titulo_sub'] = array(
          'label' => 'Subnível',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['modulos'] = array(
          'label' => 'Encontros',
          'type' => 'text',
          'class' => '',
        );

        $this->model->fields['encontros'] = array(
          'label' => 'Encontros',
          'type' => 'text',
          'class' => '',
        );

        $url = "admin/encontros/novo/". $this->uri->segment(4);
       $this->acoes_controller = array(array("url" => $url, "title" => "Novo", "class" => "btn-custom"));
        $where['curso_id'] = $this->uri->segment(4);



        $this->db->select('cursos.nivel');
        $this->load->model('cursos_model','cursos');
        $where = array('cursos_id'=>$this->uri->segment(4));
        $result = $this->cursos->get_where($where)->row(); 
        // if($result->nivel==2){
        //     $url = "admin/encontros/listar";
        //     $this->acoes_extras = array(array('url'=>$url,'title'=>'Adicionar Encontros','class'=>'btn btn-xs btn-info btn btn-warning'));
        // }else{
        //     $this->tabela = 'titulo,curso,descricao,status';
        // }
    }

    public function _filter_pos_save($data, $id) 
    {

        $url = 'admin/encontros/listar/'.$data['curso_id'];

        redirect($url);

    }

    public function return_modulos_by_curso($curso_id){
        $this->load->model('modulos_model','modulos');

        $where = array('curso_id'=>$curso_id);
        $this->db->select('modulos_id, titulo');
        $this->db->order_by("titulo", 'ASC');
        $result = $this->modulos->get_where($where)->result();
        $json = json_encode($result);
        $this->output->set_header('content-type: application/json');
        $this->output->set_output($json);
    }



    public function associar_cursos($modulo_id, $ok=false){
        $this->load->model('cursos_model','cursos');
        $this->load->model('modulo_cursos_model','modulo_curso');

        $where['modulo_id'] = $modulo_id;

        $this->data['permissoes'] = array();
        $this->db->select('cursos.*');
        $this->db->join('cursos','cursos.cursos_id=modulo_cursos.curso_id');
        $permissoes = $this->modulo_curso->get_where($where)->result();
        foreach ($permissoes as $item) {
            $this->data['permissoes'][] = $item->cursos_id;
        }
   
        $this->data['modulo_id'] = $modulo_id;
        unset($where['modulo_id']);
        $this->data['cursos'] = $this->cursos->get_where($where)->result();

        $this->load->view('admin/associar_cursos',$this->data);
    }

    public function add_cursos(){
        $this->load->model('modulo_cursos_model','modulo_cursos');

        if($this->input->posts()){
            $nivel_permissoes = $save_depto = array();
            $modulo_id = $this->input->post('modulo_id');
            $this->db->delete('modulo_cursos', array('modulo_id' => $modulo_id));


           
            if($this->input->post('cursos') and !empty($this->input->post('cursos'))){
                foreach ($this->input->post('cursos') as $curso) {
                    $save_cursos[] = array('curso_id' => $curso, 'modulo_id' => $modulo_id);
                }
            }
            
            if($save_cursos){
                $this->db->insert_batch('modulo_cursos', $save_cursos);
            }
        }
        redirect('admin/modulos/associar_cursos/'.$modulo_id.'/ok');
    }

}
