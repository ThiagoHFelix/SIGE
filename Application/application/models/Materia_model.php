<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class  Materia_model extends CI_Model{



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

    }//Cosntrutor padrão


    //Insere dados na tabela materia
    public function insert(array $dados){

      return  $this->db->insert('MATERIA',$dados);

    }//insert

    
            
 public function query($query){
     
      $return = $this->db->query($query);
     
     if($return->num_rows() > 0):
         return $return->result_array();
     else:
         return NULL;
     endif;
     
     
 }
    
    
    /**
     * Retorna a quantidade de tuplas da tabela matéria
     */
    public function getAllTupla(){

        return $this->db->count_all('MATERIA');

    }//getAllTupla

    //retorna todas as tuplas da tabela matéria
    public function getAll($limit = NULL, $offset = NULL){

      $retorno = $this->db->get('MATERIA', $limit, $offset);

        if ($retorno->num_rows() > 0):
            return $retorno->result_array();
        else:
            return NULL;
        endif;
        
    }//getAll

    // Busca no banco de dados com WHERE, se nada for encontrado retorno NULL
    public function getWhere(array $dados){

      $this->db->where($dados);
      $retorno = $this->db->get('MATERIA');

      if($retorno->num_rows() > 0)
        return $retorno->result_array();
      else
        return NULL;


    }//getWhere

    //Desativa matéria no banco de dados
    public function desativar(int $id){

      $dados_where = array('ID' => $id );
      $dados_update = array( 'STATUS' => "DESATIVADO" );

      $this->db->where($dados_where);
      return $this->db->update('MATERIA',$dados_update);

    }//desativar

    //Ativa matéria no banco de dados
    public function ativar(int $id){

      $dados_where = array('ID' => $id );
      $dados_update = array( 'STATUS' => 'ATIVADO' );

      $this->db->where($dados_where);
      return $this->db->update('MATERIA',$dados_update);

    }//desativar


    //Atualiza infomações da Matéria no banco de dados
    public function updateWhere(array $dados_update,array $dados_where){

        $this->db->where($dados_where);
        return $this->db->update('MATERIA',$dados_update);

    }//update




}//class
