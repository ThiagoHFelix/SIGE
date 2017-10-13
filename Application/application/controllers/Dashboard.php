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

            
            //Busco avisos para o quadro
            $this->load->model('Aviso_model','aviso');
            $this->load->library('session');
           // die(var_dump($this->aviso->getMyAvisos($this->session->userdata('user_id'))));
            $dados['avisos'] = $this->aviso->getMyAvisos($this->session->userdata('user_id'));
        
            
            //Carregando view
            //Administrador
            if (strcmp($this->session->userdata('entidade'), 'Administrador') == 0):
                $this->load->view('administrador/dashboard',$dados);
            endif;
            //Professor
            if (strcmp($this->session->userdata('entidade'), 'Professor') == 0):
                $this->load->view('professor/dashboard',$dados);
            endif;
            //Aluno
            if (strcmp($this->session->userdata('entidade'), 'Aluno') == 0):
                $this->load->view('aluno/dashboard',$dados);
            endif;


    }//view




    /**
     * Finaliza a sessão
     */
    public function logout() {


     $entidade = $this->session->userdata('entidade');
     $cpf = $this->session->userdata('user_cpf');

      if(strcasecmp($entidade,'Administrador') == 0 ){
        $this->load->model('Administrador_model','administrador');
        $pessoa = $this->administrador->getAdministrador($cpf);
      }//Administrador

      if(strcasecmp($entidade,'Professor') == 0 ){
        $this->load->model('Professor_model','professor');
        $pessoa = $this->professor->getProfessor($cpf);
      }//Professor

      if(strcasecmp($entidade,'Aluno') == 0 ){
        $this->load->model('Aluno_model','aluno');
        $pessoa = $this->aluno->getAluno($cpf);
      }//Aluno

        /* Registro do logout */
       $dados_registro = array(

      'MENSAGEM' => 'Saindo no Sistema | '.$entidade,
      'ID_PESSOA' => $pessoa['ID'],
      'USER_EMAIL' => $pessoa['CPF']

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
