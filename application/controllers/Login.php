<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    //Construtor padrão
    public function __construct() {
        parent::__construct();
        
        
        $this->load->helper(array('url', 'funcoes', 'language'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('Login_model', 'Login');
        
        $this->Login->table = 'pessoa';
    }//Construct



    public function index($entidade = 'administrador') {

        
        //Verifico se o usuário já logou 
        if ($this->session->userdata('logged_in') != NULL):
            redirect(base_url('/dashboard'), 'reflesh');
        endif;


        $data['title'] = 'Centro Escolar | Login';
        $data['recovery_pass'] = 'Esqueceu a senha ou email ?';
        $data['button_login'] = 'Logar';
        $data['placeholder_user'] = 'Email';
        $data['placeholder_password'] = 'Senha';

        //Regras de validação
        $this->form_validation->set_rules('username', $data['placeholder_user'], 'trim|required|valid_email');
        $this->form_validation->set_rules('password', $data['placeholder_password'], 'trim|required');

        //Validação dos campos
        if ($this->form_validation->run() == TRUE):
            //Verificação do email
            if ($this->Login->verificData($this->input->post()['username'], 'email', 'pessoa')):
                //Verificação da senha
                if ($this->Login->verificData($this->input->post()['password'], 'senha', 'pessoa')):

                    //Buscando dados do usuário no banco de dados para registar na sessão
                    $pessoa = $this->Login->getDataFromPessoa('WHERE status = 1 and email = \'' . $this->input->post()['username'] . '\'');

                    //Registro de dados na sessão
                    $this->session->set_userdata('user_email', $this->input->post()['username']);
                    $this->session->set_userdata('user_name', $pessoa['primeiroNome'] . ' ' . $pessoa['sobrenome']);
                    $this->session->set_userdata('user_foto', $pessoa['foto']);
                    $this->session->set_userdata('entidade', $entidade);

                    $query = NULL;

                    //verificando se a pessoa logando tem registro como a entidade na qual escolheu 
                    //
                    //ADMINISTRADOR
                    if (strcmp($this->session->userdata('entidade'), 'administrador') == 0):
                        $query = $this->Login->getData('SELECT administrador.id FROM administrador,pessoa WHERE pessoa.id = administrador.FK_Pessoa_id');
                    endif;

                    //PROFESSOR
                    if (strcmp($this->session->userdata('entidade'), 'professor') == 0):
                        $query = $this->Login->getData('SELECT professor.id FROM professor,pessoa WHERE pessoa.id = professor.FK_Pessoa_id');
                    endif;

                    //ALUNO
                    if (strcmp($this->session->userdata('entidade'), 'aluno') == 0):
                        $query = $this->Login->getData('SELECT aluno.id FROM aluno,pessoa WHERE pessoa.id = aluno.FK_Pessoa_id');
                    endif;

                    //Redirecionamento
                    if ($query != NULL):
                        $this->session->set_userdata('logged_in', TRUE);
                        redirect($this->uri->segment(1) . '/dashboard', 'reflesh');
                    endif;



                endif;


            endif;

            //Dados não constram no banco de dados
            $data['inform_login'] = '<p>' . $this->lang->line('invilid_data') . '</p>';


        //Não passando na validação
        else:
            $data['inform_login'] = validation_errors();
        endif;

        $this->load->view('newLogin', $data);
    }//View

    
    
  
    
    
    
    

}//Controller












