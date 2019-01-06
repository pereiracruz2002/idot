<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('BaseCrud.php');
class Aulas extends BaseCrud
{
    var $modelname = 'aulas';
    var $base_url = 'admin/aulas';
    var $actions = 'CRUD';
    var $titulo = 'Aulas';
    var $tabela = 'titulo,status';
    var $campos_busca = 'titulo';
    var $acoes_extras = array(
        array("url" => "admin/aulas/associar_modulos", "title" => "Relacionar com Módulos", "class" => "btn-info"),
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

    

    
    public function _filter_pre_delete($id) 
    {
        $where['empresa_id'] = $this->session->userdata('admin')->empresa_id;
        $user = $this->model->get_where($where)->row();
        if($user){
            return true;
        } else {
            return false;
        }
    }

    public function _filter_pos_save($data, $id) 
    {
        

    }

	public function associar_modulos($aula_id, $ok=false){
        $this->load->model('modulos_model','modulos');
        $this->load->model('aula_modulos_model','aula_modulo');

        $where['aula_id'] = $aula_id;

        $this->data['permissoes'] = array();
        $this->db->select('modulos.*');
        $this->db->join('modulos','modulos.modulos_id=aula_modulos.modulo_id');
        $permissoes = $this->aula_modulo->get_where($where)->result();
        foreach ($permissoes as $item) {
            $this->data['permissoes'][] = $item->modulos_id;
        }
   
        $this->data['aula_id'] = $aula_id;
        unset($where['aula_id']);
        $this->data['modulos'] = $this->modulos->get_where($where)->result();

        $this->load->view('admin/associar_modulos',$this->data);
    }

    public function add_modulos(){
        $this->load->model('aula_modulos_model','aula_modulos');

        if($this->input->posts()){
            $nivel_permissoes = $save_depto = array();
            $aula_id = $this->input->post('aula_id');
            $this->db->delete('aula_modulos', array('aula_id' => $aula_id));


           
            if($this->input->post('modulos') and !empty($this->input->post('modulos'))){
                foreach ($this->input->post('modulos') as $modulo) {
                    $save_modulos[] = array('modulo_id' => $modulo, 'aula_id' => $aula_id);
                }
            }
            
            if($save_modulos){
                $this->db->insert_batch('aula_modulos', $save_modulos);
            }
        }
        redirect('admin/aulas/associar_modulos/'.$aula_id.'/ok');
    }


}
