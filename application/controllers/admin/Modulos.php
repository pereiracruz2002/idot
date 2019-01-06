<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Modulos extends BaseCrud
{
    var $modelname = 'modulos';
    var $base_url = 'admin/modulos';
    var $actions = 'CRUD';
    var $titulo = 'Módulos';
    var $tabela = 'titulo,status';
    var $campos_busca = 'titulo';
    var $acoes_extras = array(
        array("url" => "admin/modulos/associar_cursos", "title" => "Relacionar com Cursos", "class" => "btn-info"),
    );


    public function __construct() 
    {

        parent::__construct();
        //verify_permiss_redirect('departamentos');
        $this->data['menu_active'] = 'aulas';
    }

    

    public function _filter_pre_read(&$data) 
    {

       

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
