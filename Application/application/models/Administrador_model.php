<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Carrregando interface
$ci =& get_instance();
//FIXIT não está carregando atravez do loader
//$ci->load->iface('Pessoa_interface');

require_once APPPATH .'interfaces/Pessoa_interface.php';

class Administrador_model extends CI_Model implements Pessoa_interface {



 // Construtor padrão
 public function __construct(){

   parent::__construct();
   $this->load->database();

 }//__construct
 
 /**
  * Atualiza dados na tabela administrador
  * @param type $data
  * @param type $idPessoa
  * @return type
  */
 public function updateAdministrador($data,$idPessoa){
     
   $retorno =  $this->db->update('PESSOA',$data,array('ID' => $idPessoa));
   return $retorno; 
   
 }//updateAdministrador
 
/**
 * Ativa administrador no banco de dados
 * @param int $id
 * @return boolean
 */
public function ativar(int $id){
    
       
    $query = 'UPDATE PESSOA SET PESSOA.STATUS = \'Ativado\' WHERE PESSOA.ID = '.$id; 
    log_message('info','Function ativar - Administrador -> '.$query);
    $retorno = $this->db->query($query);
    
    //log_message
    log_message('info','Table afective -> '.$retorno);
    
    $this->db->close();
    
    if($retorno > 0)
        return TRUE;
    else
        return FALSE;
    
    
}//ativar
 
 //desativa administrador no banco de dados
 public function desativar(int $id){
   
     
    $query = 'UPDATE PESSOA SET PESSOA.STATUS = \'Desativado\' WHERE PESSOA.ID = '.$id; 
    log_message('info','Function desativar - Administrador -> '.$query);
    $retorno = $this->db->query($query);
    
    //log_message
    log_message('info','Table afective -> '.$retorno);
    
    $this->db->close();
    
    if($retorno > 0)
        return TRUE;
    else
        return FALSE;
    
    
 }//desativar

//insere uma pessoa e administrador no banco de dados
 public function insert_pessoa($dados){

  return $this->db->insert('PESSOA',$dados);

 }//insert_pessoa

//insere um administrador no banco de dados
public function insert_adm($dados){

  return $this->db->insert('ADMINISTRADOR',$dados);

}//insert_adm

//Registra o login do usuário
 public function registra_login($dados){

   $this->db->insert('SISTEM_LOG',$dados);

 }//registra login

//Busca administrador no banco de dados, se encontrada retorna um array com seus dados
public function get_pessoa($email){

 $query = 'SELECT * FROM PESSOA,ADMINISTRADOR WHERE PESSOA.ID = ADMINISTRADOR.FK_Pessoa_id AND upper(PESSOA.EMAIL) = upper(\''.$email.'\')';

 $resultado = $this->db->query($query);

 if($resultado->num_rows() > 0){

      return $resultado->result_array();

 }//if

 return NULL;

}//getPessoa

//Busca pessoa no banco de dados, se encontrada retorna um array com seus dados
public function get_pessoa_only($email){

 $query = 'SELECT * FROM PESSOA WHERE PESSOA.EMAIL =\''.$email.'\'';

 $resultado = $this->db->query($query);

 if($resultado->num_rows() > 0){

      return $resultado->result_array();

 }//if

 return NULL;

}//getPessoa

//Retorna um array de array com todos os dados de todas as pessoas no banco de dados
public function get_all_pessoa($offset =  '', $per_page = '',$is_search = FALSE,$dado = '',$coluna = ''){

    if(!$is_search)
         $query  = 'SELECT FIRST '.$per_page.' SKIP '.$offset.' * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID ORDER BY ADMINISTRADOR.ID' ;
    else
         $query  = 'SELECT FIRST '.$per_page.' SKIP '.$offset.'  * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID AND PESSOA.'.$coluna.' LIKE \'%'.$dado.'%\' ORDER BY ADMINISTRADOR.ID' ;


   $resultado = $this->db->query($query);

if($resultado->num_rows() > 0){

    return $resultado->result_array();

}//if

return NULL;

}//get_all_pessoa

//Retorna o total de tuplas do administrador no banco de dados
public function get_total_tupla($dado = '',$coluna = ''){

    if(strcmp($dado, '') == 0 )
         $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID ORDER BY ADMINISTRADOR.ID ASC';
    else
         $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.'.$coluna.' CONTAINING \''.$dado.'\' AND PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID ORDER BY ADMINISTRADOR.ID ASC ';

    $resultado = $this->db->query($query);

    return $resultado->num_rows();

}//get_total_tupla

/**
 * Busca pessoa pelo id no banco de dados e retorna um array
 * @param type $id Identificação do administrador no banco de dados
 * @return type Array com dados do professor ou NULL
 */
public function getPessoaById($id = NULL , $idPessoa = NULL){

    if($idPessoa != NULL)
        $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID AND PESSOA.ID = '.$idPessoa;
    else if($id != NULL)
        $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID AND ADMINISTRADOR.ID = '.$id;

    $resultado = $this->db->query($query);

     if($resultado->num_rows() > 0){

      return $resultado->result_array()[0];

    }//if
    
    else 
        return NULL;

}//getPessoaById

//verifica se o id de pessoa é um administrador
public function isAdministradorById(int $id){
    
    $query = "SELECT * FROM PESSOA,ADMINISTRADOR  WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID AND PESSOA.ID = ".$id;
    
    $retorno = $this->db->query($query);
    
    if($retorno->num_rows() > 0)
        return TRUE;
    else
        return FALSE;
    
}//isAdministradorById

//Destroi o objeto
public function __destruct(){}//destruct


}//class
