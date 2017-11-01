<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Turma_model extends CI_Model{
    
    public function __construct(){
        
        parent::__construct();
    
           //Conectando a base de dados
   /***************************************************/
      $this->load->library('session');
      $database = $this->session->userdata('database');

      if($database !=  NULL)
                   $this->load->database($database);
       else
                   $this->load->database('');
   /***************************************************/
        
    }//construct
            
//Retorna o total de tuplas da turma no banco de dados
public function getAllTupla(){

  
   return $this->db->get('TURMA')->num_rows();

}//getAllTupla
            

 // Busca no banco de dados com WHERE, se nada for encontrado retorno NULL
    public function getWhere(array $dados){

      $this->db->where($dados);
      $retorno = $this->db->get('TURMA');

      if($retorno->num_rows() > 0)
        return $retorno->result_array();
      else
        return NULL;


    }//getWhere


    /**
     * Busca todos as turmas
     * @return type
     */
    public function getAll(int $per_page = 0,int $offset = 0){
        
         $this->db->order_by('ID','ASC');
        $retorno = $this->db->get('TURMA',$per_page,$offset);

        if ($retorno->num_rows() > 0):
            return $retorno->result_array();
        else:
            return NULL;
        endif;
        
    }//getAll
    
    
    
    /**
     * Busca todos os turnos
     * @return type
     */
    public function getAllTurno(){
        
        $retorno = $this->db->get('TURNO');

        if ($retorno->num_rows() > 0):
            return $retorno->result_array();
        else:
            return NULL;
        endif;
        
    }//getAllTurno
    
    
    public function insert(array $dados){
        
        return $this->db->insert('TURMA',$dados);
        
    }//insert
    
    /**
  * Retorna o ultimo ID do generator GN_DIA_SEMANA do banco de dados
  * @return type
  */
 public function lastIdDiaSemana(){
    
     return $this->db->query('SELECT GEN_ID(GN_DIA_SEMANA,0) FROM RDB$DATABASE')->result_array()[0]['GEN_ID'];
     
 }//lastID
    
    public function insertDiaSemana(array $dados){
        
        
        return $this->db->insert('DIA_SEMANA',$dados);
        
        
    }//inserDiaSemana
    
    public function insertRelacao(array $dados){
        
        
        return $this->db->insert('DIA_TURMA',$dados);
        
        
    }//inserDiaSemana
    
    /**
     * Remove uma turma do banco de dados
     * @param int $id
     * @return type TRUE no sucesso, FALSE no fracasso
     */
    public function remove(int $id){
        
        $this->db->where(array('ID' => $id));
        return $this->db->remove('TURMA');
        
    }//remove 
    
  /**
  * Retorna o ultimo ID do generator GN_TURMA do banco de dados
  * @return type
  */
 public function lastID(){
    
     return $this->db->query('SELECT GEN_ID(GN_TURMA,0) FROM RDB$DATABASE')->result_array()[0]['GEN_ID'];
     
 }//lastID
    
    
    /**
     * Destroi o atual objeto
     */
    public function __destruct(){}
    
}//class