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
 public function registra_login($table,$dados){

   $this->db->insert($table,$dados);

 }//registra login

//Busca pessoa no banco de dados, se encontrada retorna um array com seus dados
public function get_pessoa($senha,$email){
  
 $query = 'SELECT * FROM PESSOA,ADMINISTRADOR WHERE PESSOA.ID = ADMINISTRADOR.FK_Pessoa_id AND PESSOA.SENHA = \''.$senha.'\' AND PESSOA.EMAIL = \''.$email.'\'';
 $resultado = $this->db->query($query);

 if($resultado->num_rows() > 0){

      return $resultado->result_array();

 }//if

 return NULL;

}//getPessoa

//Retorna um array de array com todos os dados de todas as pessoas no banco de dados
public function get_all_pessoa(){

$resultado = $this->db->get('pessoa');

if($resultado->new_rows() > 0){

    return $resultado->result_array();

}//if

return NULL;

}//get_all_pessoa


//Destroi o objeto
public function __destruct(){}//destruct


}//class
