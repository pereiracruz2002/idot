<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Professor_model extends My_Model{
	var $id_col="id_professor";
	var $fields= array(
		   "nome" => array("type" => "text",
							"label" => "Nome do Professor",
							"class"=> "vObrigatorio",
							"rules" => "required|min_length[3]|max_length[45]"
							),
		   "texto"=> array("type" => "text",
							"label" => "Mini-Currículo",
							"class"=> "",
							"rules" => "required",
							),

		   "email" => array("type" => "text",
							"label" => "Email",
							"class" => "",
							"rules" => ""
							),
		"foto"=> array("type" => "file",
							"label" => "Foto",
							"class" => "",
							"rules" => "callback_upload_foto",
							),

	);
}
?>
