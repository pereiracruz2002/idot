<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Avisos_model extends My_Model
{
	var $id_col = 'avisos_id';

    var $fields = array(  
        'tipo' => array(
            'type' => 'select',
            'label' => 'Status',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('professor' => 'Professor', 'admin' => 'Admin','aluno'=>'Aluno')
        ), 
        'mensagem' => array(
            'type' => 'textarea',
            'label' => 'Mensagem',
            'class' => '',
            'extra' => array('class'=>'mytextarea'),
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-6">',
            'append' => '</div>',
        ),
        'visualizado' => array(
            'type' => 'select',
            'label' => 'Status',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array('sim' => 'Sim', 'nao' => 'Não')
        ),
        'data' => array(
            'type' => 'date',
            'label' => 'Data',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
        ),

        'id' => array(
            'type' => 'select',
            'label' => 'Remetente',
            'class' => '',
            'rules' => 'required',
            'label_class' => 'col-md-2',
            'prepend' => '<div class="col-md-3">',
            'append' => '</div>',
            'values' => array()
        ),
    );


	public function __construct() 
    {
        parent::__construct();
    }





    public function save_aviso($id=FALSE,$tipo,$msg,$motivo,$envia_email=FALSE){
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
	        $this->email->message($msg);
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
