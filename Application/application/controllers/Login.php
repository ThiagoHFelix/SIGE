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


        //Default database
        $this->session->set_userdata('database','test_linux');



    }//construct



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
    }//View



    private function login(string $entidade) {


        //Verifico se o usuário já logou
        if ($this->session->userdata('logged_in') != NULL):
            redirect(base_url('/dashboard'), 'reflesh');
        endif;

        //Dados da view
        $data['title'] = 'SIGE | Login';
        $data['recovery_pass'] = 'Esqueceu a senha ?';
        $data['button_login'] = 'Logar';
        $data['placeholder_user'] = 'CPF';
        $data['placeholder_password'] = 'Senha';

        //Regras de validação
        $this->form_validation->set_rules('username', $data['placeholder_user'], 'trim|required|max_length[14]|min_length[14]');
        $this->form_validation->set_rules('password', $data['placeholder_password'], 'trim|required|max_length[20]');

        //Validação dos campos
        if ($this->form_validation->run() == TRUE) {

            $cpf = $this->input->post('username');
            $senha = $this->input->post('password');
            $this->verifica_login($entidade, $cpf, $senha);
            
        }//if
        else {
             setMessege('aviso_login',validation_errors());
           // showError('aviso_login', validation_errors(), 'danger');
        }//else


        $this->load->view('Login', $data);
    }//login



    /**
     * Faz a verificação dos dados de login se corretos retorna true caso constrario false
     * @param type $entidade
     * @param type $cpf
     * @param type $senha
     */
    private function verifica_login(string $entidade,string $cpf,string $senha) {

        switch ($entidade) {

            case 'administrador' :

                $this->load->model('Administrador_model', 'administrador');
                $resultado = $this->administrador->getAdministrador($cpf);

                if ($resultado != NULL) {

                    if (strcmp($resultado['SENHA'], $senha) != 0) {
                        showMessegeModal('aviso_login','Falha ao logar como Administrador','CPF ou senha de Administrador está incorreto','red');
                    }//IF | SENHA INCORRETA
                    else {

                        //VERIFICANDO SE A CONTA ESTÁ ATIVADA
                        if (strcmp(strtoupper($resultado['STATUS']), 'ATIVADO') == 0) {

                            $this->registraDadosSession('Administrador');
                            redirect(base_url('/dashboard'), 'reflesh');
                        }//IF
                        else {
                             showMessegeModal('aviso_login','Falha ao logar como Administrador','Esta conta está desativada','red');
                        }//ELSE | CONTA ESTÁ DESATIVADA
                        
                    }//else | SENHA CORRETA
                }//if
                else {
                     showMessegeModal('aviso_login','Falha ao logar como Administrador','CPF ou senha de Administrador está incorreto','red');
                }//else

                break;
            /* ----------------------------------------------------------------------------------------- */
            case 'professor':

                $this->load->model('Professor_model', 'professor');
                $resultado = $this->professor->getProfessor($cpf);

                if ($resultado != NULL) {

                    if (strcmp($resultado['SENHA'], $senha) != 0) {
                        showMessegeModal('aviso_login','Falha ao logar como Professor','CPF ou senha do Professor está incorreto','red');
                    }//IF | SENHA INCORRETA
                    else {

                        //VERIFICANDO SE A CONTA ESTÁ ATIVADA
                        if (strcmp(strtoupper($resultado['STATUS']), 'ATIVADO') == 0) {

                            $this->registraDadosSession('Professor');
                            redirect(base_url('/dashboard'), 'reflesh');
                        }//IF
                        else {
                          showMessegeModal('aviso_login','Falha ao logar como Professor','Esta conta está desativada','red');
                        }//ELSE | CONTA ESTÁ DESATIVADA
                    }//else | SENHA CORRETA
                }//if
                else {
                    showMessegeModal('aviso_login','Falha ao logar como Professor','CPF ou senha do Professor está incorreto','red');
                }//else

                break;
            /* ------------------------------------------------------------------------------------------ */
            case 'aluno':

                $this->load->model('Aluno_model', 'aluno');
                $resultado = $this->aluno->getAluno($cpf);

                if ($resultado != NULL) {


                    if (strcmp($resultado['SENHA'], $senha) != 0) {
                        showMessegeModal('aviso_login','Falha ao logar como Aluno','CPF ou senha de Aluno está incorreto','red');
                    }//IF | SENHA INCORRETA
                    else {
                        //VERIFICANDO SE A CONTA ESTÁ ATIVADA
                        if (strcmp(strtoupper($resultado['STATUS']), 'ATIVADO') == 0) {

                            $this->registraDadosSession('Aluno');
                            redirect(base_url('/dashboard'), 'reflesh');
                        }//IF
                        else {
                            showMessegeModal('aviso_login','Falha ao logar como Aluno','Esta conta está desativada','red');
                      }//ELSE | CONTA ESTÁ DESATIVADA
                    }//ELSE | SENHA CORRETA
                }//if
                else {
                    showMessegeModal('aviso_login','Falha ao logar como Aluno','CPF ou senha de Aluno está incorreto','red');
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
    private function registraDadosSession($entidade) {


        $senha = $this->input->post('password');
        $cpf = $this->input->post('username');

        if (strcasecmp($entidade, 'Administrador') == 0):
            $pessoa = $this->administrador->getAdministrador($cpf);
        endif;
            

        if (strcasecmp($entidade, 'Professor') == 0):
             $pessoa = $this->professor->getProfessor($cpf);
        endif;
           

        if (strcasecmp($entidade, 'Aluno') == 0):
            $pessoa = $this->aluno->getAluno($cpf);
        endif;
        
       // die(var_dump($pessoa));
            


        $this->session->set_userdata('user_cpf', $this->input->post()['username']);
        $this->session->set_userdata('user_name', $pessoa["PRIMEIRONOME"] . ' ' . $pessoa["SOBRENOME"]);
        $this->session->set_userdata('user_foto', $pessoa["FOTO"]);
        $this->session->set_userdata('entidade', $entidade);
        $this->session->set_userdata('user_id', $pessoa['ID']);
        $this->session->set_userdata('logged_in', 'true');
        
        //BUSCO TITULO DO CURSO
        $this->load->model('Curso_model', 'curso');
        $curso = $this->curso->getWhere(array('ID' => $pessoa['FK_CURSO_ID']));
        $this->session->set_userdata('titulo_curso', $curso[0]['TITULO']);
        $this->session->set_userdata('id_curso', $pessoa['FK_CURSO_ID']);
        $this->session->set_userdata('status_matricula', $curso[0]['STATUS']);
        
        
        //Registrar no banco de dados o login
        $dados_registro = array(
            'MENSAGEM' => 'Entrando no Sistema | ' . $entidade,
            'ID_PESSOA' => $pessoa['ID'],
            'USER_EMAIL' => $pessoa['CPF']
        );

        if (strcasecmp($entidade, 'Administrador') == 0):
             $this->administrador->registra_login($dados_registro);
        endif;
           

        if (strcasecmp($entidade, 'Professor') == 0):
            $this->professor->registra_login($dados_registro);
        endif;
            

        if (strcasecmp($entidade, 'Aluno') == 0):
            $this->aluno->registra_login($dados_registro);
        endif;
            
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
            $retorno = $this->administrador->getAdministrador($email);
            if ($retorno != NULL) {
                $this->recoverAdministrador($retorno[0]);
            }//administrador

            $this->load->model('Professor_model', 'professor');
            $retorno = $this->professor->getProfessor($email);
            if ($retorno != NULL) {
                $this->recoverProfessor($retorno[0]);
            }//professor

            $this->load->model('Aluno_model', 'aluno');
            $retorno = $this->aluno->getAluno($email);
            if ($retorno != NULL) {
                $this->recoverAluno($retorno[0]);
            }//aluno

            setMessege('aviso_recuperacao','Verifique seu email');
            // showError('aviso_recuperacao', '', 'warning');

        }//run rules
        else {
            setMessege('aviso_recuperacao',validation_errors());
           // showError('aviso_recuperacao', validation_errors(), 'danger');
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

    /**
     * Envia o email para a conta com os novos dados
     * @param string $email_to Email a ser recuperado
     * @param string $newSenha
     */
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
