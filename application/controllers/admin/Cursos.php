<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cursos 
 * 
 * @uses Controller
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Denis Akao e Caroline - W.V. Comunicação
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 * 
 * Atenção Métodos do frontend (categoria, detalhes)
 */
class Cursos extends CI_Controller{
  
  var $upload;
  var $download;

  function __construct () 
  {
    parent::__construct();
    $this->load->model('curso_model', 'model');
		$this->load->model('modulo_model', 'modulo'); 
  }

  public function detalhes($permalink){

    $this->load->model('parceiro_model', 'parceiros');
    $this->load->model('curso_depoimentos_model', 'depoimentos');
		$consulta_curso = $this->model->detalhes($permalink);
		if(!$consulta_curso){
		  redirect('/');
		}

    $this->data['curso'] = $consulta_curso;
    $this->data['titulo'] = strip_tags($consulta_curso->nome);
    $this->data['description'] = $consulta_curso->seo_description;
    $this->data['keywords'] = $consulta_curso->seo_keywords;

    //Numero de modulos/aulas por paginas
    $this->data['per_page'] = 10;
	  
    if(isset($consulta_curso->id_curso)){
      $this->data['modulo'] = $this->modulo->consulta_curso_tipo_modulo($consulta_curso->id_curso);
			
			$curso_integral = $this->modulo->consulta_curso_modulo($consulta_curso->id_curso, "Integral");
			$curso_modular = $this->modulo->consulta_curso_modulo($consulta_curso->id_curso, "Modular");
			$curso_diario = $this->modulo->consulta_curso_modulo($consulta_curso->id_curso, "Diario");
			$curso_gratis = $this->modulo->consulta_curso_modulo($consulta_curso->id_curso, "Gratis");
			
			if($curso_gratis and !$curso_integral){
			  $curso_integral = $curso_gratis;
			  
			  foreach($this->data['modulo'] as $key => $val)
			    if($val->tipo == 'Gratis')
			      unset($this->data['modulo'][$key]);
			  
			}
			
      $this->data['modular'] = $curso_modular;
      $this->data['diario'] = $curso_diario;
      if($curso_integral){
        $this->data['integral'] = $curso_integral;
			  $this->data['professor'] = $this->modulo->consulta_professor($curso_integral[0]->id_modulo);
      }elseif($curso_modular){
			  $this->data['professor'] = $this->modulo->consulta_professor($curso_modular[0]->id_modulo);
      }else{
			  $this->data['professor'] = $this->modulo->consulta_professor($curso_diario[0]->id_modulo);
      }
    }
    $this->data['conteudo_class'] = "curso_detalhes";
    
    $this->data['depoimentos'] = $this->depoimentos->get_where(array("id_curso" => $consulta_curso->id_curso))->result();
    $where_banner['banner.ativo'] = 1;
    $this->data['banners'] = $this->banner->get_where($where_banner)->result();

    $this->data['cursos_relacionados'] = $this->model->cursosRelacionados($consulta_curso->id_curso);
    
    $this->load->view('cursos/detalhes', $this->data);
  }
	 
	function modulo($permalink){
		$where['permalink'] = $permalink;
		$this->data['modulo'] = $this->modulo->get_where($where)->row();
		$this->load->view('cursos/detalhes_modulo', $this->data);
	}

  public function extensao() 
  {
    $this->titulo = 'Extensão';
    $where['categoria.id_categoria <>'] = 2;
    $where['categoria.parent <>'] = 2;
    $this->categoria(false, $where);
  }

  public function categoria($permalink=false, $where=array()){
    //$this->load->model('parceiro_model', 'parceiros');
    $this->load->library('lib_curso');
    $config['num_links'] = 3;
    $config['per_page'] = 20;

    if(!is_array($where))
      $where = array();
    
    if(is_numeric($permalink)){
      $this->titulo = 'Extensão';
      $where['categoria.id_categoria <>'] = 2;
      $where['categoria.parent <>'] = 2;

      $config['base_url'] = site_url("cursos/categoria");
      $config['uri_segment'] = 3;
    }else{
      $config['base_url'] = site_url("cursos/categoria/{$permalink}");
      $config['uri_segment'] = 4;
    }


    if($permalink and !is_numeric($permalink))
      $where['categoria.permalink'] = $permalink;

    if($this->input->posts()){
      foreach ($this->input->posts() as $key => $value) 
        if($value)
          $where[$key] = "$value"; 
    }
		
		$group= array("curso.id_curso");  
    $where['curso.ativo'] = 1;
    $where['modulo.ativo'] = 1;
    $where['curso.em_breve'] = 0;
    //$where['modulo.tipo_modulo'] = "Integral";
    $select = "curso.id_curso,
               categoria.nome as categoria,
               categoria.permalink as categoria_permalink,
               curso.permalink as permalink,
               curso.nome as nome,
               curso.imagem as imagem,
							 curso.em_breve as em_breve,
							 curso.seo_description as seo_description,
               modulo.tipo_modulo as tipo_modulo,
               modulo.valor as valor,
               ";
    $join = array(
      "categoria_curso" => "categoria_curso.id_curso=curso.id_curso",
      "categoria" => "categoria_curso.id_categoria=categoria.id_categoria",
      "modulo" => "modulo.id_curso=curso.id_curso",
    );
		
    $order = array(
                  "curso.sort" => "asc",
                  "modulo.tipo_modulo" => "Integral",
                  "modulo.tipo_modulo" => "Modular",
                  "modulo.tipo_modulo" => "Diario",
                  "curso.".$this->model->id_col => "desc",
                  );
		$like = array('curso.exibir' => 'peak');
    $results = $this->model->search($like, $this->uri->segment($config['uri_segment']), $config['per_page'], $select, $join, $where, $order, $group, true);
		//print('<pre>'.print_r($this->db->last_query(),true).'</pre>');

    $config['total_rows'] = $results['total_rows'];
    $this->data['total'] = $results['total_rows'];
    $this->data['itens'] = $results['resultados'];

    $this->load->library('pagination');
    $this->pagination->initialize($config);
    $this->data['paginacao'] = $this->pagination->create_links();

    $this->model->fields['nome']['class'] = "";
    $this->data['form'] = $this->model->form('nome');
    if($results['total_rows'] > 0)
      $this->data['titulo'] = "{$results['resultados'][0]->categoria}";
    else
      $this->data['titulo'] = "Nenhum curso encontrado";

    if(isset($this->titulo))
      $this->data['titulo'] = $this->titulo;
    
    $this->data['menu_direita'] = true;
    $this->data['conteudo_class'] = "conteudo_index";
    $this->data['vendidos'] = $this->lib_curso->mais_vendidos(4, $this->uri->segment(3));
    $where_banner['banner.ativo'] = 1;
    $this->data['banners'] = $this->banner->get_where($where_banner)->result();
    $this->load->view('cursos/categorias', $this->data);
  }

  public function index (){
    if($this->session->userdata('id_admin'))
      $this->admin_listar();
    else
      $this->categoria();
  }

  public function excluir($id_curso) {
    if(!$this->session->userdata('id_admin'))
      redirect("/");

    $dados['id_curso'] = $id_curso;
    $dados['ativo'] = 0;
    $this->model->save($dados);
    print "ok";
  }

	public function admin_listar(){	
	  if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $config['base_url'] = site_url("cursos/admin_listar/");
    $config['uri_segment'] = 3;
    $config['per_page'] = 100;

    $where = array('ativo' => 1);
    $busca = $this->input->posts();
    if(!is_numeric($this->uri->segment(3)) and $this->uri->segment(3) != ""){
      $query = base64_decode($this->uri->segment(3));
      $termos = explode("&", $query);
      foreach ($termos as $item) {
        $termo = explode("=", $item);
        $busca[$termo[0]] = $termo[1];
      }
    }

    if(count($busca) > 0){
      foreach ($busca as $key => $value) {
        if($value){
          $where[$key] = $value; 
          $this->model->fields[$key]['value'] = $value;
        }
      }
      $params = url_title(base64_encode(http_build_query($where)));
      $config['base_url'] = site_url("cursos/admin_listar/{$params}");
      $config['uri_segment'] = 4;
    }
    $order = array("curso.nome" => "asc");
    $results = $this->model->search($where, $this->uri->segment($config['uri_segment']), $config['per_page'], "*", false,"", $order);

    $config['total_rows'] = $results['total_rows'];
    $data['total'] = $results['total_rows'];
    $data['itens'] = $results['resultados'];

    $this->load->library('pagination');
    $this->pagination->initialize($config);
    $data['paginacao'] = $this->pagination->create_links();

    $this->model->fields['nome']['class'] = "";
    $this->model->fields['permalink']['class'] = "";
    $this->model->fields['id_curso'] = array("type" => "text", "label" => "Id");
    $data['form'] = $this->model->form('id_curso', 'nome', 'permalink');
    $data['titulo'] = "Informações do curso";

	  $this->load->view('admin/cursos/lista', $data);
	}
	
	public function lista_inativos(){	
	  if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $config['base_url'] = site_url("cursos/lista_inativos/");
    $config['uri_segment'] = 3;
    $config['per_page'] = 100;

    $where = array('ativo' => 0);
    $busca = $this->input->posts();
    if(!is_numeric($this->uri->segment(3)) and $this->uri->segment(3) != ""){
      $query = base64_decode($this->uri->segment(3));
      $termos = explode("&", $query);
      foreach ($termos as $item) {
        $termo = explode("=", $item);
        $busca[$termo[0]] = $termo[1];
      }
    }

    if(count($busca) > 0){
      foreach ($busca as $key => $value) {
        if($value){
          $where[$key] = $value; 
          $this->model->fields[$key]['value'] = $value;
        }
      }
      $params = url_title(base64_encode(http_build_query($where)));
      $config['base_url'] = site_url("cursos/lista_inativos/{$params}");
      $config['uri_segment'] = 4;
    }
    $order = array("curso.nome" => "asc");
    $results = $this->model->search($where, $this->uri->segment($config['uri_segment']), $config['per_page'], "*", false,"", $order);

    $config['total_rows'] = $results['total_rows'];
    $data['total'] = $results['total_rows'];
    $data['itens'] = $results['resultados'];

    $this->load->library('pagination');
    $this->pagination->initialize($config);
    $data['paginacao'] = $this->pagination->create_links();

    $this->model->fields['nome']['class'] = "";
    $this->model->fields['permalink']['class'] = "";
    $this->model->fields['id_curso'] = array("type" => "text", "label" => "Id");
    $data['form'] = $this->model->form('id_curso', 'nome', 'permalink');
    $data['titulo'] = "Informações do curso";

	  $this->load->view('admin/cursos/lista_inativos', $data);
	}
	
	public function restaurar_curso($id_curso) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
		
		$this->load->model('modulo_model', 'modulo');
		$this->load->model('curso_model', 'curso');
		$curso = $this->curso->get_where(array("id_curso" => $id_curso))->result();															
		
			if($curso[0]->ativo==0){
				$this->db->set("ativo", 1);
				$this->db->where(array("id_curso" => $id_curso));
				$this->db->update($this->curso->table);
			}
		redirect("cursos/lista_inativos");
	}
	
	public function admin_editar($id_curso) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    if($this->uri->segment(4))
      $data['msg'] = "Cadastro Efetuado com sucesso";
    
    if($this->input->post('nome'))
      $this->_save($id_curso);

    $curso = $this->model->get($id_curso)->row();

    if($curso->versao_mediasite == 4){
      $this->load->model('mediasite_model', 'mediasite');
    }else{
      $this->load->model('mediasitev6_model', 'mediasite');
    }
    $pastas = $this->mediasite->get_mediasite_folders();
    foreach ($pastas as $item) 
      $this->model->fields['mediasite_folder_id']['values'][$item->id] = utf8_encode($item->name);
   
    $this->load->model('aula_model', 'aulas');
    $this->db->order_by("nome_aula", "asc");
    if($curso->versao_mediasite == 4){
      $aulas = $this->aulas->get_where(array("mediasite_folder_id" => $curso->mediasite_folder_id))->result();
      foreach ($aulas as $item) 
        $this->model->fields['demonstracao']['values'][$item->mediasite_experience_id] = $item->nome_aula;
    }else{
      $aulas = $this->aulas->get_where(array("mediasite6_folder" => $curso->mediasite_folder_id))->result();
      foreach ($aulas as $item) 
        $this->model->fields['demonstracao']['values'][$item->mediasite6_presentation] = $item->nome_aula;
    }

  
    foreach($this->model->fields as $key => $value){
      $this->model->fields[$key]['value'] = $curso->{$key};
      if($key == "valor")
        $this->model->fields[$key]['value'] = formata_valor($curso->{$key});
    }
    
    $this->model->fields['sinopse']['class'] = "edit_sinopse";

    $form = $this->model->form();
		$form .=  "<img src='".base_url()."/imagens/cursos/".$curso->imagem."' class='edit_img'/>";
		$data['form'] = $form;
		
    $data['titulo'] = "Informações do curso";
    $this->load->view('admin/cursos/cadastro', $data);
  }

  public function getFoldersV6() {
    $this->load->model('mediasitev6_model');
    $pastas = $this->mediasitev6_model->getFolders();
    $this->output->set_content_type('application/json')
                 ->set_output(json_encode($pastas));
  }
  
  public function getFoldersV4() {
    $this->load->model('mediasite_model', 'mediasite');
    $pastas = $this->mediasite->get_mediasite_folders();
    $this->output->set_content_type('application/json')
                 ->set_output(json_encode($pastas));
  }


  private function _save($id_curso=false){
    $this->form_validation->set_rules('imagem', 'Imagem', 'callback_upload_check');
    if($this->model->validar()){
      foreach($this->input->posts() as $key => $value){
        $dados[$key] = $value;
        if($key == "valor"){
          $dados[$key] = formata_valor($value);
        }
      }
      if($id_curso)
        $dados['id_curso'] = $id_curso;

      if($this->upload)
        $dados['imagem'] = $this->upload;
      
      $this->model->save($dados);
      return true;
    }else{
      return false;
    }
  }

  public function admin_cadastrar($id_curso=false){
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    if($id_curso)
      $this->admin_editar($id_curso);

    $this->load->model('mediasitev6_model', 'mediasite');
    $pastas = $this->mediasite->get_mediasite_folders();

    foreach ($pastas as $item)
      $this->model->fields['mediasite_folder_id']['values'][$item->id] = utf8_encode($item->name);


    if($this->input->post('nome')){
      if($this->_save()){
        $id_curso = $this->db->insert_id();
        $this->load->model('modulo_model', 'modulo');
        $integral['id_curso'] = $id_curso;
        $integral['nome'] = "Curso Completo";
        $integral['tipo_modulo'] = "Integral";
				$integral['em_breve'] = $this->input->post('em_breve');
        $this->modulo->save($integral);
        redirect("cursos/admin_editar/{$id_curso}/0");
      }
      foreach ($this->input->posts() as $key => $value) 
        $this->model->fields[$key]['value'] = $value;
    }
    $data['form'] = $this->model->form();
    $data['titulo'] = "Informações do curso";
    $this->load->view('admin/cursos/cadastro', $data);
  }

  public function permalink_check($str){
    $permalink = $this->model->get_where(array("permalink" => $str, "ativo" => 1, "id_curso <>" => $this->uri->segment(3)))->num_rows();
    if($permalink > 0){
  		$this->form_validation->set_message('permalink_check', "Esse permalink já existe, por favor escolha outro");
			return false;
    }else{
      return true;
    }
  }

  public function upload_check(){
    $config['upload_path'] = FCPATH.'imagens/cursos/';
    $config['allowed_types'] = '*';
    $config['max_size'] = '10000';
    $config['max_width'] = '6400';
    $config['max_height'] = '4800';
    if($_FILES['imagem']['name']){
      $this->load->library('upload', $config);
      if(!$this->upload->do_upload('imagem')){
        $this->form_validation->set_message('upload_check', $this->upload->display_errors());
        return false;
      }else{
        $data = $this->upload->data();
        $this->upload = $data['file_name'];
        return true;
      }
    }
  }

  public function admin_modulos($id_curso) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('modulo_model', 'modulos');
    if($this->input->post('ajaxFly')){
      if($this->input->post('campo') == "carga_horaria")
        $dados[$this->input->post('campo')] = human2time($this->input->post('valor'));
      else
        $dados[$this->input->post('campo')] = $this->input->post('valor');
      
      $dados['id_modulo'] = $this->input->post('id_col_val');
      $this->modulos->save($dados);
      if(is_array($this->input->post('valor')))
        die(join(",", $this->input->post('valor')));
      else{
        if($this->input->post('campo') == "em_breve"){
          die(tipo_publicacao($this->input->post('valor')));
        }
        die($this->input->post('valor'));
      }
    }
    if($this->input->post('nome')){
      if($this->modulos->validar()){
        $this->modulos->save($this->input->posts(array('id_curso' => $id_curso)));
      }
    }
    $where['ativo'] = 1;
    $where['id_curso'] = $id_curso;
    
    $data['modulos'] = $this->modulos->get_where($where)->result();
    $data['form'] = $this->modulos->form();
    $data['forma_pagto'] = $this->modulos->fields['forma_pagto']['values'];
    $data['titulo'] = "Módulos";
    $this->load->view('admin/cursos/modulos', $data);
  }

  public function admin_remover_modulo($id_modulo){
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('modulo_model', 'modulo');
    $this->load->model('pedido_curso_model', 'pedido_curso');
    $this->load->model('pedido_curso_aula_model', 'pedido_curso_aula');
    $dados['id_modulo'] = $id_modulo;
    $dados['ativo'] = 0;
    $this->modulo->save($dados);
    
    $this->db->select("
      pedido_curso.id_pedido_curso,
      pedido_curso_aula.id_pedido_curso_aula,
    ");
    $this->db->join("pedido_curso_aula", "pedido_curso_aula.id_pedido_curso=pedido_curso.id_pedido_curso");
    $pedidos = $this->pedido_curso->get_where(array("pedido_curso.id_modulo" => $id_modulo))->result();
    foreach ($pedidos as $item) {
      //$this->pedido_curso_aula->delete($item->id_pedido_curso_aula);
      $this->pedido_curso->delete($item->id_pedido_curso);
    }
  }

  public function mailing($id_modulo) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('pedido_curso_model', 'pedido_curso');
    $this->load->helper('download');
    $this->load->dbutil();
    $delimiter = ";";
    $newline = "\r\n";

    $this->db->join("pedido", "pedido.id_pedido=pedido_curso.id_pedido");
    $this->db->join("cliente", "cliente.id_cliente=pedido.id_cliente");
    $this->db->select("cliente.nome, cliente.email");
    $this->db->group_by("cliente.id_cliente");
    $where['pedido_curso.id_modulo'] = $id_modulo;
    $where['cliente.receber_news'] = 1;
    $clientes = $this->pedido_curso->get_where($where);
    $data = $this->dbutil->csv_from_result($clientes, $delimiter, $newline);
    force_download('emails.csv', $data);
  }
  
  public function mailing_cuso($id_curso) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('pedido_curso_model', 'pedido_curso');
    $this->load->helper('download');
    $this->load->dbutil();
    $delimiter = ";";
    $newline = "\r\n";

    $this->db->join("pedido", "pedido.id_pedido=pedido_curso.id_pedido");
    $this->db->join("cliente", "cliente.id_cliente=pedido.id_cliente");
    $this->db->select("cliente.nome, cliente.email, cliente.telefone");
    $this->db->group_by("cliente.id_cliente");
    $where['pedido_curso.id_curso'] = $id_curso;
    $where['cliente.receber_news'] = 1;
    $clientes = $this->pedido_curso->get_where($where);
    $data = $this->dbutil->csv_from_result($clientes, $delimiter, $newline);
    force_download('emails.csv', $data);
  }

  public function admin_remover_avaliacao($id_avaliacao){
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('avaliacao_model', 'avaliacao');
    $this->avaliacao->delete($id_avaliacao);
  }

  public function admin_aulas($id_curso){
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('aula_model', 'aula');
    $this->load->model('modulo_model', 'modulos');
    if($this->input->post('id_modulo')){
      $this->load->model('Curso_mod_aula_model', 'curso_mod_aula');
      $this->load->model('pedido_curso_aula_model', 'pedido_curso_aula');
      $this->load->model('pedido_curso_model', 'pedido_curso');
      $this->load->model('aula_model', 'aula');
      $this->load->model('modulo_model', 'modulo');
      switch($this->input->post('acao')){
        case "add":
          foreach ($this->input->post('id_aula') as $item) {
            //Coloca aula no módulo
            $dataSave = array("curso_mod_aula.id_aula" => $item, "curso_mod_aula.id_modulo" => $this->input->post('id_modulo'));
            $existe = $this->curso_mod_aula->get_where($dataSave)->num_rows();
            if($existe == 0){
              $this->curso_mod_aula->save($dataSave);

              //Pega informações da aula
              $aula = $this->aula->get($item)->row();

              //Atualiza Carga horária do módulo
              $this->db->set("carga_horaria", "carga_horaria+{$aula->carga_horaria_aula}", false);
              $this->db->where(array("id_modulo" => $this->input->post('id_modulo')));
              $this->db->update($this->modulos->table);

              //Insere aula para as pessoas que já compraram o módulo
              $modulo = $this->modulo->get($this->input->post('id_modulo'))->row();
              $where['id_modulo'] = $this->input->post('id_modulo');
              $pedidos = $this->pedido_curso->get_where($where)->result();
              foreach ($pedidos as $pedido){
                $novaAula['id_pedido_curso'] = $pedido->id_pedido_curso;
                $novaAula['id_aula'] = $item;
                $novaAula['qtd_acesso'] = $modulo->qtd_acesso;
                $novaAula['dt_expiracao'] =  date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")+$modulo->licenca_uso, date("Y")));
                $this->pedido_curso_aula->save($novaAula);
              }
            }
          }
        break;

        case "remove":
          foreach($this->input->post('id_aula') as $item){
            //Remove aula do módulo
            $dataSave = array("id_aula" => $item, "id_modulo" => $this->input->post('id_modulo'));
            $this->curso_mod_aula->delete($dataSave);
            
            //Retira aula da matéria cadastrada
            $cat['id_aula'] = $item;
            $cat['id_materia'] = 0;

            //Remove aula dos pedidos já efetuados
            $where['pedido_curso.id_modulo'] = $this->input->post('id_modulo');
            $where['pedido_curso_aula.id_aula'] = $item;
            $this->db->join("pedido_curso_aula", "pedido_curso_aula.id_pedido_curso=pedido_curso.id_pedido_curso");
            $pedidos = $this->pedido_curso->get_where($where)->result();

            //Pega informações da aula
            $aula = $this->aula->get($item)->row();

            //Atualiza Carga horária do módulo
            $this->db->set("carga_horaria", "carga_horaria+{$aula->carga_horaria_aula}", false);
            $this->db->where(array("id_modulo" => $this->input->post('id_modulo')));
            $this->db->update($this->modulos->table);


            foreach ($pedidos as $pedido) 
              $this->pedido_curso_aula->delete($pedido->id_pedido_curso_aula);
          
          }
        break;
      }
    }
    $data['titulo'] = "Aulas"; 
    $curso = $this->model->get($id_curso)->row();
    if($curso->versao_mediasite == 4)
      $data['aulas'] = $this->aula->consulta_aula_modulo($curso->mediasite_folder_id);
    else
      $data['aulas'] = $this->aula->consulta_aulaV6_modulo($curso->mediasite_folder_id);
    $modulos = $this->modulos->get_where(array("id_curso" => $id_curso, "ativo" => 1))->result();
    $this->modulos->fields['id_modulo'] = array("label" => "Escolha o módulo", "type" => "select", "class" => "seleciona_modulo", "values" => array("" => "--Selecione o módulo--"));
    foreach ($modulos as $item){
      $this->modulos->fields['id_modulo']['values'][$item->id_modulo] = $item->nome;
    }
    $data['modulos'] = $this->modulos->form('id_modulo');
    $this->load->view('admin/cursos/aulas', $data);
  }

  public function pegarPastasMS($versao) {
    if($versao == 4)
      $this->load->model('mediasite_model','mediasite');
    else
      $this->load->model('mediasitev6_model','mediasite');
    
    $pastas = $this->mediasite->get_mediasite_folders();
    $html = '';
    foreach ($pastas as $item) {
      $html .= '<option value="'.$item->id.'">'.utf8_encode($item->name).'</option>';
    }
    $this->output->set_output($html);
  }

  public function pegarAulas(){      
    if($this->input->post('id_modulo')){
      $this->load->model('Curso_mod_aula_model', 'modulo_aula');
      $this->db->join("aula", "aula.id_aula=curso_mod_aula.id_aula");
      $this->db->order_by("aula.nome_aula", "asc");
      $aulas = $this->modulo_aula->get_where(array("curso_mod_aula.id_modulo" => $this->input->post('id_modulo')))->result();
    }
    if($this->input->post('id_materia')){
      $this->load->model('aula_model', 'aulas');  
      $this->db->order_by("aula.nome_aula", "asc");
      $aulas = $this->aulas->get_where(array("id_materia" => $this->input->post('id_materia')))->result();
    }
    if($this->input->post('folder_id')){
      $this->load->model('aula_model', 'aulas');
      $this->db->select("nome_aula, mediasite_experience_id as id_aula");
      $this->db->order_by("nome_aula", "asc");
      if($this->input->post('vesao') == 6){
        $where['mediasite6_folder'] = $this->input->post('folder_id');
      }else{
        $where['mediasite6_folder'] = $this->input->post('folder_id');
      }
      $aulas = $this->aulas->get_where($where)->result();
    }
    $i=0;
    $res = array();
    foreach ($aulas as $item) {
      $res[$i] = array("nome" => $item->nome_aula, "id_aula" => $item->id_aula);
      $i++;
    }
    print json_encode($res);
  }

  public function admin_materias($id_curso){
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('aula_model', 'aula');
    $this->load->model('materias_model', 'materias');
    $data['form_materias'] = $this->materias->form();
    if($this->input->post('id_materia')){
      switch($this->input->post('acao')){
        case "add":
          foreach ($this->input->post('id_aula') as $item){
            $dataSave = array("id_aula" => $item, "id_materia" => $this->input->post('id_materia'));
            $this->aula->save($dataSave);
          }
        break;

        case "remove":
          foreach ($this->input->post('id_aula') as $item) {
            $dataSave = array("id_aula" => $item, "id_materia" => 0);
            $this->aula->save($dataSave);
          }
        break;
      }
    }
    $data['titulo'] = "Aulas";
    $this->db->join("curso_mod_aula", "curso_mod_aula.id_aula=aula.id_aula");
    $this->db->join("modulo", "modulo.id_modulo=curso_mod_aula.id_modulo");

    $this->db->group_by("curso_mod_aula.id_aula");
    $data['aulas'] = $this->aula->get_where(array("modulo.id_curso" => $id_curso, "aula.ativo" => 1))->result();
    $materias = $this->materias->get_where(array("id_curso" => $id_curso))->result();
    $data['itens'] = $materias;
    $this->materias->fields['id_materia'] = array("label" => "Escolha a matéria", "type" => "select", "class" => "seleciona_materia", "values" => array("" => "--Selecione a matéria--"));
    foreach ($materias as $item) {
      $this->materias->fields['id_materia']['values'][$item->id_materia] = $item->materia;
    }
    $data['materias'] = $this->materias->form('id_materia');
    $this->load->view('admin/cursos/materias', $data);
  }

  public function delete_materia($id_materia){      
    if($this->input->post('ajax') == "Sim"){
      $this->load->model('materias_model', 'materias');
      $this->materias->delete($id_materia);  
      print "Ok";
    }
  }

  public function cadastro_materia($id_curso){      
    $this->load->model('materias_model', 'materias');
    if($this->input->posts()){
      if($this->input->post('ajaxFly')){
        $save['id_materia'] = $this->input->post('id_col_val');
        $save[$this->input->post('campo')] = $this->input->post('valor');
        $this->materias->save($save);
        die($this->materias->get($this->input->post('id_col_val'))->row()->materia);
      }else{
        $this->materias->save($this->input->posts());
      }
    }else{
      redirect("cursos/admin_materias/{$id_curso}");
    }
  }

  public function admin_categorias($id_curso){
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('categoria_curso_model', 'categoria_curso');
    if($this->input->posts()){
      $this->categoria_curso->delete(array("id_curso" => $id_curso));
      $dados['id_curso'] = $id_curso;
      foreach ($this->input->post('id_categoria') as $item) {
        $dados['id_categoria'] = $item;
        $this->categoria_curso->save($dados);
      }
      print "ok";
    }
    $this->load->library('lib_categoria');
    $this->db->select("id_categoria");
    $array_categoria = $this->categoria_curso->get_where(array("id_curso" => $id_curso))->result();
    foreach ($array_categoria as $item) 
      $this->lib_categoria->array_categoria[] = $item->id_categoria;
    
    $this->lib_categoria->menu_input = true;
    $data['categorias'] = $this->lib_categoria->menu_categoria();
    $this->load->view('admin/cursos/curso_categoria', $data);
  }

  public function busca_aula($id_curso=false) {      
    $this->load->model('aula_model', 'aulas');

    $this->db->order_by("aula.nome_aula", "asc");
    $this->db->select("aula.id_aula as id, aula.nome_aula as nome");
    $where = array();
    if($id_curso){
      $this->db->join("curso_mod_aula", "curso_mod_aula.id_aula=aula.id_aula");
      $this->db->join("modulo", "modulo.id_modulo=curso_mod_aula.id_modulo");
      $where['modulo.id_curso'] = $id_curso;
    }

    $this->db->like("aula.nome_aula", $this->input->post('busca'), $this->input->post('tipo_busca'));

    $aulas = $this->aulas->get_where($where)->result_array();
    print json_encode($aulas);
  }

  public function admin_avaliacoes($id_curso) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('avaliacao_model', 'avaliacao');
    if($this->input->post('titulo')){
      if($this->avaliacao->validar()){
        $save['id_curso'] = $id_curso;
        $this->avaliacao->save($this->input->posts($save));
      }
    }
    $this->load->model('modulo_model', 'modulo');
    $modulos = $this->modulo->get_where(array("id_curso" => $id_curso))->result();
    foreach ($modulos as $item) {
      $this->avaliacao->fields['id_modulo']['values'][$item->id_modulo] = $item->nome;
    }
    $this->data['form'] = $this->avaliacao->form();
    $where['avaliacao.id_curso'] = $id_curso;
    $this->db->join("modulo", "modulo.id_modulo=avaliacao.id_modulo");
    $this->data['avaliacoes'] = $this->avaliacao->get_where($where)->result();
    $this->load->view('admin/cursos/avaliacao', $this->data);
  }

  public function admin_avaliacao_detalhes($id_avaliacao) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('Avaliacao_perguntas_model', 'perguntas');  
    if($this->input->post('pergunta')){
      $this->load->model('avaliacao_respostas_model', 'respostas');  
      $pergunta['pergunta'] = $this->input->post('pergunta');
      $pergunta['id_avaliacao'] = $id_avaliacao;
      $this->perguntas->save($pergunta);
      $id_pergunta = $this->db->insert_id();

      $i=0;
      $resposta['id_pergunta'] = $id_pergunta;
      foreach ($this->input->post('resposta') as $item) {
        $resposta['resposta'] = $item;
        $this->respostas->save($resposta);
        if($i==0)
          $this->resposta_certa($id_pergunta, $this->db->insert_id());
        
        $i++;
      }
    }
    $this->data['titulo'] = "Detalhes da Avaliação";
    $this->data['modal'] = true;

    $this->db->join("avaliacao_respostas", "avaliacao_respostas.id_pergunta=avaliacao_perguntas.id_pergunta");
    $where['avaliacao_perguntas.id_avaliacao'] = $id_avaliacao;
    $perguntas = $this->perguntas->get_where($where)->result();
    $e=0;
    $questoes = array();
    foreach ($perguntas as $item) {
      if($e != $item->id_pergunta)
        $i=0;
      
      $e = $item->id_pergunta;
      $questoes[$item->id_pergunta]['id_pergunta'] = $item->id_pergunta;
      $questoes[$item->id_pergunta]['pergunta'] = $item->pergunta;
      $questoes[$item->id_pergunta]['respostas'][] = $item->resposta;
      $i++;
    }
    $this->data['questoes'] = $questoes;
    $this->load->view('admin/cursos/avaliacao_detalhes', $this->data);
  }

  private function resposta_certa($id_pergunta, $id_resposta) {
    $certa['id_resposta'] = $id_resposta;
    $certa['id_pergunta'] = $id_pergunta;
    $this->perguntas->save($certa);
  }

  public function admin_remover_questao($id_pergunta) {
    if(!$this->session->userdata('id_admin'))
      redirect("auth/login");
      
    $this->load->model('Avaliacao_perguntas_model', 'perguntas'); 
    $this->load->model('avaliacao_respostas_model', 'respostas');
    $this->perguntas->delete($id_pergunta);
    $this->respostas->delete(array("id_pergunta" => $id_pergunta));
  }
  
  public function admin_abas($id_curso){
    $this->load->model('curso_model', 'curso');
    if($this->input->posts()){
      $this->curso->save($this->input->posts());
    }
    $curso = $this->curso->get($id_curso)->row();
    $this->curso->fields = array("aba_detalhes" => array("type" => "text",
                                                         "label" => "Aba Detalhes",
                                                         "value" => $curso->aba_detalhes,
                                                         "class" => "vObrigatorio",
                                                         "rules" => "required"
                                                         ),
                                 "aba_curriculo" => array("type" => "text",
                                                         "label" => "Aba Mini Currículo",
                                                         "value" => $curso->aba_curriculo,
                                                         "class" => "vObrigatorio",
                                                         "rules" => "required"
                                                         ),
                                "aba_modular" => array("type" => "text",
                                                         "label" => "Curso Modular",
                                                         "value" => $curso->aba_modular,
                                                         "class" => "vObrigatorio",
                                                         "rules" => "required"
                                                         ),
                                 "aba_aulas" => array("type" => "text",
                                                         "label" => "Aba Curso por Aula",
                                                         "value" => $curso->aba_aulas,
                                                         "class" => "vObrigatorio",
                                                         "rules" => "required"
                                                         ),
                                "aba_depoimentos" => array("type" => "text",
                                                         "label" => "Aba Depoimentos",
                                                         "value" => $curso->aba_depoimentos,
                                                         "class" => "vObrigatorio",
                                                         "rules" => "required"
                                                         ),
                                "aba_matriz" => array("type" => "text",
                                                         "label" => "Aba Matriz Curricular",
                                                         "value" => $curso->aba_matriz,
                                                         "class" => "vObrigatorio",
                                                         "rules" => "required"
                                                         ),
                                "aba_acesso_titulo" => array("type" => "text",
                                                         "label" => "Titulo Aba 1",
                                                         "value" => $curso->aba_acesso_titulo,
                                                         "class" => "",
                                                         "rules" => ""
                                                         ),
                                "aba_acesso" => array("type" => "textarea",
                                                         "label" => "Conteudo Aba 1",
                                                         "value" => $curso->aba_acesso,
                                                         "class" => "tinymce",
                                                         "rules" => ""
                                                         ),
                                "aba_aux_titulo" => array("type" => "text",
                                                         "label" => "Titulo Aba 2",
                                                         "value" => $curso->aba_aux_titulo,
                                                         "class" => "",
                                                         "rules" => ""
                                                         ),
                                "aba_aux" => array("type" => "textarea",
                                                         "label" => "Conteudo Aba 2",
                                                         "value" => $curso->aba_aux,
                                                         "class" => "tinymce",
                                                         "rules" => ""
                                                         ),
                                );
    $this->data['form'] = $this->curso->form("aba_detalhes", "aba_curriculo", "aba_modular", "aba_aulas", "aba_depoimentos", "aba_matriz", "aba_acesso_titulo", "aba_acesso", "aba_aux_titulo", "aba_aux");
    $this->load->view('admin/cursos/abas', $this->data);
  }
  
  public function admin_depoimentos($id_curso){
    $this->load->model('curso_depoimentos_model', 'curso_depoimentos');
    $this->data['depoimentos'] = $this->curso_depoimentos->get_where(array("id_curso" => $id_curso))->result();
    $this->load->view('admin/cursos/depoimentos', $this->data);
  }
  
  public function admin_depoimentos_detalhes($id_curso, $id_depoimento=false){
    $this->load->model('curso_depoimentos_model', 'curso_depoimentos');
    $this->data['modal'] = true;
    
    if($this->input->posts()){
      if($this->curso_depoimentos->validar()){
        $this->curso_depoimentos->save($this->input->posts());
        if($id_depoimento == false)
          $id_depoimento = $this->db->insert_id();
        $this->data['msg'] = "Depoimento Salvo com Sucesso";
      }
    }
    
    if($id_depoimento){
      $depoimento = $this->curso_depoimentos->get($id_depoimento)->row();
      $this->curso_depoimentos->fields['nome']['value'] = $depoimento->nome;
      $this->curso_depoimentos->fields['depoimento']['value'] = $depoimento->depoimento;
      $this->curso_depoimentos->fields['id_depoimento'] = array("type" => "hidden", "label" => "", "value" => $depoimento->id_depoimento);
    }
    $this->curso_depoimentos->fields['id_curso']['value'] = $id_curso;
    $this->data['form'] = $this->curso_depoimentos->form();
    $this->load->view('admin/cursos/depoimentos_detalhes', $this->data);
  }
  
  public function admin_remover_depoimento($id_depoimento){
    if($this->input->post('ajax') == "Sim"){
      $this->load->model('curso_depoimentos_model', 'curso_depoimentos');
      $this->curso_depoimentos->delete($id_depoimento);
      print "Ok";
    }
  }
  
  public function admin_arquivos($id_curso){
    if(!$this->session->userdata('id_admin'))
     redirect("auth/login");
    
		
		$this->load->model('arquivo_model', 'arquivo');
    $this->data['form'] = $this->arquivo->form();
    $this->data['titulo'] = "Arquivos";

    if($this->input->posts()){
      $config['upload_path'] = 'uploads/cursos';
      $config['allowed_types'] = '*';
      $this->load->library('upload', $config);
      
      if($this->upload->do_upload()) {
        $file = $this->upload->data();
        $array["id_curso"] = $id_curso;
        $array["arquivo"] = $file["file_name"];
        $array['nome'] = $this->input->post('nome');
        $id = $this->arquivo->save($array);
        $this->data['msg'] = "Arquivo Salvo com Sucesso";
      } else {
        $this->data['erro'] = $this->upload->display_errors();
      } 
    }
     
    $this->data["arquivos"] = $this->arquivo->get_where(array("id_curso" => $id_curso))->result();
    $this->load->view('admin/cursos/arquivos', $this->data);
  }

  public function admin_editar_arquivos($id_arquivo) 
  {
    $this->load->model('arquivo_model','arquivo');
    if($this->input->post('nome')){
      $set['nome'] = $this->input->post('nome');
      $where['id_arquivo'] = $id_arquivo;
      $this->arquivo->update($set, $where);
      print 'ok';
    }
  }
  
  public function admin_remover_arquivos($id_arquivo){
    if($this->input->post('ajax') == "Sim"){
      $this->load->model('arquivo_model', 'arquivo');
      $this->arquivo->delete($id_arquivo);
      print "Ok";
    }
  }       
    
  public function admin_certificado($id_curso) 
  {
    $this->data['certificado'] = $this->model->get($id_curso)->row();
    $this->load->view('admin/cursos/certificado', $this->data);
  }

  public function admin_upload_certificado() 
  {
    $config['upload_path'] = 'uploads/cursos';
    $config['allowed_types'] = 'png|jpg';
    $config['max_size'] = '100000';
    $config['max_width']  = '3425';
    $config['max_height']  = '2435';
    $this->load->library('upload', $config);
    if($this->upload->do_upload('certificado')) {
      $save['id_curso'] = $this->input->post('id_curso');
      $dados = $this->upload->data();
      $save['certificado'] = $dados['file_name'];
      $this->model->save($save);
      $this->data['status'] = 'sucess';
      $this->data['msg'] = 'Certificado salvo com sucesso';
    }else{
      $this->data['status'] = 'alert';
      $this->data['msg'] = $this->upload->display_errors();
    }
    $this->load->view('admin/upload_ajax', $this->data);

  }
  
  public function admin_remover_certificado($id_curso) 
  {
    $this->db->select('certificado');
    $certificado = $this->model->get($id_curso)->row()->certificado;
    if(file_exists(FCPATH.'uploads/cursos/'.$certificado))
      unlink(FCPATH.'uploads/cursos/'.$certificado);
    $this->model->update(array('certificado' => ''), $id_curso);

    $this->output->set_output('ok');
  }
}
