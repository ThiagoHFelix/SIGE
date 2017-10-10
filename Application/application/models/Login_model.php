<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public $table = '';

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
     * Make a verification in the database looking for a datafield
     * @param type $data The table's data that you looking for
     * @param type $field The table's field in the database
     * @param type $table The table's name in the database
     * @return boolean
     */
    public function verificData($data, $field, $table) {

        $this->db->where($field, $data);
        $query = $this->db->get($table, 1);
        if ($query->num_rows() == 1):
            return TRUE;
        else:
            return FALSE;
        endif;


    }//verificData




    public function getDataFromPessoa($where = '') {

        $query = $this->db->query("SELECT * FROM pessoa " . $where);
        if ($query->num_rows() > 0):
            foreach ($query->result_array() as $row):
                return $row;
            endforeach;
        else:
            return NULL;
        endif;

    }//getData



      public function getData($myQuery = '') {

        $query = $this->db->query($myQuery);
        if ($query->num_rows() > 0):
            return $query->result_array();
        else:
            return NULL;
        endif;

    }//getData


}//Class
