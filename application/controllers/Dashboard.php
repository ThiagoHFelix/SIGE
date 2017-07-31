<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Dashboard_model','dash');
        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session'));
       
    }//construct
    
    
    /**
     * Carregamento da tela inicial do sitema
     */
    public function index() {

            
            isSessionStarted();
            
            //Tema padrão
            $this->session->set_userdata('main_theme', 'skin-blue');

            //Carregando view 
            //Administrador
            if (strcmp($this->session->userdata('entidade'), 'administrador') == 0):
                $this->load->view('administrador/dashboard');
            endif;
            //Professor
            if (strcmp($this->session->userdata('entidade'), 'professor') == 0):
                $this->load->view('professor/dashboard');
            endif;
            //Aluno
            if (strcmp($this->session->userdata('entidade'), 'aluno') == 0):
                $this->load->view('aluno/dashboard');
            endif;


    }//view

   


    /**
     * Finaliza a sessão
     */
    public function logout() {

        $this->session->sess_destroy();
        redirect(base_url($this->uri->segment(1).'/login'));

    }//logout

}//class








