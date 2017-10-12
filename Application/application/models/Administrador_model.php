<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_model extends CI_Model  {



 // Construtor padrão
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

 }//__construct

 /**
  * Atualiza dados na tabela administrador
  * @param type $data
  * @param type $idPessoa
  * @return type
  */
 public function update(array $data,string $cpf){

   $retorno =  $this->db->update('PESSOA',$data,array('CPF' => $cpf,'PESSOA_TIPO' => 'ADMINISTRADOR'));
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

//Cria um novo adminstrador no banco de dados
 public function insert($dados){

  return $this->db->insert('PESSOA',$dados);

 }//insert_pessoa

 
 public function insertEmail(array $dados){
     
     return $this->db->insert('EMAIL',$dados);

 }//insertEmail
 
 public function insertTelefone($dados){
     
     return $this->db->insert('TELEFONE',$dados);
     
 }//insertTelefone
 
 /**
  * Retorna o ultimo ID da tabela pessoa do banco de dados
  * @return type
  */
 public function lastID(){
    
     return $this->db->query('SELECT GEN_ID(GN_PESSOA,0) FROM RDB$DATABASE')->result_array()[0]['GEN_ID'];
     
 }//lastID

//Registra o login do usuário
 public function registra_login($dados){

   $this->db->insert('SISTEM_LOG',$dados);

 }//registra login
 
 
 
 

//Busca administrador no banco de dados, se encontrada retorna um array com seus dados
public function getAdministrador(string $cpf){

    $dados_where = array(
        
        'CPF' => $cpf,
        'PESSOA_TIPO' => 'ADMINISTRADOR'
    );
   
    $this->db->where($dados_where);
    
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0)
        return $return->result_array()[0];
    else
        return NULL;
    
}//getPessoa


//Retorna um array de array com todos os dados de todas os administrador do banco de dados
public function getAll($offset =  '', $per_page = ''){

    $this->db->where('PESSOA_TIPO','ADMINISTRADOR');
    $this->db->order_by('ID','ASC');
    $return = $this->db->get('PESSOA',$per_page,$offset);
    
    if($return->num_rows() > 0)
        return $return->result_array();
    else
        return NULL;
 
}//getAll

//Retorna o total de tuplas do administrador no banco de dados
public function getAllTupla(){

   $this->db->where('PESSOA_TIPO','ADMINISTRADOR');
   return $this->db->get('PESSOA')->num_rows();

}//getAllTupla

/**
 * Busca administrador no banco de dados com o id inserido
 * @param integer $id ID do administrador a ser procurado
 * @return type Retorna NULL se nada for encontrador e uma matriz se for encontrado
 */
public function getAdministradorById(int $id){

   
   
    $this->db->where( array( 'ID' => $id, 'PESSOA_TIPO' => 'ADMINISTRADOR'  ));
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0)
        return $return->result_array()[0];
    else
        return NULL;
    

}//getAdministradorById

/**
 * verifica se o id é de um administrador
 * @param int $id ID a ser procurado
 * @return boolean TRUE se for um administrador e FALSE se não for 
 */
public function isAdministradorById(int $id){

    $return = $this->getAdministradorById($id);

    if($return == NULL)
        return FALSE;
    else
        return TRUE;
    
}//isAdministradorById



/**
 * Faz a verificaçao no banco de dados se o CPF informado ja existe
 * @param string $cpf CPF a ser buscado no banco de dados
 * @return boolean TRUE se existe, caso contrario FALSE
 */
public function verificaCPF(string $cpf)
{
    
    $this->db->where(array('CPF' => $cpf, 'PESSOA_TIPO' => 'ADMINISTRADOR' ));
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0):
        return TRUE;
    else:
        return FALSE;
    endif;
    
}//verificaCPF
/**
 * Retorna o ultimo codigo SQL executado
 * @return type Codigo SQL
 */
public function last_query()
{
   return $this->db->last_query();
}//last_query


//Destroi o objeto
public function __destruct(){}//destruct


}//class
