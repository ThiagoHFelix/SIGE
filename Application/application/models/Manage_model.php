<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_model extends CI_Model {

    var $table = '';
    //Total de resultados da ultima interação com o banco de dados (SELECT)
    var $countLastResult =  NULL;

    public function __construct() {

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

    }//construct

    /**
     * Retorna o ultimo erro ocorrido no banco de dados
     * @return type
     */
    public function returnLastError(){

        return $this->db->error();

    }//returnLastError


    /**
     * Retorna um array de array com todos os dados encontrados na atual tabela da variavel $table
     * @param type $sort Campo no qual deve ser seguido a ordem, por padrão é o campo ID
     * @param type $order Ordem dos dados, por padrão é crescente
     * @return type Array se for encontrado no minimo uma tupla na tabela e NULL se nada for encontrado
     */

 /**
  *
  * @param type $sort
  * @param type $order
  * @param type $whereField
  * @param type $whereData
  * @param type $whereField2
  * @param type $whereData2
  * @param type $limit
  * @param type $offset
  * @return type
  */
  //  public function getDataCI($sort = 'id', $order = 'asc',$whereField = '',$whereData = '',$whereField2 = '',$whereData2 = '',$limit = '', $offset = '') {
     public function getDataCI($myQuery){
       //Verificação do parametro where "Para tabelas como ADMINISTRADORES que os dados devem constrar tambem em PESSOA"
        if($whereField):
            $this->db->where($whereField,$whereData);
        endif;
        if($whereField2):
            $this->db->where($whereField2,$whereData2);
        endif;

        if($limit):
            $this->db->limit($limit,$offset);
        endif;

        $this->db->order_by($sort, $order);


        $query = $this->db->get('administrador');

        if ($query->num_rows > 0):

            log_message('error', 'SUCESSO AO BUSCAR NO BANCO DE DADOS');
            return $query->result_array();

        else:

            log_message('error', 'ERRO AO BUSCAR NO BANCO DE DADOS');
            return NULL;

        endif;

    }//getDataCI


     /**
     * Make a verification in the database looking for a datafield
     * @param type $data The table's data that you looking for
     * @param type $field The table's field in the database
     * @param type $table The table's name in the database
     * @return boolean
     */
    public function verificData($data, $field, $table) {

        $this->db->where($field, $data);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0):
            return TRUE;
        else:
            return FALSE;
        endif;
    }//verificData



    /**
     * Roda a query np banco de dados
     * @param type $myQuery
     * @return type
     */
    public function getData($myQuery = '') {

        $query = $this->db->query($myQuery);

        $this->countLastResult =  $query->num_rows();

        if ($query->num_rows() > 0):
            return $query->result_array();
        else:
            return NULL;
        endif;

    }//getData


    public function getMax($table,$field){

        $this->db->select_max($field);
        $this->db->get($table);


    }//getMax



    /**
     * Faz um inset na tabela passada
     */
    public function insert($table,$dados){

        return $this->db->insert($table,$dados);

    }//insert





}//class
