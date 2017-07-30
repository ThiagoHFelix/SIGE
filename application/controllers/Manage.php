<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * Classe responsável pelo controle de usuário do administrador
 */


class Manage extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Manage_model','manage');
        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session','pagination'));
        
       
    }//construct
    
    
    public function view(){
        
           isSessionStarted();
           
           
           
           //Rodando no banco de dados para setar a variavel de total de resultados do MODEL
           $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id');
           
           
           $config = array(
               
               'base_url' => base_url($this->uri->segment(1).'/manage/administrador'),
               'per_page' => 8,
               'num_links' => 3,
               'uri_segment' => 4,
               'total_rows' => $this->manage->countLastResult
               
           );
           
           //Inicializo a classe de paginação
           $this->pagination->initialize($config);
           
           //Criação do HTML com os links
           $dados['pagination'] = createLinksPagination($config['total_rows'], $config['per_page'], $config['num_links'], $config['base_url'], $config['uri_segment']);
          
           //Carrega dados da tabela
           //$dados['tableAdm'] = $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id  ORDER BY administrador.id ');
           //$this->manage->table = 'pessoa';
           
           $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
           log_message("info", 'OFFSET demonostrado: '.$offset);
          // $dados['tableAdm'] = $this->manage->getDataCI('administrador.id','asc','pessoa.id','administrador.FK_Pessoa_id','','',$config['per_page'],$offset);
           
           $dados['tableAdm'] = $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id ORDER BY administrador.id asc LIMIT '.$offset.','.$config['per_page']);
           
           $this->load->view('/administrador/gerencia/adm_gerencia',$dados);

      
    }//view
    
    
    

    
    /**
     * Carrega o perfil do usuário
     * @param type $userid
     */
    public function userProfile($userid = NULL){
        
        
         isSessionStarted();
        
         //Verificação de parâmetro 
         if(!is_numeric($userid)):
             $this->load->view('error_404');
         else:
            
            $result = $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id and administrador.id = '.$userid);
             //Usuário não existe
             if($result == NULL):
                 $this->load->view('error_404');
            else:
             
             foreach($result as $row):
                 
                 $dados = $row;
                 
             endforeach;
             $this->load->view('/administrador/gerencia/user/adm_userprofile',$dados); 
             
             endif;
         endif;
         
    }//userprofile
    
}//class


