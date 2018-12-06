<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Curso_Model extends My_Model{
  var $id_col = "id_curso";
  var $get_order = "nome";
	var $fields= array(
					   "versao_mediasite" => array("type" => "select",
										"label" => "Versão do Mediasite",
										"class"=> "",
										"rules" => "",
                    "values" => array(4 => 4, 6 => 6),
                    "value" => 6
										),

					   "nome" => array("type" => "text",
										"label" => "Nome",
										"class"=> "vObrigatorio",
										"rules" => "required"
										),
					   "ilimitado" => array("type" => "select",
										"label" => "Acesso Ilimitado",
										"class"=> "",
										"rules" => "",
                    "values" => array(1 => "Sim", 0 => "Não")
										),
					   "completo" => array("type" => "text",
										"label" => "Identificação de Curso Completo",
										"class"=> "",
										"value"=> "Curso Completo",
										"rules" => ""
										),
					   "permalink" => array("type" => "text",
										"label" => "Link Permanente",
										"class"=> "vObrigatorio",
										"rules" => "required|callback_permalink_check"
										),
					   "mediasite_folder_id" => array("type" => "select",
										"label" => "Pasta no Media Site",
										"class"=> "popula_demostracao",
										"values"=> array(),
										"rules" => ""
										),
					   "demonstracao" => array("type" => "select",
										"label" => "Aula de Demonstração",
										"class"=> "",
										"values"=> array("-- Selecione a Pasta --"),
										"rules" => ""
										),
					   "at_home" => array("type" => "select",
										"label" => "Home",
										"class"=> "",
										"rules" => "",
                    "values" => array(1 => "Sim", 0 => "Não")
										),
						 "sort" => array("type" => "text",
										"label" => "Ordem",
										"class"=> "",
										"rules" => ""
										),
						 "em_breve" => array("type" => "select",
										"label" => "Tipo de Publicação",
										"class"=> "vObrigatorio",
                    "values" => array(
                      "0" => "Normal",
                      "1" => "Em Breve",
                      "2" => "Apenas para quem comprou"
                    ),
										"rules" => "required"
										),
						 "exibir" => array("type" => "select",
										"label" => "Exibir",
										"class"=> "vObrigatorio",
                    "values" => array(
                      "" => "--Nenhum--",
                      "peak hotsite" => "Hotsite e Peak",
                      "peak" => "Apenas Peak",
                      "hotsite" => "Apenas Hotsite"
                    ),
										"rules" => "required"
										),
						 "seo_description" => array("type" => "text",
										"label" => "Descrição para SEO (170 caracteres)",
										"class"=> "",
										"rules" => "max_length[170]"
										),
						 "seo_keywords" => array("type" => "text",
										"label" => "Keywords para SEO (100 caracteres)",
										"class"=> "",
										"rules" => "max_length[100]"
										),
						 "label_avaliacao" => array("type" => "text",
										"label" => "Texto \"Avaliação\"",
										"class"=> "",
										"rules" => "max_length[100]",
                    "value" => "Avaliação"
										),
					   "sinopse" => array("type" => "textarea",
										"label" => "Sinopse - <a href=\"#\" class=\"habilitar_html clear\">Habilitar Editor HTML</a>",
										"class"=> "",
										"rules" => ""
										),
						 "matriz_curricular" => array("type" => "textarea",
										"label" => "Matriz Curricular - <a href=\"#\" class=\"habilitar_html clear\">Habilitar Editor HTML</a>",
										"class"=> "tinymce",
										"rules" => ""
										),
						 
						 "imagem" => array("type" => "file",
										"label" => "Imagem",
										"class"=> "",
										"rules" => "callback_upload_check",
										),
				     "email_pergunta" => array("type" => "text",
									"label" => "Email para perguntas",
									"class"=> "vEmail",
									"rules" => ""
									),
					   );
  // function __construct(){
  //   parent::My_Model();
  // }

  public function detalhes($permalink) {
    $where['curso.permalink'] = $permalink;
    $where['curso.em_breve <>'] = 2;
		return $this->get_where($where)->row();
  }

  public function meus_cursos(){
    $this->db->group_by("pedido_curso.id_pedido");
    $this->db->select("curso.*, pedido.*");
    $this->db->join("pedido_curso", "pedido_curso.id_curso=curso.id_curso");
    $this->db->join("pedido", "pedido.id_pedido=pedido_curso.id_pedido");
    $where['pedido.id_cliente'] = $this->session->userdata('id_cliente');
    $where['pedido.ativo'] = 1;
    return $this->get_where($where);
  }
	
	public function ultimo_curso($mediasite_folder_id){
		$this->db->select("id_curso");
		$this->db->order_by("id_curso", "desc");
		$this->db->limit(1);
		
		$query = $this->get_where(array("mediasite_folder_id" => $mediasite_folder_id));
	  return $query->result();
	}
	
	public function consulta_curso_importacao($curso){
		$this->db->where(array("nome" => $curso));
		$this->db->from($this->table);
		$query = $this->db->get();	

	  return $query->result();
	}
	
	function insere_importacao($dados){
		$this->db->insert($this->table, $dados); 
	}
	
	public function consulta_curso(){
		$query = $this->get_where(array("ativo" => 1));
	  return $query->result();
	}

  public function cursosRelacionados($id_curso, $limit=5)
  {
    $where['curso.ativo'] = 1;
    $where['curso.id_curso <>'] = $id_curso;
    $this->db->select('curso.nome as curso,
                       curso.permalink,
                       curso.id_curso,
                       categoria.nome as categoria,
                       categoria.permalink as categoria_permalink
                      ')
             ->join('categoria_curso', 'categoria_curso.id_curso=curso.id_curso')
             ->join('categoria', 'categoria_curso.id_categoria=categoria.id_categoria')
             ->where('categoria_curso.id_categoria IN (SELECT id_categoria FROM tb_categoria_curso WHERE id_curso = '.$id_curso.')')
             ->where_in('exibir', array('peak', 'peak hotsite'))
             ->order_by('at_home', 'desc')
             ->order_by('sort_peak', 'asc')
             ->order_by('parent', 'desc')
             ->group_by('id_curso')
             ->limit($limit);
    return $this->get_where($where)->result();
  }
  public function pesquisa_curso($texto_curso)
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
AND tb_curso.nome LIKE '%{$texto_curso}%'
;";
  
$resultado = $this->db->query($sql);
return $resultado;
  }
	
}
