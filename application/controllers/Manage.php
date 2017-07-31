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

    
    /**
     * Lista a table com todos os administradores e toda as opções de manipulação
     * @param type $valor_pagina Número de paginação (Opcional)
     */
    public function administrador($valor_pagina = 0) {

        isSessionStarted();
        $is_search = FALSE;
        $sqlCountRows = NULL;
        $sqlTableData = NULL;
        $offset = $valor_pagina;
        $perPage = 8;
        $escolha = NULL;
        $escolha2 = NULL;
        $field_table = '';
        $data_table = '';
        $total_rows = 0;
        $value_post = $this->input->post('table_search');
        
        if($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('table_search','');
            $value_post = '';
        endif;
        
        // TESTE
        // echo 'Post:'.$this->input->post('table_search');
        // echo 'Userdata:'.$this->session->userdata('table_search');
        //$this->session->userdata('is_search') !== NULL  
        
        //Verificação para saber qual sql se deve executar
        if ( (strcmp($value_post, '') != 0)  || (strcmp($this->session->userdata('table_search'), '') != 0) ):
           
            if((strcmp($this->input->post('table_search'), '') != 0)):
            $this->session->set_userdata('table_search',$this->input->post('table_search')) ;
            $this->session->set_userdata('dropdown_search',$this->input->post('dropdown_search'));
            endif;
            
            $data_table = $this->session->userdata('table_search');
            $field_table = $this->session->userdata('dropdown_search');
            
            $sqlCountRows = 'select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id and pessoa.' . $field_table . ' LIKE \'%' . $data_table . '%\'';
            $sqlTableData = 'select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id and pessoa.' . $field_table . ' LIKE \'%' . $data_table . '%\' ORDER BY administrador.id asc LIMIT ' . $offset . ',' . $perPage;
            
        else:
             $this->session->set_userdata('table_search','');
            $value_post = '';
            $sqlCountRows = 'select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id';
            $sqlTableData = 'select * from pessoa,administrador where pessoa.id = administrador.FK_Pessoa_id ORDER BY administrador.id asc LIMIT ' . $offset . ',' . $perPage;
        endif;

        //Contando resultados para criar a paginação
        $this->manage->getData($sqlCountRows);
        $total_rows = $this->manage->countLastResult;

        $config = array(
            'base_url' => base_url('/manage/administrador'),
            'per_page' => $perPage,
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
           <th  style="text-align: center">ID</th>
           <th  style="text-align: center">Nome</th>
           <th  style="text-align: center">Email</th>
           <th  style="text-align: center">Status</th>
           <th  style="text-align: center">Ações</th>    
           ';

        //Opções de campos da drodown_search
        $dados['dropdown_options'] = '   
            <option value="primeiroNome">Nome</option>
            ';
        //Deixar o dropdown selecionado
        $escolha = (strcmp($field_table,'ID') == 0) ? '<option selected>ID</option>' : '<option>ID</option>';
        $escolha2 = (strcmp($field_table,'Email') == 0) ? '<option selected>Email</option>' : '<option>Email</option>';
        $dados['dropdown_options'] = $dados['dropdown_options'].$escolha.$escolha2; 
        

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
        // $dados['tableAdm'] = $this->manage->getDataCI('administrador.id','asc','pessoa.id','administrador.FK_Pessoa_id','','',$config['per_page'],$offset);



        $dados['table'] = $this->manage->getData($sqlTableData);

        $this->load->view('/administrador/gerencia/adm_gerencia', $dados);
    }

    /**
     * Carrega o perfil do usuário
     * @param type $userid
     */
    public function userProfile($entidade, $userid = NULL) {


        isSessionStarted();

        //Verificação de parâmetro 
        if (!is_numeric($userid)):
            $this->load->view('error_404');
        else:

            $result = $this->manage->getData('select * from pessoa,' . $entidade . ' where pessoa.id = ' . $entidade . '.FK_Pessoa_id and ' . $entidade . '.id = ' . $userid);
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

  
}//class








