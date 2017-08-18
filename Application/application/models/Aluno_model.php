<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Carrregando interface
$ci =& get_instance();
//FIXIT não está carregando atravez do loader
//$ci->load->iface('Pessoa_interface');

require_once APPPATH .'interfaces/Pessoa_interface.php';

class Aluno_model extends CI_Model implements Pessoa_interface {

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
 $query = 'SELECT * FROM PESSOA,ALUNO WHERE PESSOA.ID = ALUNO.FK_Pessoa_id AND PESSOA.EMAIL = \''.$email.'\'';
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


//Busca pessoa pelo id no banco de dados e retorna um array
public function getPessoaById($id){
    
    $query  = 'SELECT * FROM ALUNO,PESSOA WHERE PESSOA.ID = ALUNO.FK_PESSOA_ID AND ALUNO.ID = '.$id;
   
    
    $resultado = $this->db->query($query);
    
    return $resultado->result_array()[0];
    
}//getPessoaById



//Destroi o objeto
public function __destruct(){}//destruct


}//class
