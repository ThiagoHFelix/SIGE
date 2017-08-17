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

//Registra o login do usuário
 public function registra_login($dados){

   $this->db->insert('SISTEM_LOG',$dados);

 }//registra login

//Busca pessoa no banco de dados, se encontrada retorna um array com seus dados
public function get_pessoa($email){

 $query = 'SELECT * FROM PESSOA,ADMINISTRADOR WHERE PESSOA.ID = ADMINISTRADOR.FK_Pessoa_id AND PESSOA.EMAIL = \''.$email.'\'';
 
 $resultado = $this->db->query($query);

 if($resultado->num_rows() > 0){

      return $resultado->result_array();

 }//if

 return NULL;

}//getPessoa

//Retorna um array de array com todos os dados de todas as pessoas no banco de dados
public function get_all_pessoa($offset =  '', $per_page = '',$is_search = FALSE,$dado = '',$coluna = ''){

    if(!$is_search)
         $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID ORDER BY ADMINISTRADOR.ID ASC LIMIT '.$offset.','.$per_page;
    else
         $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID ORDER BY ADMINISTRADOR.ID ASC LIMIT '.$offset.','.$per_page.' AND '.$coluna.' LIKE \'%'.$dado.'%\'';
    
    
   $resultado = $this->db->query($query);

if($resultado->num_rows() > 0){

    return $resultado->result_array();

}//if

return NULL;

}//get_all_pessoa

//Retorna o total de tuplas do administrador no banco de dados 
public function get_total_tupla($dado = '',$coluna = ''){
    
    if(strcmp($dado, '') == 0 )
         $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID ';
    else
         $query  = 'SELECT * FROM ADMINISTRADOR,PESSOA WHERE PESSOA.ID = ADMINISTRADOR.FK_PESSOA_ID AND '.$coluna.' LIKE \'%'.$dado.'%\'';
    
    
    $resultado = $this->db->query($query);
    
    return $resultado->num_rows();
    
}//get_total_tupla





//Destroi o objeto
public function __destruct(){}//destruct


}//class
