<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Avisos_model extends My_Model
{
	var $id_col = 'avisos_id';


	public function __construct() 
    {
        parent::__construct();
    }

    public function save_aviso($id,$tipo,$msg,$motivo,$envia_email=FALSE){
    	$dados['tipo'] = $tipo;
        $dados['mensagem'] = $msg;
        $dados['id'] = $id;
        $dados['data'] =date('Y-m-d');
        $this->db->insert('avisos',$dados);
        if($envia_email){
        	if($tipo == 'admin'){
        		$this->load('admin_model','email_model');
        		$where['admin_id'] = $id;
        	}elseif($tipo=='professor'){
        		$this->load('professor_model','email_model');
        		$where['id_professor'] = $id;
        	}else{
        		$this->load('alunos_model','email_model');
        		$where['alunos_id'] = $id;
        	}

        	$this->db->select('email');
        	$email = $this->email_model->get_where($where)->row();

        	$this->load->library('email');
	        $this->email->from(EMAIL_FROM, $motivo);
	        $this->email->to((ENVIRONMENT == 'development' ? EMAIL_DEV : $email->email));
	        $this->email->subject($motivo);
	        $this->email->message($this->load->view("admin/geral", $dados, TRUE));
            $this->email->send();
	        // if ($this->email->send()) {
	        //         $this->data['success_forgot'] = "Email enviado com sucesso";
	        //         $this->index();
	        //         return;
	        //     }
	        // }
        }
    }

}
