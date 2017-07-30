<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

//Construtor padrão
	public function __construct(){
		parent::__construct();
    $this->load->helper('url');
	}//construct


          // Carrega todas as views do sistema
	public function view($page = 'Welcome')
	{

		//Verifico se a view existe
		if( ! file_exists(APPPATH. 'views/'.$page.'.php') ):
				show_404();
		endif;

		//Dados passados para view
		$data['title'] = 'Centro Escolar';
		$data['title_bigger'] = 'Centro Escolar';
		$data['title_smaller'] = 'Seja bem-vindo - venha nos conhecer';
		$data['footer_message'] = 'All right reserved';
		$data['title_header'] = 'Centro Escolar';
		$data['menu_home'] = 'Inicio';
		$data['menu_info'] = 'Infomações';
		$data['menu_contact'] = 'Contato';
		$data['title_btn_login'] = 'Sistema Escolar (BETA)';
                
  	$this->load->view('Welcome',$data);

	}//view





}//class
