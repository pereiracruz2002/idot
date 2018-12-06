<?php
class Professor_model extends My_Model{
	var $id_col="id_professor";
	var $fields= array(
	   "nome" => array("type" => "text",
						"label" => "Nome do Professor",
						"class"=> "vObrigatorio",
						"rules" => "required|min_length[3]|max_length[45]"
						),
	   "texto"=> array("type" => "textarea",
						"label" => "Mini-Currículo",
						"class"=> "",
						"rules" => "required",
						),
	   "login" => array("type" => "text",
						"label" => "Login do Professor",
						"class"=> "vObrigatorio",
						"rules" => "callback_login_unico"
						),

	   "senha" => array("type" => "password",
						"label" => "Senha",
						"class" => "",
						"rules" => ""
						),
	"foto"=> array("type" => "file",
						"label" => "Foto",
						"class" => "",
						"rules" => "callback_upload_foto",
						),

	   );

	
	
	function listar_professor_all(){
	  $query = $this->get_all();	
	  return $query->result();
	}
	
	function consulta_professor($id_professor){
	  $query = $this->get_where(array("id_professor" => $id_professor));
	  return $query->result();
	}
	
	function consulta_professor_importacao(){
		$query = $this->get_where(array("texto" => ''));
	  return $query->result();
	}
	
	function atualiza_minicurriculo($dados, $id_professor ){
		$this->db->update($this->table, $dados, array('id_professor' => $id_professor));
	}

    public function get_cursos($id_professor) 
    {
      $where['curso_professor.id_professor'] = $id_professor;
      $where['curso.ativo'] = 1;
      $this->db->select('curso.nome as curso, 
                         modulo.id_modulo,
                         modulo.nome as modulo
                        ')
               ->join('curso', 'curso.id_curso=curso_professor.id_curso')
               ->join('modulo', 'modulo.id_curso=curso.id_curso')
               ->where($where)
               ->group_by('curso.id_curso');
      return $this->db->get('curso_professor')->result();
    }
	
}
?>
