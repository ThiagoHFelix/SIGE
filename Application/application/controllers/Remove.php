<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Remove extends CI_Controller{
    
    
    
    
    
    public function __construct(){
        
        parent::__construct();
        $this->load->helper(array('funcoes','url'));
        
    }//construct
    
    
    public function aviso(int $id){
        
        $this->load->model('Aviso_model', 'aviso');

        if (!$this->exists('AVISO', $id)):
            log_message('error', 'AVISO INSERIDO NAO EXISTE NO BANCO DE DADOS AVISO ID=>' . $id);
            show_404();
        endif;

        //Deleto todas as relaçoes do aviso
        if ($this->aviso->delete('AVISO_PESSOA', array('FK_AVISO_ID' => $id)) !== FALSE):

            if ($this->aviso->delete('AVISO', array('ID' => $id)) !== FALSE):
                showError('mensagem_manageAviso', 'Aviso removido com sucesso', 'success');
            else:
                showError('mensagem_manageAviso', 'Erro ao remover o Aviso <strong> Se o problema persistir contate o administrador </strong>', 'danger');
                log_message('error', 'Erro ao remover o AVISO ID=>' . $id);
            endif;

        else:
            showError('mensagem_manageAviso', 'Erro ao remover o Aviso <strong> Se o problema persistir contate o administrador </strong>', 'danger');
            log_message('error', 'Erro ao remover relaçoes do AVISO ID=>' . $id);
        endif;

        redirect(base_url('/manage/aviso'));
    }//aviso
    
    
    
     /**
     * Verifica se uma entidade existe no banco de dados
     * @param string $entidade Qual o tipo de entidade 
     * @param string $dado DADO da entidade
     * @return boolean TRUE a pessoa existe no banco de dados, FALSE a pessoa nao existe ou entidade invalida
     */
    private function exists(string $entidade,string $dado) {
        
        
        
        switch (strtoupper($entidade)) {


          /*  case 'ADMINISTRADOR':
                $return = $this->administrador->getAdministrador($cpf);
            break;
                
            case 'ALUNO':
                $return = $this->aluno->getAluno($cpf);
            break;
        
            case 'PROFESSOR':
                $return = $this->professor->getProfessor($cpf);
            break;*/
            
            case 'AVISO':
                $return = $this->aviso->getAviso($dado);
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

