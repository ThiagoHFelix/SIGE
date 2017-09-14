<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class  Materia_model extends CI_Model{
    
    
    
    /**
     * Construtor padrão
     */
    public function __construct(){
        
        $this->load->database();
        
    }//Cosntrutor padrão
    
    
    /**
     * Retorna a quantidade de tuplas da tabela matéria
     */
    public function getAllTupla(){
        
        return $this->db->count_all('MATERIA');
        
    }//getAllTupla
    
    
    
    
    
    
}//class
