<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Painel extends CI_Controller
{
    var $data = array();

    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
		
		$this->load->view('admin/painel', $this->data);
    }
}
