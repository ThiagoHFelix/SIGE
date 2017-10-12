<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller
{
    
    
    /**
     * Construtor padrao
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('administrador_model','administrador');
        $this->load->model('professor_model','professor');
        $this->load->model('aluno_model','aluno');
        $this->load->helper(array('funcoes','url'));
        
        
    }//construct
    
    
    /**
     * Atualiza os dados do administrador
     * @param string $cpf
     */
    public function administrador(string $cpf)
    {
        if ($this->exists('Administrador', $cpf)) {
            
            $data = $this->validacaoPessoa();
            if($data !== NULL){
                
                
                $data['PESSOA_TIPO'] = 'ADMINISTRADOR';
                $returnUpdate = $this->updateData('ADMINISTRADOR',$data,$cpf);
                if($returnUpdate){
                    showError('mensagem_userprofile','Dados de administrador atualizados com sucesso','success');
                    redirect(base_url('/visualizar/administrador/'.$cpf));
                }//if
                
            }//if
            
            
            //Carregamento da view 
            $this->load->view('administrador/manage/alter/alter_administrador');
            
        }//if        
        else{
            show_404();
        }//else
        
        
        
    }//administrador
    
    /**
     * Atualiza os dados de um aluno
     * @param string $cpf CPF do aluno
     */
    public function aluno(string $cpf)
    {
        if ($this->exists('Aluno', $cpf)) {
            
            $data = $this->validacaoPessoa();
            if($data !== NULL){
                
                
                $data['PESSOA_TIPO'] = 'ALUNO';
                $returnUpdate = $this->updateData('ALUNO',$data,$cpf);
                if($returnUpdate){
                    showError('mensagem_userprofile','Dados de aluno atualizados com sucesso','success');
                    redirect(base_url('/visualizar/aluno/'.$cpf));
                }//if
                
            }//if
            
            
            //Carregamento da view 
            $this->load->view('administrador/manage/alter/alter_aluno');
            
        }//if        
        else{
            show_404();
        }//else
        
        
        
    }//aluno
   
    /**
     * Atualiza os dados de um professor
     * @param string $cpf CPF do professor
     */
     public function professor(string $cpf)
    {
        if ($this->exists('Professor', $cpf)) {
            
            $data = $this->validacaoPessoa();
            if($data !== NULL){
                
                
                $data['PESSOA_TIPO'] = 'PROFESSOR';
                $returnUpdate = $this->updateData('PROFESSOR',$data,$cpf);
                if($returnUpdate){
                    showError('mensagem_userprofile','Dados de professor atualizados com sucesso','success');
                    redirect(base_url('/visualizar/professor/'.$cpf));
                }//if
                
            }//if
            
            
            //Carregamento da view 
            $this->load->view('administrador/manage/alter/alter_professor');
            
        }//if        
        else{
            show_404();
        }//else
        
        
        
    }//professor
    
    
    /**
     * Validaçao de dados de pessoas
     * @return type Retorna string com o local da imagem de perfil,NULL no caso de falha
     */        
    private function validacaoPessoa() {


        $this->load->library(array('form_validation', 'session'));
        $data = $this->setRulesPessoa();
        
        //Verifica se foi inserida
        $return = $this->updateImage();
        if ($return != NULL) {
            $data['FOTO'] = $return;
        }//if

        if($data === NULL){
          //  showError('mensagem_usuario','', '');
            return NULL;
        }//if
        
        
        //inicio a verificação da regras
        if ($this->form_validation->run() || isset($data['FOTO'])) {
            
            
            return $data;
            
            
        }//if | Validação de dados
        else {
            
            showError('mensagem_usuario', validation_errors(), 'danger');
            return NULL;
        }// Dados não validados
        
        
        
    }//validacaoPessoa
    
    /**
     * Atualiza os dados de uma pessoa no banco de dados
     * @param string $entidade Qual o tipo de pessoa
     * @param array $data Dados a serem atualizados
     * @param string $cpf CPF da pessoa
     * @return type TRUE no sucesso e FALSE em falha
     */
   private function updateData(string $entidade,array $data,string $cpf)
   {
       
    

        switch(strtoupper($entidade))
        {
            
            
            case 'ADMINISTRADOR':
                return $this->administrador->update($data,$cpf);
            
            case 'ALUNO':
                return $this->aluno->update($data,$cpf);
            
            case 'PROFESSOR':
                return $this->professor->update($data,$cpf);
            
            default:return NULL;
            
            
        }//switch
        
        
        
       
   }//updateData
    
   /**
    * Faz o update da imagem
    * @return type Retorna o local da imagem ou NULL em caso de falha ou caso a imagem nao tenha sido inserida
    */
   private function updateImage(){

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
                 
                
            }//else
            
            
            
            
            
       
    }//updateImage
    
   /**
    * Define as regras de formuario somente se o dado foi inserido
    * @return type Array com os dados, em caso de nenhum dado inserido retorna NULL
    */
   private function setRulesPessoa(){
        
        //Dados para inserir no banco de dados
        $data = NULL;
       
        //Criando regras para a validação do formulário
        if($this->input->post('primeiroNome') != NULL){
           
            $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|max_length[25]');
            $data['PRIMEIRONOME'] = $this->input->post('primeiroNome');
        }//if
        if($this->input->post('sobrenome') != NULL){
            $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|max_length[60]');
            $data['SOBRENOME'] = $this->input->post('sobrenome');
        }//if
        if($this->input->post('sexo') != NULL){
            $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|max_length[9]');
            $data['SEXO'] = $this->input->post('sexo');
        }//if
        if($this->input->post('estado') != NULL){
            $this->form_validation->set_rules('estado', '"Estado"', 'min_length[2]|max_length[2]');
            $data['ESTADO'] = $this->input->post('estado');
        }//if
        if($this->input->post('rua') != NULL){
            $this->form_validation->set_rules('rua', '"Rua"', 'max_length[20]');
            $data['RUA'] = $this->input->post('rua');
        }//if
        if($this->input->post('cep') != NULL){
            $this->form_validation->set_rules('cep', '"CEP"', 'max_length[9]');
            $data['CEP'] = $this->input->post('cep');
        }//if
        if($this->input->post('bairro') != NULL){
            $this->form_validation->set_rules('bairro', '"Bairro"', 'max_length[20]');
            $data['BAIRRO'] = $this->input->post('bairro');
        }//if
        if($this->input->post('cidade') != NULL){
            $this->form_validation->set_rules('cidade', '"Cidade"', 'max_length[20]');
            $data['CIDADE'] = $this->input->post('cidade');
        }//if
        if($this->input->post('cpf') != NULL){
            $this->form_validation->set_rules('cpf', '"CPF"', 'max_length[14]');
            $data['CPF'] = $this->input->post('cpf');
        }//if
        if($this->input->post('rg') != NULL){
            $this->form_validation->set_rules('rg', '"RG"', 'max_length[15]');
            $data['RG'] = $this->input->post('rg');
        }//if
        if($this->input->post('nascimento') != NULL){
            $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|max_length[10]|min_length[10]');
            $data['NASCIMENTO'] = $this->input->post('nascimento');
        }//if
        if($this->input->post('senha') != NULL){
            $this->form_validation->set_rules('senha', '"Senha"', 'trim|max_length[20]|min_length[5]');
            $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|max_length[20]|min_length[5]|matches[senha]');
            $data['SENHA'] = $this->input->post('senha');
        }//if
        if($this->input->post('senha') != NULL){
            $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');
        }//if
        if($this->input->post('senha') != NULL){
            $this->form_validation->set_rules('telefone', '"Telefone"', 'max_length[13]');
        }//if
        
       

        return $data;
        
   }//setRulesPessoa
    
    /**
     * Verifica se uma pessoa existe no banco de dados
     * @param string $entidade Qual o tipo de pessoa 
     * @param string $cpf CPF da pessoa
     * @return boolean TRUE a pessoa existe no banco de dados, FALSE a pessoa nao existe ou entidade invalida
     */
    private function exists(string $entidade,string $cpf) {
        
       
        switch (strtoupper($entidade)) {


            case 'ADMINISTRADOR':
                $return = $this->administrador->getAdministrador($cpf);
            break;
                
            case 'ALUNO':
                $return = $this->aluno->getAluno($cpf);
            break;
        
            case 'PROFESSOR':
                $return = $this->professor->getProfessor($cpf);
            break;
        
            default:return FALSE;
                
                
        }//switch
        
        if($return !== NULL)
        {
            return TRUE;
        }//IF
        
        return FALSE;
        
        
    }//exists


}//class

