<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Construtor padrão
     */
    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url', 'funcoes', 'language'));
        $this->load->library(array('form_validation', 'session'));
    }

//Construct

    /**
     * Método inicial
     * @param type $entidade
     */
    public function index($entidade = 'administrador') {


        //Validação de parametro
        switch (strtoupper($entidade)) {
            case 'RECOVER':
                $this->recover();
                break;
            case 'ADMINISTRADOR':
            case 'PROFESSOR':
            case 'ALUNO':
                $this->login($entidade);
                break;

            default: show_404();
        }//switch
    }

//View

    private function login(string $entidade) {


        //Verifico se o usuário já logou
        if ($this->session->userdata('logged_in') != NULL):
            redirect(base_url('/dashboard'), 'reflesh');
        endif;

        //Dados da view
        $data['title'] = 'SIGE | Login';
        $data['recovery_pass'] = 'Esqueceu a senha ou email ?';
        $data['button_login'] = 'Logar';
        $data['placeholder_user'] = 'Email';
        $data['placeholder_password'] = 'Senha';

        //Regras de validação
        $this->form_validation->set_rules('username', $data['placeholder_user'], 'trim|required|valid_email');
        $this->form_validation->set_rules('password', $data['placeholder_password'], 'trim|required');

        //Validação dos campos
        if ($this->form_validation->run() == TRUE) {

            $email = $this->input->post('username');
            $senha = $this->input->post('password');
            $this->verifica_login($entidade, $email, $senha);
        }//if
        else {
            showError('aviso_login', validation_errors(), 'danger');
        }//else


        $this->load->view('Login', $data);
    }

//login

    /**
     * Faz a verificação dos dados de login se corretos retorna true caso constrario false
     * @param type $entidade
     * @param type $email
     * @param type $senha
     */
    private function verifica_login($entidade, $email, $senha) {

        switch ($entidade) {

            case 'administrador' :

                $this->load->model('Administrador_model', 'administrador');
                $resultado = $this->administrador->get_pessoa($email);

                if ($resultado != NULL) {

                    if (strcmp($resultado[0]['SENHA'], $senha) != 0) {
                         showError('aviso_login', 'Dados de Administrador inválidos', 'danger');
                    }//IF | SENHA INCORRETA
                    else {

                        //VERIFICANDO SE A CONTA ESTÁ ATIVADA
                        if (strcmp(strtoupper($resultado[0]['STATUS']), 'ATIVADO') == 0) {

                            $this->registraDados_session('Administrador');
                            redirect(base_url('/dashboard'), 'reflesh');
                        }//IF 
                        else {

                           showError('aviso_login', 'Esta conta está desativada', 'warning');
                        }//ELSE | CONTA ESTÁ DESATIVADA
                    }//else | SENHA CORRETA
                }//if
                else {

                    showError('aviso_login', 'Dados de Administrador inválidos', 'danger');
                }//else

                break;
            /* ----------------------------------------------------------------------------------------- */
            case 'professor':

                $this->load->model('Professor_model', 'professor');
                $resultado = $this->professor->get_pessoa($email);

                if ($resultado != NULL) {

                    if (strcmp($resultado[0]['SENHA'], $senha) != 0) {

                        showError('aviso_login', 'Dados de Professor inválidos', 'danger');
                    }//IF | SENHA INCORRETA
                    else {

                        //VERIFICANDO SE A CONTA ESTÁ ATIVADA
                        if (strcmp(strtoupper($resultado[0]['STATUS']), 'ATIVADO') == 0) {

                            $this->registraDados_session('Professor');
                            redirect(base_url('/dashboard'), 'reflesh');
                        }//IF 
                        else {

                           showError('aviso_login', 'Esta conta está desativada', 'warning');
                        }//ELSE | CONTA ESTÁ DESATIVADA
                    }//else | SENHA CORRETA
                }//if
                else {

                    showError('aviso_login', 'Dados de professor inválidos', 'danger');
                }//else

                break;
            /* ------------------------------------------------------------------------------------------ */
            case 'aluno':

                $this->load->model('Aluno_model', 'aluno');
                $resultado = $this->aluno->get_pessoa($email);

                if ($resultado != NULL) {


                    if (strcmp($resultado[0]['SENHA'], $senha) != 0) {

                       showError('aviso_login', 'Dados de aluno inválidos', 'danger');
                    }//IF | SENHA INCORRETA
                    else {
                        //VERIFICANDO SE A CONTA ESTÁ ATIVADA
                        if (strcmp(strtoupper($resultado[0]['STATUS']), 'ATIVADO') == 0) {

                            $this->registraDados_session('Aluno');
                            redirect(base_url('/dashboard'), 'reflesh');
                        }//IF 
                        else {

                           showError('aviso_login', 'Esta conta está desativada', 'warning');
                        }//ELSE | CONTA ESTÁ DESATIVADA
                    }//ELSE | SENHA CORRETA
                }//if
                else {

                    showError('aviso_login', 'Dados de aluno inválidos', 'danger');
                }//else

                break;
            /* ------------------------------------------------------------------------------------------ */
            default: $this->session->set_flashdata('aviso_login', 'Entidade inválida');
        }//switch
    }//verifica_login



    /**
     * Faz o registro dos dados necessarios na sessão e no banco de dados
     * @param type $entidade
     */
    private function registraDados_session($entidade) {


        $senha = $this->input->post('password');
        $email = $this->input->post('username');

        if (strcasecmp($entidade, 'Administrador') == 0)
            $pessoa = $this->administrador->get_pessoa($email);

        if (strcasecmp($entidade, 'Professor') == 0)
            $pessoa = $this->professor->get_pessoa($email);

        if (strcasecmp($entidade, 'Aluno') == 0)
            $pessoa = $this->aluno->get_pessoa($email);



        $this->session->set_userdata('user_email', $this->input->post()['username']);
        $this->session->set_userdata('user_name', $pessoa[0]["PRIMEIRONOME"] . ' ' . $pessoa[0]["SOBRENOME"]);
        $this->session->set_userdata('user_foto', $pessoa[0]["FOTO"]);
        $this->session->set_userdata('entidade', $entidade);
        $this->session->set_userdata('logged_in', 'true');

        //Registrar no banco de dados o login
        $dados_registro = array(
            'MENSAGEM' => 'Entrando no Sistema | ' . $entidade,
            'ID_PESSOA' => $pessoa[0]['ID'],
            'ID_ENTIDADE' => $pessoa[0]['ID_01'],
            'USER_EMAIL' => $pessoa[0]['EMAIL']
        );

        if (strcasecmp($entidade, 'Administrador') == 0)
            $this->administrador->registra_login($dados_registro);

        if (strcasecmp($entidade, 'Professor') == 0)
            $this->professor->registra_login($dados_registro);

        if (strcasecmp($entidade, 'Aluno') == 0)
            $this->aluno->registra_login($dados_registro);
    }//registraDados_session



    /**
     * Recupera senha 
     */
    public function recover() {

        $retorno = NULL;
        $retorno_update = NULL;


        $this->load->model('Professor_model', 'professor');
        $this->load->model('Aluno_model', 'model');


        $this->form_validation->set_rules('email_recover', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run()) {


            $email = $this->input->post('email_recover');


            $this->load->model('Administrador_model', 'administrador');
            $retorno = $this->administrador->get_pessoa($email);
            if ($retorno != NULL) {
                $this->recoverAdministrador($retorno[0]);
            }//administrador

            $this->load->model('Professor_model', 'professor');
            $retorno = $this->professor->get_pessoa($email);
            if ($retorno != NULL) {
                $this->recoverProfessor($retorno[0]);
            }//professor

            $this->load->model('Aluno_model', 'aluno');
            $retorno = $this->aluno->get_pessoa($email);
            if ($retorno != NULL) {
                $this->recoverAluno($retorno[0]);
            }//aluno
            
            
             showError('aviso_recuperacao', 'Verifique seu email', 'warning');
            
        }//run rules
        else {


            showError('aviso_recuperacao', validation_errors(), 'danger');
        }

       

        $this->load->view('recuperacao_senha');
    }//recover



    /**
     * Realiza os passo necessarios para recuperação de senha de um email de administrador
     * @param array $dados
     */
    private function recoverAdministrador(array $dados) {

        $alter_senha = array(
            "SENHA" => uniqid()
        );

        $retorno_update = $this->administrador->updateAdministrador($alter_senha, $dados['ID']);
        
        //Email encontrado
        if ($retorno_update > 0) {

            //TODO fazer registro de log
            
            $this->enviaEmailRecover($dados['EMAIL'], $alter_senha['SENHA']);
            
            
        }//if | retorno_update
        
        

        $this->administrador->__destruct();
        
    }//recoverAdministrador
    
    
    /**
     * Realiza os passo necessarios para recuperação de senha de um email de professor
     * @param array $dados
     */
    private function recoverProfessor(array $dados){
        
         $alter_senha = array(
            "SENHA" => uniqid()
        );

        $retorno_update = $this->professor->updateProfessor($alter_senha, $dados['ID']);
        
        //Email encontrado
        if ($retorno_update > 0) {

            //TODO fazer registro de log
            
            $this->enviaEmailRecover($dados['EMAIL'], $alter_senha['SENHA']);
            
            
        }//if | retorno_update
        
        

        $this->professor->__destruct();
        
        
    }//recoverProfessor

    
    /**
     * Realiza os passo necessarios para recuperação de senha de um email de aluno
     * @param array $dados
     */
    private function recoverAluno(array $dados){
        
         $alter_senha = array(
            "SENHA" => uniqid()
        );

        $retorno_update = $this->aluno->updateAluno($alter_senha, $dados['ID']);
        
        //Email encontrado
        if ($retorno_update > 0) {

            //TODO fazer registro de log
            
            $this->enviaEmailRecover($dados['EMAIL'], $alter_senha['SENHA']);
            
            
        }//if | retorno_update
        
        

        $this->aluno->__destruct();
        
        
    }//recoverAluno
    
    
    private function enviaEmailRecover(string $email_to,string $newSenha){
        
        
        $this->load->library('email');
        
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        
        
        $this->email->from('thiagoacdc12@gmail.com','SIGE - Sistema Integrado de Gerenciamento Escolar');
        $this->email->to($email_to);
        $this->email->subject('Recuperação de senha - SIGE');
        $this->email->message('Email: '.$email_to.' Nova Senha: '.$newSenha);
        
        $this->email->send();
     
                
    
        
    }//enviaEmailRecover
    
    
}//Controller


