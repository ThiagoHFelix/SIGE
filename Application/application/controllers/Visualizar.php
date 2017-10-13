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
    
   public function aviso(int $id){
       
       
    $this->load->model('Aviso_model','aviso');
    
    if($this->exists('AVISO',$id)):
        
        
        $this->load->view('/administrador/manage/visualizar/info_aviso',$this->aviso->getAviso((int)$id)); 
    else:
        show_404();
    endif;
       
       
      
       
   }//aviso 
   
   private function exists(string $entidade,$id) {
        
       
        switch (strtoupper($entidade)) {


            case 'ADMINISTRADOR':
                $return = $this->administrador->getAdministrador($id);
            break;
                
            case 'ALUNO':
                $return = $this->aluno->getAluno($id);
            break;
        
            case 'PROFESSOR':
                $return = $this->professor->getProfessor($id);
            break;
        
            case 'AVISO':
                $return = $this->aviso->getAviso((int)$id);
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
