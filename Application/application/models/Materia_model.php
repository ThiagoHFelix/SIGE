<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class  Materia_model extends CI_Model{



    /**
     * Construtor padrão
     */
    public function __construct(){

        $this->load->database();

    }//Cosntrutor padrão


    //Insere dados na tabela materia
    public function insert(array $dados){

      return  $this->db->insert('MATERIA',$dados);

    }//insert



    /**
     * Retorna a quantidade de tuplas da tabela matéria
     */
    public function getAllTupla(){

        return $this->db->count_all('MATERIA');

    }//getAllTupla

    //retorna todas as tuplas da tabela matéria
    public function getAll($limit = NULL, $offset = NULL){

      $retorno = $this->db->get('MATERIA',$limit,$offset);
      return $retorno->result_array();

    }//getAll





}//class
