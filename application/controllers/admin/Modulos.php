<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Modulos extends BaseCrud
{
    var $modelname = 'modulos';
    var $base_url = 'admin/modulos';
    var $actions = 'CRUD';
    var $titulo = 'Módulos';
    var $tabela = 'curso,titulo,status';
    var $campos_busca = 'titulo';
    var $acoes_extras = array();
    var $acoes_controller = array();
    var $selects = "modulos.*, cursos.titulo as curso";
    var $joins = array('cursos' => 'cursos.cursos_id=modulos.curso_id'); 
    // var $joins = array('cursos' => 'cursos.cursos_id=modulos.curso_id', 'encontros'=>array('encontros.modulo_id=modulos.modulos_id','left') );
    var $group= array('modulos.modulos_id');


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'modulos';
    }



    public function _pre_form(&$model) 
    {
      
      unset($model->fields['submodulo']);

      $model->fields['curso_id']['type'] = 'hidden';
      $model->fields['curso_id']['label'] = '';
      $model->fields['curso_id']['value'] = $this->uri->segment(4);

    }


    public function _pre_save($data){
        var_dump($data);
        exit();
    }

    

    public function _filter_pre_read(&$data) 
    {
        
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

        $this->model->fields['encontros'] = array(
          'label' => 'Encontros',
          'type' => 'text',
          'class' => '',
        );

        $url = "admin/modulos/novo/". $this->uri->segment(4);
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

        $url = 'admin/modulos/listar/'.$data['curso_id'];

        redirect($url);

    }

    public function return_modulos_by_curso($curso_id){
        $this->load->model('modulos_model','modulos');
        $this->load->model('cursos_model','cursos');



        $where = array('curso_id'=>$curso_id);
        $this->db->select('modulos_id,modulos.titulo,modulos.descricao')
        ->join('cursos','cursos.cursos_id=modulos.curso_id');
        $this->db->order_by("titulo", 'ASC');
        $result = $this->modulos->get_where($where)->result();

        $json = json_encode($result);
        $this->output->set_header('content-type: application/json');
        $this->output->set_output($json);
    }


    public function return_modulos_by_submodulo($submodulo){
        $this->load->model('modulos_model','modulos');

        $where = array('modulos.submodulo'=>$submodulo);
        $this->db->select('modulos.titulo,modulos.modulos_id');
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
