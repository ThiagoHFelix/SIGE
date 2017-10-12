<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cadastro extends CI_Controller{
    
     
    
      /**
     * Construtor padrão
     */
    public function __construct() {

        parent::__construct();
        
        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session', 'pagination'));
        $this->load->helper('funcoes');
        $this->load->model('administrador_model', 'administrador');
        $this->load->model('professor_model', 'professor');
        $this->load->model('aluno_model', 'aluno');
        
        isSessionStarted();
        
    }//construtor padrao
    
    
    
    public function materia(){
        
        

        $this->load->library(array('form_validation', 'session'));
        $this->load->model('materia_model', 'materia');


        //Declaração de variaveis
        $dados = NULL;

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('apresentacao', '"Apresentação"', 'trim|max_length[250]');
        $this->form_validation->set_rules('titulo', '"Titulo"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('objetivo', '"Objetivo"', 'trim|max_length[250]');
        $this->form_validation->set_rules('ementa', '"Ementa"', 'trim|max_length[250]');
        $this->form_validation->set_rules('bibliografia', '"Bibliografia"', 'trim|max_length[250]');

        //inicio a verificação da regras
        if ($this->form_validation->run()) {


            $dados = array(
                'TITULO' => $this->input->post('titulo'),
                'APRESENTACAO' => "" . $this->input->post('apresentacao'),
                'OBJETIVO' => "" . $this->input->post('objetivo'),
                'EMENTA' => "" . $this->input->post('ementa'),
                'BIBLIOGRAFIA' => "" . $this->input->post('bibliografia'),
                'STATUS' => 'Ativado',
                'MATERIAL' => "",
                'EXTRACLASSE' => "" . $this->input->post('extraclasse')
            );

            $retorno = $this->materia->insert($dados);

            if ($retorno) {

                $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Matéria cadastrada com sucesso </div> ');
                redirect(base_url('/manage/materia'));
            }//if
            else {
                
            }//else
        }//validation
        else {

            if (strcmp(validation_errors(), '') == 0) {
                //Limpo a mensagem de erro
                $this->session->set_flashdata('mensagem_usuario', '');
            }//if
            else {
                $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
            ' . validation_errors() . '
            </div> ');
            }//else
        }//validation


        $this->load->view('/administrador/manage/cadastro/cadastro_materia');

        
    }//materia
    
    public function curso(){
        
        
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('materia_model', 'materia');
        $this->load->model('curso_model', 'curso');


        //Declaração de variaveis
        $dados = NULL;

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('titulo', '"Titulo"', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('descricao', '"Descriçao do Curso"', 'trim|max_length[62]');
        $this->form_validation->set_rules('duracao', '"Duraçao do curso"', 'trim|max_length[62]');
        $this->form_validation->set_rules('vagas', '"Vagas"', 'trim|max_length[62]');
        $this->form_validation->set_rules('carga_horaria', '"Carga Horaria"', 'trim|max_length[62]');



        //inicio a verificação da regras
        if ($this->form_validation->run())
        {
            //Verificando se o titulo existe no banco de dados
            $titulo_post = $this->input->post('titulo');

            echo 'Carregando...';

            $return = $this->curso->getAll();
            //Corresponde a existencia do titulo no banco de dados
            $existe = FALSE;
            
            foreach ($return as $curso) {

                if (strcmp(strtoupper($curso['TITULO']), strtoupper($titulo_post)) == 0) {

                    $existe = TRUE;

                    $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-warning">
                        Este titulo já existe, por favor tente outro !
                        </div> ');

                    break;
                }//if
               
                
            }//foreach

            //Titulo nao existe no banco de dados
            if (!$existe) {
                
                
                
                $dados = array(
                    
                 'TITULO' => $this->input->post('titulo'),
                 'STATUS' => 'Ativado',
                 'DESCRICAO' => "DESCRIÇAO DO CURSO <br/>".$this->input->post('descricao')."<br/> DURAÇAO DO CURSO <br/>".$this->input->post('duracao').
                 "<br/> VAGAS <br/>".$this->input->post('vagas')."<br/> CARGA HORARIA <br/>".$this->input->post('carga_horaria') 
                    
                    
                    
                );
                
                //Inserindo curso
                $return = $this->curso->insert($dados);
                if($return)
                {
                    
                    //Buscando o id da Materia inserida
                    $tituloCurso = $this->input->post('titulo');
                    $return = $this->curso->getWhere(array('TITULO' => $tituloCurso));
                    $idCurso = $return[0]['ID'];
                    
                    
                    
                    $materias =  $this->input->post('materia');
                    
            
                    foreach($materias as $materia)
                    {
                        
                        $return = $this->curso->insertRelacao(array(  'FK_MATERIA_ID' =>  $materia, 'FK_CURSO_ID' => $idCurso ));
                        //Erro ao inserir
                        if(!$return)
                        {
                           
                            $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
                            Ocorreu um erro na tentativa de cadastro de relaçao do Curso <strong> Contate o administrador </strong>
                             </div> ');
                            
                            //Registrar log
                            
                        }//if
                        
                    }//foreach
                    
                    
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Curso cadastrado com sucesso </div> ');
                    redirect(base_url('/manage/curso'));
                    
                }//if
                else
                {
                    
                    $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
                    Ocorreu um erro na tentativa de cadastro de curso <strong> Contate o administrador </strong>
                  </div> ');
                    
                }//else
                
                
            }//if
        }//validation
        else {

            if (strcmp(validation_errors(), '') == 0) {
                //Limpo a mensagem de erro
                $this->session->set_flashdata('mensagem_usuario', '');
            }//if
            else {
                $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
                  ' . validation_errors() . '
                  </div> ');
            }//else
        }//validation

        $dados['Mate'] = $this->materia->getAll();
        $this->load->view('/administrador/manage/cadastro/cadastro_curso', $dados);
        
    }//curso
    
    
    /**
     * Cadastra um novo administrador no banco de dados
     */
    public function administrador() {
        
        $returnValidacao = $this->validacaoPessoa();
        if ($returnValidacao !== NULL) {
                
            
            //Verifico se CPF ja existe no banco de dados
            $cpf = $this->input->post('cpf');
            $return = $this->administrador->verificaCPF($cpf);
            if (!$return) {

                $returnData = $this->insertData('ADMINISTRADOR', $returnValidacao);
                if ($returnData) {
                    showError('mensagem_manage', 'Administrador cadastrado com sucesso', 'success');
                    redirect(base_url() . 'manage/administrador');
                }//if    
                else {
                    showError('mensagem_usuario', 'Não foi possível cadastrar o administrador no banco de dados <strong> CONTATE O ADMINISTRADOR </strong>', 'danger');
                }//else
            }//if
            else{
            showError('mensagem_usuario', 'O CPF inserido já existe, por favor insira outro', 'warning');
            }//else
            
        }//if
           
        
        //Carregamento da view de cadastro
        $this->load->view('administrador/manage/cadastro/cadastro_administrador');
        
        
        
    }//administrador
    /**
     * Cadastra um novo professor no banco de dados
     */
    public function professor() {
        
        $returnValidacao = $this->validacaoPessoa();
        if ($returnValidacao !== NULL) {
                
            
            //Verifico se CPF ja existe no banco de dados
            $cpf = $this->input->post('cpf');
            $return = $this->professor->verificaCPF($cpf);
            if (!$return) {

                $returnData = $this->insertData('PROFESSOR', $returnValidacao);
                if ($returnData) {
                    showError('mensagem_manage', 'Professor cadastrado com sucesso', 'success');
                    redirect(base_url() . 'manage/professor');
                }//if    
                else {
                    showError('mensagem_usuario', 'Não foi possível cadastrar o Professor<strong> CONTATE O ADMINISTRADOR </strong>', 'danger');
                }//else
            }//if
            else{
                showError('mensagem_usuario', 'O CPF inserido já existe, por favor insira outro', 'warning');
            }//else
            
        }//if
           
        
        //Carregamento da view de cadastro
        $this->load->view('administrador/manage/cadastro/cadastro_professor');
        
        
        
    }//professor
    
    /**
     * Cadastra um novo aluno no banco de dados
     */
    public function aluno() {
        
        $returnValidacao = $this->validacaoPessoa();
        if ($returnValidacao !== NULL) {
            
            //Verifico se CPF ja existe no banco de dados
            $cpf = $this->input->post('cpf');
            $return = $this->aluno->verificaCPF($cpf);
            if (!$return) {

                $returnData = $this->insertData('ALUNO', $returnValidacao);
                if ($returnData) {
                    showError('mensagem_manage', 'Aluno cadastrado com sucesso', 'success');
                    redirect(base_url() . 'manage/aluno');
                }//if    
                else {
                    showError('mensagem_usuario', 'Não foi possível cadastrar o aluno no banco de dados <strong> CONTATE O ADMINISTRADOR </strong>', 'danger');
                }//else
            }//if
            else{
            showError('mensagem_usuario', 'O CPF inserido já existe, por favor insira outro', 'warning');
            }//else
            
        }//if
           
        
        //Carregamento da view de cadastro
        $this->load->view('administrador/manage/cadastro/cadastro_aluno');
        
        
        
    }//aluno


    /**
     * Validaçao de dados de pessoas
     * @return type Retorna string com o local da imagem de perfil,NULL no caso de falha
     */        
    private function validacaoPessoa() {

        

        $this->load->library(array('form_validation', 'session'));
        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required|max_length[9]');
        $this->form_validation->set_rules('estado', '"Estado"', 'min_length[2]|max_length[2]');
        $this->form_validation->set_rules('rua', '"Rua"', 'max_length[20]');
        $this->form_validation->set_rules('cep', '"CEP"', 'max_length[9]');
        $this->form_validation->set_rules('bairro', '"Bairro"', 'max_length[20]');
        $this->form_validation->set_rules('cidade', '"Cidade"', 'max_length[20]');
        $this->form_validation->set_rules('cpf', '"CPF"', 'max_length[14]');
        $this->form_validation->set_rules('rg', '"RG"', 'max_length[15]');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');
        $this->form_validation->set_rules('telefone', '"Telefone"', 'max_length[13]');


        //inicio a verificação da regras
        if ($this->form_validation->run()) {

                $returnImage = $this->insertImage();

                if ($returnImage !== NULL) {
                    return $returnImage;
                } else {
                    $errors = $this->upload->display_errors();
                    showError('mensagem_usuario', $errors, 'danger');
                }//else
           

        }//if | Validação de dados
        else {
            
            showError('mensagem_usuario', validation_errors(), 'danger');
            return NULL;
        }// Dados não validados
        
        
        
    }//validacaoPessoa


   /**
    * Insere os dados de uma pessoa no banco de dados
    * @param string $entidade Qual tipo de pessoa
    * @param string $localImagem Local da imagem de perfil
    * @return type TRUE em caso de sucesso, FALSE em caso de falha e NULL se a entidade nao existir
    */
   private function insertData(string $entidade, string $localImagem)
   {
       
        $dados = array(
            
                        'PRIMEIRONOME' => $this->input->post('primeiroNome'),
                        'SOBRENOME' => $this->input->post('sobrenome'),
                        'NASCIMENTO' => $this->input->post('nascimento'),
                        'STATUS' => 'Ativado',
                        'ESTADO' => $this->input->post('estado'),
                        'RUA' => $this->input->post('rua'),
                        'CEP' => $this->input->post('cep'),
                        'BAIRRO' => $this->input->post('bairro'),
                        'CIDADE' => $this->input->post('cidade'),
                        'SENHA' => $this->input->post('senha'),
                        'SEXO' => $this->input->post('sexo'),
                        'CPF' => $this->input->post('cpf'),
                        'RG' => $this->input->post('rg'),
                        'FOTO' => $localImagem,
                        'PESSOA_TIPO' => strtoupper($entidade)
        );

        
        
        

        switch(strtoupper($entidade))
        {
            
            case 'ADMINISTRADOR':
               return $this->insertAdministrador($dados);
            
           
            case 'ALUNO':
               return $this->insertAluno($dados);
            
            
            case 'PROFESSOR':
               return $this->insertProfessor($dados);
            
            
            default:return NULL;
            
            
        }//switch
        
        
        
       
   }//insereDados
    
   
   /**
    * Insere dados do Administrador no banco de dados
    * @return boolean
    */
   private function insertAdministrador(array $dados){
       
        if ($this->administrador->insert($dados)) {

            if ($this->administrador->insertEmail(array('EMAIL' => $this->input->post('email'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->administrador->lastID()))) {


                if ($this->administrador->insertTelefone(array('NUMERO' => $this->input->post('telefone'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->administrador->lastID()))) {
                     log_message('debug','Tabela PESSOA,EMAIL e TELEFONE inseridas com sucesso no cadastro do administrador inserido com sucesso');
                    return TRUE;
                }//if
                else{
                    log_message('error','Erro ao inserir TELEFONE do Administrador no banco de dados');
                    return FALSE;
                }//else
                
            }//if
            else{
                log_message('error','Erro ao inserir EMAIL do Administrador no banco de dados');
                return FALSE;
            }//else
            
        }//if
        else{
            log_message('error','Erro ao inserir Administrador no banco de dados');
            return FALSE;
        }//else
        
        
    }//insertAdministrador
   
   /**
    * Insere dados do Professor no banco de dados
    * @return boolean
    */
   private function insertProfessor(array $dados){
       
        if ($this->professor->insert($dados)) {

            if ($this->professor->insertEmail(array('EMAIL' => $this->input->post('email'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->professor->lastID()))) {


                if ($this->professor->insertTelefone(array('NUMERO' => $this->input->post('telefone'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->professor->lastID()))) {
                     log_message('debug','Tabela PESSOA,EMAIL e TELEFONE inseridas com sucesso no cadastro do professor inserido com sucesso');
                    return TRUE;
                }//if
                else{
                    log_message('error','Erro ao inserir TELEFONE do Professor no banco de dados');
                    return FALSE;
                }//else
                
            }//if
            else{
                log_message('error','Erro ao inserir EMAIL do Professor no banco de dados');
                return FALSE;
            }//else
            
        }//if
        else{
            log_message('error','Erro ao inserir Professor no banco de dados');
            return FALSE;
        }//else
        
        
    }//insertProfessor
   
   /**
    * Insere dados do Aluno no banco de dados
    * @return boolean
    */
   private function insertAluno(array $dados){
       
        if ($this->aluno->insert($dados)) {

            if ($this->aluno->insertEmail(array('EMAIL' => $this->input->post('email'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->aluno->lastID()))) {


                if ($this->aluno->insertTelefone(array('NUMERO' => $this->input->post('telefone'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->aluno->lastID()))) {
                     log_message('debug','Tabela PESSOA,EMAIL e TELEFONE inseridas com sucesso no cadastro do aluno inserido com sucesso');
                    return TRUE;
                }//if
                else{
                    log_message('error','Erro ao inserir TELEFONE do Aluno no banco de dados');
                    return FALSE;
                }//else
                
            }//if
            else{
                log_message('error','Erro ao inserir EMAIL do Aluno no banco de dados');
                return FALSE;
            }//else
            
        }//if
        else{
            log_message('error','Erro ao inserir Aluno no banco de dados');
            return FALSE;
        }//else
        
        
    }//insertAluno
   
   
   /**
    * Faz o upload da imagem 
    * @return type Local da imagem em case de sucesso, NULL em caso de falha
    */
   private function insertImage(){

           //Configuração do upload da imagem
            $config['file_name'] = uniqid() . '-' . time();
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 160;
            $config['max_height'] = 160;
            $this->load->library('upload', $config);
            
            
            
            if ($this->upload->do_upload('imagem')) {
                
                return base_url('/user_img/' . $this->upload->data()['file_name']);
                
            }//if 
            else {
                
                //Imagem nao inserida
                if(strcmp($this->upload->display_errors(),'<p>Você não selecionou o arquivo para fazer upload.</p>') != 0){
                   
                    showError('mensagem_usuario',  $this->upload->display_errors(), 'danger');
                    return NULL;
                    
                }//if
                else{
                    return base_url('/user_img/avatar.png'); 
                }//else
                 
                
            }//else
            
            
    }//insertImage
    
}//class
