<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session'));

    }//construct


    /**
     * Carregamento da tela inicial do sitema
     */
    public function index() {

            isSessionStarted();

            //Carregando view
            //Administrador
            if (strcmp($this->session->userdata('entidade'), 'Administrador') == 0):
                $this->load->view('administrador/dashboard');
            endif;
            //Professor
            if (strcmp($this->session->userdata('entidade'), 'professor') == 0):
                $this->load->view('professor/dashboard');
            endif;
            //Aluno
            if (strcmp($this->session->userdata('entidade'), 'Aluno') == 0):
                $this->load->view('aluno/dashboard');
            endif;


    }//view




    /**
     * Finaliza a sessão
     */
    public function logout() {


     $entidade = $this->session->userdata('entidade');
     $email = $this->session->userdata('user_email');

      if(strcasecmp($entidade,'Administrador') == 0 ){
        $this->load->model('Administrador_model','administrador');
        $pessoa = $this->administrador->get_pessoa($email);
      }//Administrador

      if(strcasecmp($entidade,'Professor') == 0 ){
        $this->load->model('Professor_model','professor');
        $pessoa = $this->professor->get_pessoa($email);
      }//Professor

      if(strcasecmp($entidade,'Aluno') == 0 ){
        $this->load->model('Aluno_model','aluno');
        $pessoa = $this->aluno->get_pessoa($email);
      }//Aluno

        /* Registro do logout */
       $dados_registro = array(

      'MENSAGEM' => 'Saindo no Sistema | '.$entidade,
      'ID_PESSOA' => $pessoa[0]['ID'],
      'ID_ENTIDADE' => $pessoa[0]['ID_01'],
      'USER_EMAIL' => $pessoa[0]['EMAIL']

       );

       $retorno = NULL;

       if(strcasecmp($entidade,'Administrador') == 0 )
        $retorno = $this->administrador->registra_login($dados_registro);

       if(strcasecmp($entidade,'Professor') == 0 )
        $retorno = $this->professor->registra_login($dados_registro);

       if(strcasecmp($entidade,'Aluno') == 0 )
        $retorno = $this->aluno->registra_login($dados_registro);

       if(!$retorno)
            log_message('error','Error ao registrar logout no banco de dados');



       $this->session->sess_destroy();
        redirect(base_url('/login'));

    }//logout

}//class
