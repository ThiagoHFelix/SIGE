<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faltas_model extends CI_Model{
    
    
    /**
     * Construtor padrao
     */
    public function __construct() {
        parent::__construct();
        
               //Conectando a base de dados
        /***************************************************/
           $this->load->library('session');
           $database = $this->session->userdata('database');

           if($database !=  NULL)
                        $this->load->database($database);
            else
                        $this->load->database();
        /***************************************************/
    }//construct
    
    

    public function getAll(int $idTurma,$offset =  '', $per_page = ''){
        
        
        $this->db->where(array('FK_TURMA_ID = '.$idTurma));
         $this->db->order_by('FK_TURMA_ID','ASC');
        $notas = $this->db->get('FREQUENTA',$per_page,$offset);
        
        if($notas->num_rows() > 0):
            return $notas->result_array();
        else:
            return NULL;
        endif;
        
    }//getAll
    
    
    
    /**
     * Retorna a quantidade de tuplas existentes no banco de dados
     * @return type
     */
    public function getAllTupla(int $idTurma){
        
        $this->db->where(array('FK_TURMA_ID = '.$idTurma));
        return $this->db->get('FREQUENTA')->num_rows();
        
        
    }//getAllTupla
    
    
    
 public function query($query){
     
      $return = $this->db->query($query);
     
     if($return->num_rows() > 0):
         return $return->result_array();
     else:
         return NULL;
     endif;
     
     
 }
 
 
    /**
     * Insere uma frequencia no banco de dados
     * @param array $dados
     * @return type
     */
  public function insert(array $dados){
    return  $this->db->insert('FREQUENTA',$dados);
  }//insert
  
 
}//class