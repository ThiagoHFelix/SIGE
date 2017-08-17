<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * Classe responsável pelo controle de usuário do administrador
 */

class Manage extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Administrador_model', 'administrador');
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
        $CountRows = NULL;
        $TableData = NULL;
        $offset = $valor_pagina;
        $perPage = 8;
        $escolha = NULL;
        $escolha2 = NULL;
        $field_table = '';
        $data_table = '';
        $total_rows = 0;
        $value_post = $this->input->post('table_search');

        //Limpar busca 
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('table_search', '');
            $value_post = '';
        endif;

        
        
        
        //Verificação para saber qual sql se deve executar
        if ((strcmp($value_post, '') != 0) || (strcmp($this->session->userdata('table_search'), '') != 0)):

            if ((strcmp($this->input->post('table_search'), '') != 0)):
                $this->session->set_userdata('table_search', $this->input->post('table_search'));
                $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
            endif;

            $data_table = $this->session->userdata('table_search');
            $field_table = $this->session->userdata('dropdown_search');

            $CountRows = $this->administrador->get_total_tupla($data_table,$field_table);
            $TableData = $this->administrador->get_all_pessoa($offset,$perPage,TRUE.$data_table,$field_table);

        else:
            $this->session->set_userdata('table_search', '');
            $value_post = '';
            $CountRows = $this->administrador->get_total_tupla();
            $TableData = $this->administrador->get_all_pessoa($offset,$perPage);
           endif;

        

        $config = array(
            'base_url' => base_url('/manage/administrador'),
            'per_page' => $perPage,
            'num_links' => 3,
            'uri_segment' => 3,
            'total_rows' => $CountRows,
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
        $escolha = (strcmp($field_table, 'ID') == 0) ? '<option selected>ID</option>' : '<option>ID</option>';
        $escolha2 = (strcmp($field_table, 'Email') == 0) ? '<option selected>Email</option>' : '<option>Email</option>';
        $dados['dropdown_options'] = $dados['dropdown_options'] . $escolha . $escolha2;


        //Titulo da view
        $dados['title'] = 'Administradores';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

       

        $dados['table'] = $TableData;

        $this->load->view('/administrador/manage/manage', $dados);
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
                $this->load->view('administrador/manage/user/userprofile', $dados);

            endif;
        endif;
    }

    /**
     * Cadastra entidades no banco de dados
     */
    public function cadastro($entidade) {

        isSessionStarted();

        //cadastro de administrador
        if (strcmp($entidade, 'administrador') == 0):
            $this->cadAdministrador();
        endif;
    }

//cadastro

    /**
     * Faz o cadastro do administrador no banco de dados
     */
    private function cadAdministrador() {


        $this->load->library('form_validation');


        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email');

        //TODO verificação no banco de dados para saber se o email já existe
        if ("'".$this->manage->verificData($this->input->post()['email']."'", 'email', 'pessoa')):
            
            log_message('debug','Email duplicado, tentativa de cadastro de email já existente');
            $data['avisos'] = "<p>Este email já esta cadastrado</p>";
            $this->load->view('administrador/manage/cadastro_administrador', $data);
        
        else:
            log_message('debug', 'Iniciando insert do administrador');

            if ($this->form_validation->run()):


                /* FIXIT não esta funcionando /* Quebrar a string e retirar os simbolos _ 
                 * if(strcmp($this->input->post('cep'), '') != 0 && strlen($this->input->post('cep')) < 9 ):
                  $data['avisos'] = 'O campo "CEP" deve ter 9 caracteres';
                  endif; */
                $data['avisos'] = NULL;

                $dados = array(
                    'primeiroNome' => "'" . $this->input->post('primeiroNome') . "'",
                    'sobrenome' => "'" . $this->input->post('sobrenome') . "'",
                    'nascimento' => "'" . $this->input->post('nascimento') . "'",
                    'status' => 1,
                    'estado' => "'" . $this->input->post('estado') . "'",
                    'rua' => "'" . $this->input->post('rua') . "'",
                    'cep' => "'" . $this->input->post('cep') . "'",
                    'bairro' => "'" . $this->input->post('bairro') . "'",
                    'cidade' => "'" . $this->input->post('cidade') . "'",
                    'numResidencia' => $this->input->post('residencia'),
                    'senha' => "'" . $this->input->post('senha') . "'",
                    'sexo' => "'" . $this->input->post('sexo') . "'",
                    'cpf' => "'" . $this->input->post('cpf') . "'",
                    'rg' => "'" . $this->input->post('rg') . "'",
                    'telefone' => "'" . $this->input->post('telefone') . "'",
                    'email' => "'" . $this->input->post('email') . "'",
                    'foto' => "'" . $this->input->post('foto') . "'"
                );

                //Inserindo no banco de dados
                $retorn_inset = $this->manage->insert('pessoa', $dados);
                if (!$retorn_inset):

                    $dados['avisos'] = $this->manage->returnLastError();
                    log_message("error", "Um erro ocorreu no banco de dados : " . $this->manage->returnLastError());

                else:

                    //Inserido com sucesso no banco de dados
                    $dados['avisos'] = '<p>Cadastro realizado com sucesso</p>';



                endif;
            else:

                $data['avisos'] = validation_errors();

            endif;


            //Carregamento da view de cadastro
            $this->load->view('administrador/manage/cadastro_administrador', $data);
            
        endif;
    }

//cadAdministrador
}

//class








