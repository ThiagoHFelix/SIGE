<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

//Construtor padrão
	public function __construct(){
		parent::__construct();
	}//construct


  // Carrega todas as views do sistema
	public function view($page = 'home')
	{

	//Verifico se a view existe
	if( ! file_exists(APPPATH. 'views/'.$page.'.php') ):
				show_404();
		endif;

		//Dados passados para view
		$data['title'] = ucfirst($page);
  	$this->load->view('home',$data);

	}//view

}//class
