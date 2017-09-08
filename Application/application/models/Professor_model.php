<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Carrregando interface
$ci =& get_instance();
//FIXIT não está carregando atravez do loader
//$ci->load->iface('Pessoa_interface');

require_once APPPATH .'interfaces/Pessoa_interface.php';

class Professor_model extends CI_Model implements Pessoa_interface {
    

 /**
  * Construtor padrão
  */
 public function __construct(){

   parent::__construct();
   $this->load->database();

 }//__construct

 
 /**
  * Retorna o total de tuplas do professor no banco de dados
  * @param type $dado
  * @param type $coluna
  * @return type
  */
public function get_total_tupla($dado = '',$coluna = ''){

    if(strcmp($dado, '') == 0 )
         $query  = 'SELECT * FROM PROFESSOR,PESSOA WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID ORDER BY PROFESSOR.ID ASC';
    else
         $query  = 'SELECT * FROM PROFESSOR,PESSOA WHERE PESSOA.'.$coluna.' CONTAINING \''.$dado.'\' AND PESSOA.ID = PROFESSOR.FK_PESSOA_ID ORDER BY PROFESSOR.ID ASC ';

    $resultado = $this->db->query($query);

    return $resultado->num_rows();

}//get_total_tupla

//Busca pessoa no banco de dados, se encontrada retorna um array com seus dados
public function get_pessoa_only($email){

 $query = 'SELECT * FROM PESSOA WHERE PESSOA.EMAIL =\''.$email.'\'';

 $resultado = $this->db->query($query);

 if($resultado->num_rows() > 0){

      return $resultado->result_array();

 }//if

 return NULL;

}//getPessoa
    
/**
 * insere um professor no banco de dados
 * @param type $dados
 * @return type
 */
public function insert_professor($dados){

  return $this->db->insert('PROFESSOR',$dados);

}//insert_professor

 /**
  * insere uma pessoa e professor no banco de dados
  * @param type $dados
  * @return type
  */
 public function insert_pessoa($dados){

  return $this->db->insert('PESSOA',$dados);

 }//insert_pessoa
 
/**
 * Registra o login do usuário
 * @param type $dados
 */
 public function registra_login($dados){

   $this->db->insert($dados);

 }//registra login

/**
 * Busca pessoa no banco de dados que são professores, se encontrada retorna um array com seus dados
 * @param type $email
 * @return type
 */
public function get_pessoa($email){
 $query = 'SELECT * FROM PESSOA,PROFESSOR WHERE PESSOA.ID = PROFESSOR.FK_Pessoa_id AND upper(PESSOA.EMAIL) = upper(\''.$email.'\')';
 $resultado = $this->db->query($query);

 if($resultado->num_rows() > 0){

      return $resultado->result_array();

 }//if

 return NULL;

}//getPessoa

//Retorna um array de array com todos os dados de todas as pessoas no banco de dados
public function get_all_pessoa($offset =  '', $per_page = '',$is_search = FALSE,$dado = '',$coluna = ''){

    if(!$is_search)
         $query  = 'SELECT FIRST '.$per_page.' SKIP '.$offset.' * FROM PROFESSOR,PESSOA WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID ORDER BY PROFESSOR.ID' ;
    else
         $query  = 'SELECT FIRST '.$per_page.' SKIP '.$offset.'  * FROM PROFESSOR,PESSOA WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID AND PESSOA.'.$coluna.' LIKE \'%'.$dado.'%\' ORDER BY PROFESSOR.ID' ;


   $resultado = $this->db->query($query);

if($resultado->num_rows() > 0){

    return $resultado->result_array();

}//if

return NULL;

}//get_all_pessoa

/**
 * Busca pessoa pelo id no banco de dados e retorna um array
 * @param type $id Identificação do professor no banco de dados
 * @return type Array com dados do professor ou NULL
 */
public function getPessoaById($id = NULL , $idPessoa = NULL){

    if($idPessoa != NULL)
        $query  = 'SELECT * FROM PROFESSOR,PESSOA WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID AND PESSOA.ID = '.$idPessoa;
    else if($id != NULL)
        $query  = 'SELECT * FROM PROFESSOR,PESSOA WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID AND PROFESSOR.ID = '.$id;

    $resultado = $this->db->query($query);

     if($resultado->num_rows() > 0){

      return $resultado->result_array()[0];

    }//if
    
    else 
        return NULL;

}//getPessoaById

/**
 * verifica se o id de pessoa é um professor
 * @param int $id
 * @return boolean
 */
public function isProfessorById(int $id){
    
    $query = "SELECT * FROM PESSOA,PROFESSOR  WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID AND PESSOA.ID = ".$id;
    
    $retorno = $this->db->query($query);
    
    if($retorno->num_rows() > 0)
        return TRUE;
    else
        return FALSE;
    
}//isProfessorById


 /**
  * Atualiza dados na tabela professor
  * @param type $data
  * @return type
  */
 public function updateProfessor($data,$idPessoa){
     
   $retorno =  $this->db->update('PESSOA',$data,array('ID' => $idPessoa));
   return $retorno; 
   
 }//updateProfessor

 
 
 /**
 * Ativa professor no banco de dados
 * @param int $id
 * @return boolean
 */
public function ativar(int $id){
    
       
    $query = 'UPDATE PESSOA SET PESSOA.STATUS = \'Ativado\' WHERE PESSOA.ID = '.$id; 
    log_message('info','Function ativar - Professor -> '.$query);
    $retorno = $this->db->query($query);
    
    //log_message
    log_message('info','Table afective -> '.$retorno);
    
    $this->db->close();
    
    if($retorno > 0)
        return TRUE;
    else
        return FALSE;
    
    
}//ativar
 
 

 /**
  * desativa professor no banco de dados
  * @param int $id
  * @return boolean
  */
 public function desativar(int $id){
   
     
    $query = 'UPDATE PESSOA SET PESSOA.STATUS = \'Desativado\' WHERE PESSOA.ID = '.$id; 
    log_message('info','Function desativar - Professor -> '.$query);
    $retorno = $this->db->query($query);
    
    //log_message
    log_message('info','Table afective -> '.$retorno);
    
    $this->db->close();
    
    if($retorno > 0)
        return TRUE;
    else
        return FALSE;
    
    
 }//desativar

//Destroi o objeto
public function __destruct(){}//destruct


}//class
