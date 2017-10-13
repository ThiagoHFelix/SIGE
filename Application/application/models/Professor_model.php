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
  * Retorna o ultimo ID da tabela pessoa do banco de dados
  * @return type
  */
 public function lastID(){
    
    return $this->db->query('SELECT GEN_ID(GN_PESSOA,0) FROM RDB$DATABASE')->result_array()[0]['GEN_ID'];
     
 }//lastID

  public function insertEmail(array $dados){
     
     return $this->db->insert('EMAIL',$dados);

 }//insertEmail
 
 public function insertTelefone($dados){
     
     return $this->db->insert('TELEFONE',$dados);
     
 }//insertTelefone
 
 
/**
 * Faz a verificaçao no banco de dados se o CPF informado ja existe
 * @param string $cpf CPF a ser buscado no banco de dados
 * @return boolean TRUE se existe, caso contrario FALSE
 */
public function verificaCPF(string $cpf)
{
    
    $this->db->where(array('CPF' => $cpf, 'PESSOA_TIPO' => 'PROFESSOR' ));
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0):
        return TRUE;
    else:
        return FALSE;
    endif;
    
}//verificaCPF
 
 /**
  * Atualiza dados do Professor
  * @param type $dados Dados do Professor, ou seja, Colunas e dados
  * @param string $cpf CPF do Professor 
  * @return type TRUE or FALSE
  */
 public function update(array $dados,string $cpf){

   return $this->db->update('PESSOA',$dados,array('CPF' => $cpf,'PESSOA_TIPO' => 'PROFESSOR'));

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
 * @param string $cpf CPF a ser buscado
 * @return type Array se o Professor for encontrado
 */
public function getProfessor(string $cpf){

    $this->db->where(array( 'CPF' => $cpf, 'PESSOA_TIPO' => 'PROFESSOR' ));
    
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
   return $this->db->get('PESSOA')->num_rows();

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
