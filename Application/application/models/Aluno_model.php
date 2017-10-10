<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends CI_Model{

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
                   $this->load->database();
   /***************************************************/

 }//__construct

 
/**
 * Atualiza dados do Aluno
 * @param array $data Dados do aluno, ou seja, Colunas e dados
 * @param int $id ID do Aluno
 * @return type TRUE or FALSE
 */
 public function updateAluno(array $data,int $id){

   $retorno =  $this->db->update('PESSOA',$data,array('ID' => $id));
   return $retorno;

 }//updateAluno
 
 
 //Registra o login do usuário
  public function registra_login($dados){

    $this->db->insert('SISTEM_LOG',$dados);

  }//registra login
  
/**
 * Busca todos os Alunos no banco de dados
 * @param type $offset Em qual resultado deve-se começar
 * @param type $per_page Quantos resultados devem ser retornados
 * @return type Array se algo for encontrado, NULL caso contrario
 */
public function getAll($offset =  '', $per_page = ''){

    $this->db->where('PESSOA_TIPO','ALUNO');
    $this->db->order_by('ID','ASC');
    $return = $this->db->get('PESSOA',$per_page,$offset);
    
    if($return->num_rows() > 0)
        return $return->result_array();
    else
        return NULL;
 
}//getAll

/**
 * Busca aluno no banco de dados com o mesmo email informado
 * @param string $email Email a ser procurado no banco de dados
 * @return type Array caso o aluno for encontrado, NULL caso contrario
 */
public function getAluno(string $email){
    
    $dados_where = array( 'EMAIL' => strtoupper($email) , 'PESSOA_TIPO' => 'ALUNO');
    $this->db->where($dados_where);
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0)
        return $return->result_array();
    else
        return NULL;
    

}//getAluno

/**
 * Busca Aluno no banco de dados com o mesmo id 
 * @param int $id ID a ser procurado no banco de dados
 * @return type Array se for encontrado, NULL caso contrario
 */
public function getAlunoById(int $id){

    $this->db->where(array( 'ID' => $id, 'PESSOA_TIPO' => 'ALUNO' ));
    $return = $this->db->get('PESSOA');
    
    if($return->num_rows() > 0)
        return $return->result_array()[0];
    else
        return NULL;
    

}//getPessoaById


/**
 * Retorna o total de tuplas do aluno no banco de dados
 * @return type Quantidade de tuplas no banco de dados
 */
public function getAllTupla(){

     $this->db->where('PESSOA_TIPO','ALUNO');
     return $this->db->count_all('PESSOA');

}//getAllTupla

/**
 * Verifica se o id de pessoa é um ALUNO
 * @param int $id ID do Aluno
 * @return boolean TRUE or FALSE
 */
public function isAlunoById(int $id){
    
    $return = $this->getAlunoById($id);

    if($return == NULL)
        return FALSE;
    else
        return TRUE;
    
}//isAlunoById

/**
 * Insere aluno no banco de dados
 * @param type $dados Dados do aluno ou seja, valores das colunas da tabela
 * @return type TRUE or False
 */
 public function insert($dados){

  return $this->db->insert('PESSOA',$dados);

 }//insert

/**
 * Ativa aluno no banco de dados
 * @param int $id
 * @return boolean
 */
public function ativar(int $id){


    $query = 'UPDATE PESSOA SET PESSOA.STATUS = \'Ativado\' WHERE PESSOA.ID = '.$id;
    log_message('info','Function ativar - Aluno -> '.$query);
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
  * desativa aluno no banco de dados
  * @param int $id
  * @return boolean
  */
 public function desativar(int $id){


    $query = 'UPDATE PESSOA SET PESSOA.STATUS = \'Desativado\' WHERE PESSOA.ID = '.$id;
    log_message('info','Function desativar - Aluno -> '.$query);
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
