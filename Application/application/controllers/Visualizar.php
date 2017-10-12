<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visualizar extends CI_Controller
{
    
    public function __construct(){
        
        parent::__construct();
        $this->load->helper(array('url', 'funcoes'));
        
        
    }//construtor
    
    
  

    
    
    public function administrador(string $cpf){
        
        $this->load->model('Administrador_model', 'administrador');
        $resultado = $this->administrador->getAdministrador($cpf);
        $dados = $resultado;
        $dados['entidade'] = 'Administrador';

        $this->load->view('administrador/manage/visualizar/userprofile', $dados);
        
    }//administrador
    
   public function professor(string $cpf){
       
        $this->load->model('Professor_model', 'professor');
        $resultado = $this->professor->getProfessor($cpf);
        $dados = $resultado;
        $dados['entidade'] = 'Professor';

        $this->load->view('administrador/manage/visualizar/userprofile', $dados);
        
    }//professor
    
   public function aluno(string $cpf){
       
        $this->load->model('Aluno_model', 'aluno');
        $resultado = $this->aluno->getAluno($cpf);
        $dados = $resultado;
        $dados['entidade'] = 'Aluno';

        $this->load->view('administrador/manage/visualizar/userprofile', $dados);
    }//aluno
    
    
    
    
    
    
    
    
    
    
}//class
