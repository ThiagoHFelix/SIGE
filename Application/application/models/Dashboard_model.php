<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

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



     public function getData($myQuery = '') {

        $query = $this->db->query($myQuery);
        if ($query->num_rows() > 0):
            return $query->result_array();
        else:
            return NULL;
        endif;

    }//getData

}//class
