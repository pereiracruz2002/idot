<?php
include("BaseCrud.php");

class Aula extends BaseCrud {

  var $modelname = 'aula'; //Nome da model sem o "_model"
  var $titulo = 'Aula';
  var $campos_busca = 'nome_aula,mediasite_experience_id,id_curso'; //Campos para filtragem
  var $base_url = 'aula';
  var $actions = 'CRUD';// C: CREATE; R:READ; U:UPDATE; D:DELETE
  var $delete_fields = '';
  var $tabela = 'id_aula,nome_aula,mediasite_experience_id'; //Campos que aparecerão na tabela de listagem  
  var $order = array('aula.nome_aula' => 'asc');
	var $acoes_extras = array(0 => array("url" => "aula/online", "title" => "Dados Online", "class" => "logado"),1 => array("url" => "aula/visualizar_acesso", "title" => "Visualizar Acesso", "class" => "visualizar"));
  
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('operador')){
        redirect('meu-painel-wvtodoz');
    }
	}

  public function _filter_pre_save(&$data) 
  {
    if($data['versao_mediasite'] == 6){
      $data['mediasite6_presentation'] = $data['mediasite_experience_id'];
      $data['mediasite6_folder'] = $data['mediasite_folder_id'];
      unset($data['mediasite_folder_id']);
      unset($data['mediasite_experience_id']);
    }
    unset($data['versao_mediasite']);
  }
	
	public function _filter_pre_listar(&$where){
	  if($this->input->post('id_curso')){
	  	$this->joins = array("curso_mod_aula" => array("curso_mod_aula.id_aula=aula.id_aula", "left"),
	                       "modulo" => array("modulo.id_modulo=curso_mod_aula.id_modulo", "left")
	                      );
	  
			$this->group = array("aula.id_aula");
	  }
		
	  if(isset($where['id_curso'])){
	    $where["modulo.id_curso"] = $where['id_curso'];
	    unset($where['id_curso']);
	  }
	  
    $this->model->fields['id_aula'] = array("type" => "text",
                                            "label" => "Id",
                                            "class" => "",
                                            "value" => $this->input->post('id_aula')
                                            );
	  $this->model->fields['id_curso'] = array("type" => "select",
                                            "label" => "Cursos",
                                            "class" => "listagem_cursos ",
                                            "value" => $this->input->post('id_curso'),
                                            "values" => array(),
                                            "empty" => "--Todos--",
                                            "from" => array("model" => "curso", "value" => "nome")
                                            );
	}
	
	public function ajaxFly(){
	  $this->load->model('aula_model');
	  $dados = $this->input->posts();
    $this->aula_model->save($dados);
    print $this->input->post('nome_aula');
	}

  public function _call_pos_form() {
    if($this->uri->segment(2) == "editar")
      print '<p class="clear"><a href="'.site_url("materiais/admin_downloads/".$this->uri->segment(3)).'" class="colorbox">Materiais para Download</a></p>';
      print '<p class="clear"><a href="'.site_url("professor/relacionar/".$this->uri->segment(3)).'" class="colorbox">Adicionar Professores</a></p>';
  }

  	function testaConexao(){

  		try{
  			if(@$link = mysql_connect('38.103.150.135', 'peak43', ''))
  				return TRUE;
  	    	else
  				throw new Exception ("Falha");
  		}catch(Exception $e ){
    		return FALSE;
		}
  	}
  
  function _pre_form(&$data){
    if($this->uri->segment(2) == 'editar' and $this->valores['mediasite_experience_id']){
      $this->load->model('mediasite_model','mediasite');
    }else{
      $this->load->model('mediasitev6_model', 'mediasite');
    }
    $pastas = $this->mediasite->get_mediasite_folders();
    foreach ($pastas as $item) 
      $data->fields['mediasite_folder_id']['values'][$item->id] = utf8_encode($item->name);
	}

  function _filter_pre_form(&$data){
    if($this->uri->segment(2) == 'editar'){
      $this->valores = $data[0]['values'];
      $data[0]['values']['start_datetime'] = formatar_time($data[0]['values']['start_datetime']);
      $data[0]['values']['carga_horaria_aula'] = time2human($data[0]['values']['carga_horaria_aula'], true);
      $data[0]['values']['versao_mediasite'] = $data[0]['values']['mediasite_experience_id'] ? 4 : 6;
      if($data[0]['values']['versao_mediasite'] == 6){
        $data[0]['values']['mediasite_experience_id'] = $data[0]['values']['mediasite6_presentation'];
        $data[0]['values']['mediasite_folder_id'] = $data[0]['values']['mediasite6_folder'];
      }
    }
  	
  }

	
	function online($id_aula){
		$this->load->helper('directory');
		$this->load->helper('file');

		$mapa = directory_map(FCPATH.'/tmp/aulas/');

		$data['online'] = array();
		foreach($mapa as $linha){

			$array_arq = explode("-",$linha);
			if($array_arq[0] == $id_aula){
				$string = read_file(FCPATH.'/tmp/aulas/'.$linha);
				$serial = unserialize($string);
				$data['online'][$serial['nome']]=$serial;
			}
			
				

		}
		ksort($data['online']);
	  $this->load->view('admin/cursos/lista_online', $data);
		
	}
	
	
	function atualiza_online($id_aula){
		$this->load->helper('directory');
		$this->load->helper('file');
	 
		$mapa = directory_map(FCPATH.'/tmp/aulas/');
		$data['online'] = array();
		$expiracao = date("His", mktime(date("H"), date("i"), date("s")-20, date("m")  , date("d"), date("Y")));
		foreach($mapa as $linha){
			$array_arq = explode("-",$linha);
			

			if(substr($linha, -6)< $expiracao){
				$dados_txt = read_file(FCPATH.'/tmp/aulas/'.$linha);
				$txt_serial = unserialize($dados_txt);
				$data_saida = $array_arq[2];
				$hora_saida = $array_arq[3];
				$ano = substr($data_saida,0,4);
				$mes = substr($data_saida,4,2);
				$dia = substr($data_saida,6,2);
				
				$hora = substr($hora_saida,0,2);
				$min = substr($hora_saida,2,2);
				$sec = substr($hora_saida,4,2);
				
				$data_final = $ano."-".$mes."-".$dia." ".$hora.":".$min.":".$sec;
				
				$id_dados_aula = $txt_serial['id_dados_aula'];

				$this->db->set("data_saida",$data_final)
              ->where("id_dados_aula",$id_dados_aula)
              ->update("dados_aula");
				if(file_exists(FCPATH."tmp/aulas/".$linha))
					unlink(FCPATH."tmp/aulas/".$linha);
			}
			if($array_arq[0] ==$id_aula){
				$string = read_file('./tmp/aulas/'.$linha);
				$serial = unserialize($string);
				$data['online'][$serial['nome']]=$serial;
			}	
			
		}

		ksort($data['online']);
		$this->load->view('admin/cursos/lista_aulas_online', $data);
	}
	
	function visualizar_acesso($id_aula){
		$this->load->model('dados_aula_model','dados_aula');
		$this->db->join("cliente","cliente.id_cliente=dados_aula.id_cliente");
		$data['dados_aula'] = $this->dados_aula->get_where(array('dados_aula.id_aula' => $id_aula))->result();
		$this->load->view('admin/cursos/visualiza_acesso_aula', $data);
	}
}
