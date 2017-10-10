<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Professor_model extends CI_Model  {


 /**
  * Construtor padrão
  */
 public function __construct(){

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

 }//__construct

 /**
  * Atualiza dados do Professor
  * @param type $dados Dados do Professor, ou seja, Colunas e dados
  * @param type $id Id do Professor 
  * @return type TRUE or FALSE
  */
 public function updateProfessor(int $dados,int $id){

   $retorno =  $this->db->update('PESSOA',$dados,array('ID' => $id));
   return $retorno;

 }//updateProfessor
 
/**
 * Ativa Professor no banco de dados
 * @param int $id ID do Professor
 * @return boolean TRUE or FALSE
 */
public function ativar(int $id){

    $this->db->where(array( 'ID' => $id, 'PESSOA_TIPO' => 'PROFESSOR' ));
    $retorno = $this->db->update('PESSOA',array( 'STATUS' => 'ATIVADO'));
   
   
    if($retorno > 0)
        return TRUE;
    else
        return FALSE;


}//ativar

 /**
  * Desativa Professor no banco de dados
  * @param int $id ID do Professor
  * @return boolean TRUE or FALSE
  */
 public function desativar(int $id){


  $this->db->where(array( 'ID' => $id, 'PESSOA_TIPO' => 'PROFESSOR' ));
    $retorno = $this->db->update('PESSOA',array( 'STATUS' => 'DESATIVADO'));
   
   
    if($retorno > 0)
        return TRUE;
    else
        return FALSE;



 }//desativar

 /**
  * Inseri Professor no banco de dados
  * @param type $dados Dados do Professor, ou seja, Colunas e dados
  * @return type TRUE or FALSE
  */
 public function insert($dados){

  return $this->db->insert('PESSOA',$dados);

 }//insert_pessoa


/**
 * Faz o registro de login do Professor no banco de dados
 * @param type $dados Dados do login, ou seja, Colunas e dados
 */
 public function registra_login($dados){

   $this->db->insert('SISTEM_LOG',$dados);

 }//registra login

/**
 * Busca Professor no banco de dados com o mesmo email
 * @param string $email Email a ser buscado
 * @return type Array se o Professor for encontrado
 */
public function getProfessor(string $email){

    $this->db->where(array( 'EMAIL' => strtoupper($email), 'PESSOA_TIPO' => 'PROFESSOR' ));
    
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0)
        return $return->result_array()[0];
    else
        return NULL;
    
}//getProfessor

/**
 * Busca todos os Professores no banco de dados
 * @param type $offset Em qual resultado deve começar
 * @param type $per_page Quantos resultados devem ser retornados
 * @return type Array se algo for encontado, NULL caso contrario
 */
public function getAll($offset =  '', $per_page = ''){

    $this->db->where('PESSOA_TIPO','PROFESSOR');
    $this->db->order_by('ID','ASC');
    $return = $this->db->get('PESSOA',$per_page,$offset);
    
    if($return->num_rows() > 0)
        return $return->result_array();
    else
        return NULL;
 
}//getAll

/**
 * Busca a quantidade de Professores no banco de dados
 * @return type Quantidade de Professores no banco de dados
 */
public function getAllTupla(){

   $this->db->where('PESSOA_TIPO','PROFESSOR');
   return $this->db->count_all('PESSOA');

}//getAllTupla

/**
 * Busca Professor no banco de dados com o id inserido
 * @param integer $id ID do Professor a ser procurado
 * @return type Retorna NULL se nada for encontrador e uma matriz se for encontrado
 */
public function getProfessorById(int $id){
   
    $this->db->where(array( 'ID' => $id, 'PESSOA_TIPO' => 'PROFESSOR' ));
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0)
        return $return->result_array()[0];
    else
        return NULL;
    

}//getProfessorById

/**
 * verifica se o id é de um Professor
 * @param int $id ID a ser procurado
 * @return boolean TRUE se for um Professor e FALSE se não for 
 */
public function isProfessorById(int $id){

    $return = $this->getProfessorById($id);

    if($return == NULL)
        return FALSE;
    else
        return TRUE;
    
}//isProfessorById

//Destroi o objeto
public function __destruct(){}//destruct

}//class
