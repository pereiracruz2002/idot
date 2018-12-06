<?
class Lib_Curso{
  
  var $CI;

  public function __construct() {
		$this->CI =& get_instance();
  }

  public function get_curso($id_modulo) {
    $ci = $this->CI;
    $ci->load->model("curso_model", "curso");
    $ci->db->select("
      curso.nome,
    ");
    $ci->db->join("modulo", "modulo.id_curso=curso.id_curso");
    return $ci->curso->get_where(array("modulo.id_modulo" => $id_modulo))->row();
  }
  
  function get_professores($id_aula){
    $ci = $this->CI;
    $ci->load->model("aula_professor_model", "aula_professor");
    $ci->db->select("professor.nome")
           ->join("professor", "professor.id_professor=aula_professor.id_professor");
    $professores = $ci->aula_professor->get_where(array("aula_professor.id_aula" => $id_aula))->result_array();
    $nomes = array();
    foreach ($professores as $item) {
      $nomes[] = $item['nome'];
    }
    return $nomes;
  }

  public function get_categorias($id_curso) {
    $ci = $this->CI;
    $ci->load->model('categoria_curso_model', 'categoria_curso');
    $ci->db->select("categoria.nome, categoria.parent")
           ->join("categoria", "categoria.id_categoria=categoria_curso.id_categoria")
           ->order_by("categoria.parent", "asc");
    $categoria = $ci->categoria_curso->get_where(array("categoria_curso.id_curso" => $id_curso, "categoria.ativo" => 1))->result_array();
    $ret="";
    foreach ($categoria as $item) {
      if($item['parent'] == 0)
        $ret .= "<strong>Categoria:</strong> {$item['nome']}, ";
      else
        $ret .= "<strong>Sub Categoria:</strong> {$item['nome']} ";
    }
    return $ret;
  }

  public function get_materias ($id_curso) {
    $ci = $this->CI;
    $ci->load->model('materias_model', 'materias');
    $materias = $ci->materias->get_where(array("id_curso" => $id_curso));
    return $materias->result();

  }

  public function mais_vendidos($limit, $categoria=false) {
    $ci = $this->CI;
    $ci->load->model("pedido_curso_model", "pedido_curso");
    $ci->db->select("pedido_curso.id_curso, 
                     curso.nome as curso,
                     curso.permalink as curso_permalink,
                     categoria.permalink as categoria_permalink,
                     categoria.nome as categoria,
                     ")
           ->select("count(*) as total", false)
           ->join("curso", "pedido_curso.id_curso=curso.id_curso")
           ->join("pedido", "pedido.id_pedido=pedido_curso.id_pedido")
           ->join("categoria_curso", "categoria_curso.id_curso=curso.id_curso")
           ->join("categoria", "categoria_curso.id_categoria=categoria.id_categoria")
           ->group_by("pedido_curso.id_curso")
           ->order_by("total", "desc")
           ->limit($limit);
    $where = array("pedido.status" => "Liberado", "curso.ativo" => 1, "categoria.parent" => 0);
    if($categoria)
      $where['categoria.permalink'] = $categoria;

    $cursos = $ci->pedido_curso->get_where($where)->result();
    return $cursos;
  }
}
