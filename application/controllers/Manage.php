<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * Classe responsável pelo controle de usuário do administrador
 */

class Manage extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Manage_model', 'manage');
        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session', 'pagination'));
    }



    public function administrador($valor_pagina = 0) {

        isSessionStarted();
        

        //Não foi inserido nenhuma string para procurar no banco de dados
        //Somente roda se for a primeira vez
        // XXX SISTEMA FICOU MAIS RAPIDO
        if ($this->session->userdata('countLastResult') == NULL):
            //Rodando no banco de dados para setar a variavel de total de resultados do MODEL
            $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id');
            $this->session->set_userdata('countLastResult', $this->manage->countLastResult);
            
         endif;
            
           $total_rows = $this->session->userdata('countLastResult');

        $config = array(
            'base_url' => base_url('/manage/administrador'),
            'per_page' => 8,
            'num_links' => 3,
            'uri_segment' => 3,
            'total_rows' => $total_rows,
            'full_tag_open' => '<ul class="pagination"  style="float:right" >',
            'full_tag_close' => '</ul>',
            'first_link' => TRUE,
            'last_link' => FALSE,
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a>',
            'cur_tag_close' => '</a></li>',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'first_link' => 'Primeiro',
            'prev_link' => 'Anterior',
            'next_link' => 'Próximo'
        );



        //Campos da tabela
        $dados['table_field'] = '
           <th>ID</th>
           <th>Nome</th>
           <th>Email</th>
           <th>Status</th>
           <th>Ações</th>    
           ';

        //Opções de campos da drodown_search
        $dados['dropdown_options'] = '   
            <option value="primeiroNome">Nome</option>
            <option>ID</option>
            <option>Email</option>
            ';

        //Titulo da view
        $dados['title'] = 'Administradores';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        //Paginação criada com função interna (Não utilizada porque não é padronizada como a library do CODE IGNITER)
        //$dados['pagination'] = createLinksPagination($config['total_rows'], $config['per_page'], $config['num_links'], $config['base_url'], $config['uri_segment']);
        //Carrega dados da tabela
        //$dados['tableAdm'] = $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id  ORDER BY administrador.id ');
        //$this->manage->table = 'pessoa';

        $offset = $valor_pagina;
        log_message("info", 'OFFSET demonostrado: ' . $offset);
        // $dados['tableAdm'] = $this->manage->getDataCI('administrador.id','asc','pessoa.id','administrador.FK_Pessoa_id','','',$config['per_page'],$offset);


       
        $dados['table'] = $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id ORDER BY administrador.id asc LIMIT ' . $offset . ',' . $config['per_page']);

        $this->load->view('/administrador/gerencia/adm_gerencia', $dados);
    }


    /**
     * Carrega o perfil do usuário
     * @param type $userid
     */
    public function userProfile($entidade,$userid = NULL) {


        isSessionStarted();

        //Verificação de parâmetro 
        if (!is_numeric($userid)):
            $this->load->view('error_404');
        else:

            $result = $this->manage->getData('select * from pessoa,'.$entidade.' where pessoa.id = '.$entidade.'.FK_Pessoa_id and '.$entidade.'.id = ' . $userid);
            //Usuário não existe
            if ($result == NULL):
                $this->load->view('error_404');
            else:

                foreach ($result as $row):

                    $dados = $row;

                endforeach;
                $this->load->view('/administrador/gerencia/user/adm_userprofile', $dados);

            endif;
        endif;
    }
    
    
    /*
     * Faz a busca no banco de dados e retorna as tuplas encontradas baseados nos parametros
     */
    public function search($table = '',$field = '', $data = '',$valor_pagina = 0){
        
        isSessionStarted();
        
        
        if( (strcmp($table, 'administrador') == 0 && strcmp($data, '') != 0) || (strcmp($table, 'professor') == 0  && strcmp($data, '') != 0)  || (strcmp($table, 'aluno') == 0 && strcmp($data, '') != 0)  ):
        

        //Não foi inserido nenhuma string para procurar no banco de dados
        //Somente roda se for a primeira vez
        // XXX SISTEMA FICOU MAIS RAPIDO
        if ($this->session->userdata('countLastResultSearch') == NULL):
            //Rodando no banco de dados para setar a variavel de total de resultados do MODEL
            $this->manage->getData('select * from pessoa,'.$table.' where pessoa.id = '.$table.'.FK_Pessoa_id');
            $this->session->set_userdata('countLastResultSearch', $this->manage->countLastResult);
         endif;
            
           $total_rows = $this->session->userdata('countLastResultSearch');

        $config = array(
            'base_url' => base_url('/manage/search/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)),
            'per_page' => 8,
            'num_links' => 3,
            'uri_segment' => 6,
            'total_rows' => $total_rows,
            'full_tag_open' => '<ul class="pagination"  style="float:right" >',
            'full_tag_close' => '</ul>',
            'first_link' => TRUE,
            'last_link' => FALSE,
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a>',
            'cur_tag_close' => '</a></li>',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'first_link' => 'Primeiro',
            'prev_link' => 'Anterior',
            'next_link' => 'Próximo'
        );


        if(strcmp($table, 'administrador') == 0):    
        //Campos da tabela
        $dados['table_field'] = '
           <th>ID</th>
           <th>Nome</th>
           <th>Email</th>
           <th>Status</th>
           <th>Ações</th>    
           ';
         
        //Opções de campos da drodown_search
        $dados['dropdown_options'] = '   
            <option value="primeiroNome">Nome</option>
            <option>ID</option>
            <option>Email</option>
            ';

        //Titulo da view
        $dados['title'] = 'Administradores';
        
        endif;
        
        
        
        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        //Paginação criada com função interna (Não utilizada porque não é padronizada como a library do CODE IGNITER)
        //$dados['pagination'] = createLinksPagination($config['total_rows'], $config['per_page'], $config['num_links'], $config['base_url'], $config['uri_segment']);
        //Carrega dados da tabela
        //$dados['tableAdm'] = $this->manage->getData('select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id  ORDER BY administrador.id ');
        //$this->manage->table = 'pessoa';

        $offset = $valor_pagina;
        log_message("info", 'OFFSET demonostrado: ' . $offset);
        // $dados['tableAdm'] = $this->manage->getDataCI('administrador.id','asc','pessoa.id','administrador.FK_Pessoa_id','','',$config['per_page'],$offset);


       
        $dados['table'] = $this->manage->getData('select * from pessoa,'.$table.' where pessoa.id = '.$table.'.FK_Pessoa_id and pessoa.'.$field.' like \'%'.$data.'%\' ORDER BY '.$table.'.id asc LIMIT ' . $offset . ',' . $config['per_page']);

        $this->load->view('/administrador/gerencia/adm_gerencia', $dados);
       
         else:
           $this->load->view('error_404');
        endif;
    }//search
    


}//class






