<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    //Construtor padrão
    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url', 'funcoes', 'language'));
        $this->load->library(array('form_validation', 'session'));

    }//Construct

    public function index($entidade = 'administrador') {


        //Validação de parametro
        switch(strtoupper($entidade)){

          case 'ADMINISTRADOR':
          case 'PROFESSOR':
          case 'ALUNO':

          break;

          default: show_404();

        }//switch


        //Verifico se o usuário já logou
        if ($this->session->userdata('logged_in') != NULL):
            redirect(base_url('/dashboard'), 'reflesh');
        endif;

        //Dados da view
        $data['title'] = 'Centro Escolar | Login';
        $data['recovery_pass'] = 'Esqueceu a senha ou email ?';
        $data['button_login'] = 'Logar';
        $data['placeholder_user'] = 'Email';
        $data['placeholder_password'] = 'Senha';

        //Regras de validação
        $this->form_validation->set_rules('username', $data['placeholder_user'], 'trim|required|valid_email');
        $this->form_validation->set_rules('password', $data['placeholder_password'], 'trim|required');

        //Validação dos campos
        if ($this->form_validation->run() == TRUE){

          $email = $this->input->post('username');
          $senha = $this->input->post('password');
          $this->verifica_login($entidade, $email, $senha);

        }//if
        else{
             $this->session->set_flashdata('aviso_login', validation_errors());
        }//else
       
        
        $this->load->view('Login', $data);

    }//View

    // Faz a verificação dos dados de login se corretos retorna true caso constrario false
    public function verifica_login($entidade,$email,$senha){

      switch($entidade){

      case 'administrador' :

            $this->load->model('Administrador_model','administrador');
            if($this->administrador->get_pessoa($senha,$email) != NULL){

              $this->registraDados_session('Administrador');
               redirect(base_url('/dashboard'), 'reflesh');

            }//if
            else{

              $this->session->set_flashdata('aviso_login','Dados de Administrador inválidos');

            }//else

      break;
/*-----------------------------------------------------------------------------------------*/
      case 'professor':

      $this->load->model('Professor_model','professor');
        if($this->professor->get_pessoa($senha,$email) != NULL){

        $this->registraDados_session('Professor');
        redirect(base_url('/dashboard'), 'reflesh');

      }//if
      else{

        $this->session->set_flashdata('aviso_login','Dados de Professor inválidos');

      }//else

      break;
/*------------------------------------------------------------------------------------------*/
      case 'aluno':

      $this->load->model('Aluno_model','aluno');
        if($this->aluno->get_pessoa($senha,$email) != NULL){

        $this->registraDados_session('Aluno');
        redirect(base_url('/dashboard'), 'reflesh');

      }//if
      else{

       $this->session->set_flashdata('aviso_login','Dados de Aluno inválidos');

      }//else

      break;
/*------------------------------------------------------------------------------------------*/
      default:  $this->session->set_flashdata('aviso_login','Entidade inválida');

      }//switch

    }//verifica_login

    // Faz o registro dos dados necessarios na sessão e no banco de dados
    public function registraDados_session($entidade){


      $senha = $this->input->post('password');
      $email = $this->input->post('username');

      if(strcasecmp($entidade,'Administrador') == 0 )
      $pessoa = $this->administrador->get_pessoa($senha,$email);

      if(strcasecmp($entidade,'Professor') == 0 )
      $pessoa = $this->professor->get_pessoa($senha,$email);

      if(strcasecmp($entidade,'Aluno') == 0 )
      $pessoa = $this->aluno->get_pessoa($senha,$email);



      $this->session->set_userdata('user_email', $this->input->post()['username']);
      $this->session->set_userdata('user_name', $pessoa[0]["PRIMEIRONOME"] . ' ' . $pessoa[0]["SOBRENOME"]);
      $this->session->set_userdata('user_foto', $pessoa[0]["FOTO"]);
      $this->session->set_userdata('entidade', $entidade);
      $this->session->set_userdata('logged_in','true');

      //Registrar no banco de dados o login
       $dados_registro = array(

      'MENSAGEM' => 'Entrando no Sistema | '.$entidade,
      'ID_PESSOA' => $pessoa[0]['ID'],
      'ID_ENTIDADE' => $pessoa[0]['ID_01'],
      'USER_EMAIL' => $pessoa[0]['EMAIL']

       );

       if(strcasecmp($entidade,'Administrador') == 0 )
       $this->administrador->registra_login($dados_registro);

       if(strcasecmp($entidade,'Professor') == 0 )
       $this->professor->registra_login($dados_registro);

       if(strcasecmp($entidade,'Aluno') == 0 )
       $this->aluno->registra_login($dados_registro);





    }//registraDados_session





}//Controller
