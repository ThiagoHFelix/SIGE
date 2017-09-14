<?php

/*
 * Created by Thiago Henrique Felix
 */


 
if(!function_exists('showError')){
    
    /**
     * Cria uma mensagem de erro utilizando flashdata
     * @param type $flashName Nome do flash
     * @param type $message Mensagem 
     * @param type $type danger,warring ou succes
     */
     function showError($flashName,$message,$type){
        
         $ci =& get_instance();
         
        //Declaração de variaveis
        $string_error =  NULL;
                    
        //XXX Para não mostrar a div alert-danger sem mensagem
        //Verifico se existe erro
        if(strcmp($message,'') != 0){
                        
            $string_error = "<div class=' alert alert-".$type."'>". $message." </div>";
        }
                    
        $ci->session->set_flashdata($flashName,$string_error);
        
    }//showError

    
}//if showError




if (!function_exists('setValue')):

    /**
     * Retorna o valor do input
     * @param type $value Nome do input
     * @return string
     */
    function setValue($value = NULL) {
        $CI = & get_instance();
        if (isset($CI->input->post()[$value])):
            return $CI->input->post()[$value];
        endif;
        return '';
    }

endif;



if (!function_exists('isSessionStarted')):

    /**
     * Verifico se a sessão já foi iniciada
     */
    function isSessionStarted() {
        $CI = & get_instance();
        //Verifico se uma sessão já existe, se a url for inserida diretamente
        //Sessão não iniciada
        if ($CI->session->userdata('logged_in') == NULL):
            redirect(base_url(), 'reflesh');
        endif;
    }

//isSessionStarted




endif;

if (!function_exists('createLinksPagination')):

    function createLinksPagination($totalRows, $perPage, $numLinksShow, $base_url, $segment) {

        $ci = & get_instance();

        $totalLinks = $totalRows / $perPage;

        //Calculando href da pagina anterior
        $backPage = ($ci->uri->segment($segment)-$perPage);
        if( $backPage < 0):
               $backPage = 0;
        endif;


        $result = ' <ul class="pagination" style="float:right"> ';
        $result = $result.' <li><a href="'.$base_url.'/'.$backPage.'">Anterior</a></li>';

        $nextResultPage = 0;
        $j = 0;

        $nowSegment = $ci->uri->segment($segment);

        for ($i = 0; $i < $totalLinks; $i++):


            //Primeira vez ---
            if ($i == 0):

                if ($ci->uri->segment($segment) != $i):
                    $li = '<li><a href="' . $base_url . '/0">' . ($i + 1) . '</a></li>';
                else:
                    $li = '<li class="active"><a href="' . $base_url . '/0">' . ($i + 1) . '</a></li>';
                endif;

                 $result = $result . $li;

                continue;

            endif;

            //Apartir da segunda vez ---
            if (($nextResultPage + ( $j + $perPage)) != $nowSegment):
                $li = '<li><a href="' . $base_url . '/' . ($nextResultPage + ($j = $j + $perPage)) . '">' . ($i + 1) . '</a></li>';
            else:
                $li = '<li class="active"><a href="' . $base_url . '/' . ($nextResultPage + ($j = $j + $perPage)) . '">' . ($i + 1) . '</a></li>';
            endif;


            $result = $result . $li;

        endfor;


        //Button proxima página
         $backPage = ($ci->uri->segment($segment)+$perPage);
         $result = $result.' <li><a href="'.$base_url.'/'.$backPage.'">Próximo</a></li>';


        return $result = $result . '</ul> ';

    }//createLinksPagination

endif;


if(!function_exists('getVersion')):


    function getVersion($paramer){

        if(strcmp($paramer, 'n') == 0):
            return '0.10';
        endif;

        return 'Release 0.10';

    }//getVersion



endif;
