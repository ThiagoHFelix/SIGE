<?php

/**
 * Created by Thiago Henrique Felix
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class languageLoader{
    
    
    /**
     * Método que faz o carregamento de arquivos de idioma conferindo parametro na URL
     */
    public function initialize(){
        
      $ci =& get_instance();
      
      $ci->load->helper('language');
      
      
      switch($ci->uri->segment(1)){
          
      case 'en':
      $language = 'english';
      break;
      case 'pt_BR':
      $language = 'portuguese-brazilian';
      break;
      default:
      $language = 'portuguese-brazilian';
          
      }//switch
      
      $ci->lang->load(array(
      'calendar',
      'date',
      'db',
      'email',
      'form_validation',
      'ftp',
      'imglib',
      'migration',
      'number',
      'pagination',
      'profiler',
      'unit_test',
      'upload',
      'login'
      ),$language);
      
      
      $ci->config->set_item('language',$language);
        
        
    }//initialize
    
    
    
}//class