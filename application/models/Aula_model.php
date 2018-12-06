<?php

class Aula_model extends My_Model{
	var $id_col="id_aula";
	var $fields= array(
		   "versao_mediasite" => array("type" => "select",
							"label" => "Versão do Mediasite",
							"class"=> "",
							"rules" => "",
        "values" => array(4 => 4, 6 => 6),
        "value" => 6
							),

		   "mediasite_folder_id" => array("type" => "select",
								"label" => "MediaSite Folder",
								"class"=> "",
								"rules" => "",
								"values" =>array(),
								),

 "nome_aula" => array("type" => "text",
								"label" => "Nome da Aula",
								"class" => "vObrigatorio",
								"rules" => "required|min_length[3]|max_length[255]"
								),
		   "carga_horaria_aula" => array("type" => "text",
								"label" => "Carga Horária",
								"class"=> "vObrigatorio carga_horaria",
								"rules" => "required|max_length[15]"
								),
			"mediasite_experience_id" => array("type" => "text",
								"label" => "peid do Mediasite",
								"class"=> "",
								"rules" => ""
								),
			"start_datetime" => array("type" => "text",
								"label" => "Data",
								"class"=> "vObrigatorio",
								"rules" => "required"
								),
				"tipo" => array("type" => "select",
								"label" => "Tipo de aula",
								"class"=> "vObrigatorio",
								"rules" => "required",
								"values" =>array('Sob Demanda' => 'Sob Demanda', 'Ao Vivo' => 'Ao Vivo', 'Gravado' => 'Gravado'),
								),
				"embed" => array("type" => "textarea",
								"label" => "Embed do vídeo",
								"class"=> "",
								"rules" => ""
								),
		   );
	
	

	
	
	function _filter_pre_save(&$data){
		if(array_key_exists('start_datetime',$data)){
			$d = formatar_time($data['start_datetime']);
			$data['start_datetime'] = $d;
		}
		
		if(array_key_exists('carga_horaria_aula',$data)){
			$t = human2time($data['carga_horaria_aula']);
			$data['carga_horaria_aula'] = $t;
		}
	}
	
	function listar_aula_all(){
   	$query = $this->get_all();
	  return $query->result();
	}
	
	public function count_aulas(){
		$this->db->select("COUNT(*) AS numrows");
		$query = $this->db->get_where("tb_aula",array("ativo" => 1));
		$row = $query->row();
		return (int) $row->numrows;
  }
	
	function consulta_aula($id_aula){
	  $query = $this->get_where(array("id_aula" => $id_aula));
	  return $query->result();
	}
	
	function consulta_aula_modulo($mediasite_folder_id){
		$this->db->order_by("nome_aula", "asc");
	  $query = $this->get_where(array("mediasite_folder_id" => $mediasite_folder_id));
	  return $query->result();
	}

	function consulta_aulaV6_modulo($mediasite_folder_id){
		$this->db->order_by("nome_aula", "asc");
	  $query = $this->get_where(array("mediasite6_folder" => $mediasite_folder_id));
	  return $query->result();
	}

	
	function consulta_aula_importacao($mediasite_experience_id){
	  $query = $this->get_where(array("mediasite_experience_id" => $mediasite_experience_id));
	  return $query->result();
	}
	
	function atualiza_aula($dados,$id_aula){
		$this->db->update("tb_aula", $dados, array('id_aula' => $id_aula));
	}

  public function getFromPedido($id_pedido_curso_aula) 
  {
    $where['pedido_curso_aula.id_pedido_curso_aula'] = $id_pedido_curso_aula;
    $where['parceiro_curso.id_parceiro'] = $this->id_parceiro;
    $where['aula.ativo'] = 1;
    $this->db->select('aula.*,
                       curso.ilimitado,
                       pedido_curso_aula.*
                      ')
             ->join('pedido_curso_aula', 'pedido_curso_aula.id_aula=aula.id_aula')
             ->join('pedido_curso', 'pedido_curso.id_pedido_curso=pedido_curso_aula.id_pedido_curso')
             ->join('curso', 'curso.id_curso=pedido_curso.id_curso')
             ->join('parceiro_curso', 'parceiro_curso.id_curso=pedido_curso.id_curso');
    $aula = $this->get_where($where)->row();
    if(($aula->qtd_acesso < 1 or $aula->dt_expiracao < date('Y-m-d')) and !$aula->ilimitado and $aula->tipo != 'Ao Vivo'){
      return false;
    }else{
      return $aula;
    }
  }

  public function pesquisa_aula($texto_aula)
  {
  	$sql="
  	SELECT
  	tb_modulo.id_modulo,
  	tb_modulo.nome,
  	tb_modulo.id_curso,
    tb_aula.id_aula,
    tb_aula.ativo,
    tb_aula.id_materia,
    tb_aula.nome_aula,
    tb_curso.id_curso,
    tb_curso.ativo,
    tb_curso.nome,
    tb_pedido.id_pedido,
    tb_pedido.ativo,
    tb_pedido.status,
    tb_pedido_curso.id_pedido_curso,
    tb_pedido_curso.id_pedido,
    tb_pedido_curso.id_curso,
    tb_pedido_curso.id_modulo,
    tb_pedido_curso_aula.id_pedido_curso_aula,
    tb_pedido_curso_aula.id_pedido_curso,
    tb_pedido_curso_aula.id_aula
FROM
    tb_aula 
INNER JOIN tb_pedido_curso_aula ON tb_aula.id_aula = tb_pedido_curso_aula.id_aula
INNER JOIN tb_pedido_curso ON tb_pedido_curso.id_pedido_curso = tb_pedido_curso_aula.id_pedido_curso
INNER JOIN tb_curso ON tb_curso.id_curso = tb_pedido_curso.id_curso
INNER JOIN tb_pedido ON tb_pedido.id_pedido = tb_pedido_curso.id_pedido
INNER JOIN tb_modulo ON tb_modulo.id_curso = tb_curso.id_curso

WHERE tb_pedido.status = \"Liberado\" 
AND tb_pedido.ativo = 1
AND tb_aula.ativo = 1
AND tb_curso.ativo = 1
AND tb_aula.nome_aula LIKE '%{$texto_aula}%'
;";
  
$resultado = $this->db->query($sql);
return $resultado;
  }

}
