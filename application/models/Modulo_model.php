<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modulo_Model extends My_Model{
  var $id_col = "id_modulo";
	
	var $table_curso = "curso";
	var $table_aula = "aula";
	var $table_curso_mod_aula = "curso_mod_aula";
	var $table_professor = "professor";

	
	var $fields= array(
		   "nome" => array("type" => "text",
							"label" => "Nome",
							"class"=> "vObrigatorio",
							"rules" => "required"
							),
		   "carga_horaria" => array("type" => "text",
							"label" => "Carga Horária",
							"class"=> "vObrigatorio",
							"rules" => "required"
							),
		   "valor" => array("type" => "text",
							"label" => "Valor",
							"class"=> "vObrigatorio valor",
							"rules" => "required"
							),
		   "valor_desconto" => array("type" => "text",
							"label" => "Valor com Desconto",
							"class"=> "vObrigatorio valor",
							"rules" => "required"
							),

		   "licenca_uso" => array("type" => "text",
							"label" => "Licença de Uso (dias)",
							"class"=> "vObrigatorio vNumero",
							"rules" => "required|numeric"
							),
		   "qtd_acesso" => array("type" => "text",
							"label" => "Quantidade de Acesso",
							"class"=> "vObrigatorio vNumero",
							"rules" => "required|numeric"
							),

		   "tipo_modulo" => array("type" => "select",
							"label" => "Tipo do Módulo",
							"class"=> "vObrigatorio",
        "values" => array(
          "Integral" => "Integral",
          "Modular" => "Modular",
          "Diario" => "Diario",
          "Gratis" => "Gratis",
        ),
							"rules" => "required"
							),
			 "em_breve" => array("type" => "select",
							"label" => "Tipo de Publicação",
							"class"=> "vObrigatorio",
        "values" => array(
          "0" => "Normal",
          "1" => "Em Breve"
        ),
							"rules" => "required"
							),
			 "oculto" => array("type" => "select",
							"label" => "Oculto",
							"class"=> "vObrigatorio",
        "values" => array(
          "0" => "Não",
          "1" => "Sim"
        ),
							"rules" => "required"
				),
		   );
  
	
	
	function consulta_modulo($id_modulo){
		$this->db->select($this->table.".*, ".
											$this->table_curso.".nome as curso");
		
		$this->db->join($this->table_curso, $this->table_curso.'.id_curso = '.$this->table.'.id_curso', 'left');
				
	  $query = $this->get_where(array($this->table.".id_modulo" => $id_modulo));
	  return $query->result();
	}
	
	function consulta_curso_tipo_modulo($id_curso){
		$this->db->select("distinct(tipo_modulo) as tipo");
    $where = array($this->table.".id_curso" => $id_curso, $this->table.".tipo_modulo !=" => "Integral", "ativo" => 1);
					
	  $query = $this->get_where($where);
	  return $query->result();
	}


	function consulta_curso_modulo($id_curso, $tipo){
				
    $this->db->order_by("modulo.nome", "asc");
    $this->db->join("curso","curso.id_curso=modulo.id_curso");
    $this->db->select("curso.*,
    									 modulo.*,
    									 modulo.nome as modulo_nome
    									");
	  $query = $this->get_where(array("modulo.id_curso" => $id_curso, 'tipo_modulo' => $tipo, "modulo.ativo" => 1, "modulo.oculto" => 0));
	  return $query->result();
	}
	
	function consulta_professor($id_modulo){
		$this->db->select($this->table_professor.".*");
		$this->db->join($this->table_curso_mod_aula, $this->table_curso_mod_aula.'.id_modulo = '.$this->table.'.id_modulo');
		$this->db->join("aula_professor", 'aula_professor.id_aula = '.$this->table_curso_mod_aula.'.id_aula');
		$this->db->join($this->table_professor, $this->table_professor.'.id_professor = aula_professor.id_professor');

		$this->db->group_by("aula_professor.id_professor"); 
		
	  $query = $this->get_where(array($this->table.".id_modulo" => $id_modulo, "professor.ativo" => 1));
	  return $query->result();
	}

	function consulta_forma_pagto($id_modulo){
		$this->db->select("forma_pagto, id_modulo");
		/* $this->db->group_by("id_modulo"); 
		$this->db->order_by("max(length(forma_pagto))", "desc");
		$this->db->limit(1); */	
		$this->db->from($this->table); 
		
		$query = $this->db->where_in('id_modulo', $id_modulo);
		return $query->get()->result();
	}
		

 	function _filter_pre_save(&$data){
		if(array_key_exists('valor',$data)){
			$d = formata_valor($data['valor']);
			$data['valor'] = $d;
		}
    if(array_key_exists('forma_pagto', $data)){
      $data['forma_pagto'] = join(",", $data['forma_pagto']);
    }
	}
	
	function consulta_modulo_importacao($id_modulo){
		$query = $this->get_where(array("id_modulo" => $id_modulo));
	  return $query->result();
	}
	
	function insere_importacao($dados){
		$this->db->insert($this->table, $dados); 
	}
	
	function consulta_carga_horaria(){
		$this->db->order_by('id_modulo');
		$query = $this->get_where(array("ativo" => 1, "carga_horaria" =>0));
	  return $query->result();
	}
	
	function atualiza_carga_horaria($dados, $id_modulo ){
		$this->db->update($this->table, $dados, array('id_modulo' => $id_modulo));
	}
	
	function consulta_tipo_modulo($id_curso){
 		$this->db->select("tipo_modulo");
		$this->db->group_by("tipo_modulo"); 
		$query = $this->get_where(array("id_curso" => $id_curso));
 		return $query->result();	
	}
	
	public function consulta_parceiro($id_modulo){
		$this->db->join("parceiro_curso","parceiro_curso.id_curso=modulo.id_curso")
						 ->join("parceiro", "parceiro.id_parceiro=parceiro_curso.id_parceiro");
		return $this->get($id_modulo)->row();
	}
	
  public function permitido() 
  {
    $cart = $this->cart->contents();
    print_r($cart);
    foreach ($cart as $item) {
      $row_id[$item['id']] = $item['rowid'];
      $id_modulo[] = $item['id'];
    }
    $pedido = $this->db->select('id_modulo')
                       ->where_in('pedido_curso.id_modulo', $id_modulo)
                       ->where('pedido.id_cliente', $this->session->userdata('id_cliente'))
                       ->join('pedido_curso', 'pedido_curso.id_pedido=pedido.id_pedido')
                       ->get('pedido')->result();
    if($pedido){
      foreach ($pedido as $item) {
        $data[] = array(
          'rowid' => $row_id[$item->id_modulo],
          'qty'   => 0
        );
      }
      $this->cart->update($data); 
      return false;
    }else{
      return true;
    } 
  }
}
