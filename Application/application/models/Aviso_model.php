<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aviso_model extends CI_Model  {

    
    /**
     * Construtor padrao
     */
    public function __construct(){
        
        parent::__construct();
        
    //Conectando a base de dados
   /***************************************************/
        $this->load->library('session');
        $database = $this->session->userdata('database');

        if ($database != NULL) {
            $this->load->database($database);
        }//if
        else {
            $this->load->database('');
        }//else
    /***************************************************/
        
    }//construct
    
    
    
    
    public function delete(string $table,array $where){
        
        $this->db->where($where);
        return $this->db->delete($table);
        
    }//delete
    
    
    /**
     * Insere os dados na tebela aviso
     * @param array $data Array com os dados
     * @return type TRUE or FALSE
     */
    public function insert(array $data){
        
        $return = $this->db->insert('AVISO',$data);
        if($return):
            log_message('debug','Aviso inserido no banco de dados com sucesso ===> '.implode(',',$data));
            return TRUE;
        else:
            log_messege('error','Erro ao inserir Aviso no banco de dados ===> '.implode(',',$data));
            return FALSE;
        endif;
        
    }//insert
    
    /**
     * Insere dados na tabela AVISO_PESSOA
     * @param array $data Array com Dados da tabela
     * @return boolean TRUE on success or FALSE 
     */
    public function insertRelation(array $data){
        
         $return = $this->db->insert('AVISO_PESSOA',$data);
        if($return):
            log_message('debug','AVISO_PESSOA inserido no banco de dados com sucesso ===> '.implode(',',$data));
            return TRUE;
        else:
            log_messege('error','Erro ao inserir AVISO_PESSOA no banco de dados ===> '.implode(',',$data));
            return FALSE;
        endif;
        
        
    }//insertRelation
    
    
  /**
  * Retorna o ultimo ID do GENERETOR GN_AVISO do banco de dados
  * @return type
  */
 public function lastID(){
    
     return $this->db->query('SELECT GEN_ID(GN_AVISO,0) FROM RDB$DATABASE')->result_array()[0]['GEN_ID'];
     
 }//lastID
    
 /**
  * Retorna o total de tuplas da tabela AVISO no banco de dados
  * @return int Numero de tuplas
  */
public function getAllTupla(){

   return $this->db->get('AVISO')->num_rows();

}//getAllTupla
 
 /**
  * Retorna todos os aviso
  * @return type
  */
 public function getAll(int $offset = 0,int $per_page = 0){
     
     $return = $this->db->get('AVISO',$per_page,$offset);
     
     if($return->num_rows() > 0):
         log_message('debug','Todos os Avisos foram encontrados ==> '.implode(',', $return->result_array()[0]));
         return $return->result_array();
     else:
         log_message('debug','Nenhum administrador foi encontrado');
         return NULL;
     endif;
     
 }//getAll
    
    
 public function getAviso(int $id){
     
     $this->db->where(array('ID' => $id));
     $return = $this->db->get('AVISO');
     
     if($return->num_rows() > 0):
         log_message('debug','function getAviso => Aviso encontrado ==> '.implode(',', $return->result_array()[0]));
         return $return->result_array()[0];
     else:
         log_message('debug','function getAviso  => Aviso nao encontrado ');
         return NULL;
     endif;
     
 }//getAviso   
 
 
 
 public function getMyAvisos(int $id){
     
     
     $return = $this->db->query('SELECT * FROM AVISO,AVISO_PESSOA WHERE  AVISO_PESSOA.FK_PESSOA_ID = '.$id.' AND AVISO.ID = AVISO_PESSOA.FK_AVISO_ID');
     if($return->num_rows() > 0):
         log_message('debug','function getMyAvisos => Aviso encontrado ==> '.implode(',', $return->result_array()[0]));
         return $return->result_array();
     else:
         log_message('debug','function getMyAvisos  => Aviso nao encontrado ');
         return NULL;
     endif;
     
 }//getMyAvisos
 
 
}//class