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
 $query = 'SELECT * FROM PESSOA,PROFESSOR WHERE PESSOA.ID = PROFESSOR.FK_Pessoa_id AND PESSOA.EMAIL = \''.$email.'\'';
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

//Busca pessoa pelo id no banco de dados e retorna um array
public function getPessoaById($id){
    
    $query  = 'SELECT * FROM PROFESSOR,PESSOA WHERE PESSOA.ID = PROFESSOR.FK_PESSOA_ID AND PROFESSOR.ID = '.$id;
   
    
    $resultado = $this->db->query($query);
    
    return $resultado->result_array()[0];
    
}//getPessoaById

//Destroi o objeto
public function __destruct(){}//destruct


}//class
