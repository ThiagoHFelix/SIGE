<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * Classe responsável pelo controle de usuário do administrador
 */

class Manage extends CI_Controller {

    /**
     * Construtor padrão
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Administrador_model', 'administrador');
        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session', 'pagination'));
    }//Construtor | Padrão

    
    
    public function turma(int $valor_pagina = 0){
        
          $this->load->model('Turma_model', 'turma');

        //   die($this->curso->getAllTupla());

        isSessionStarted();


        //Quantidade por pagina
        /*         * *************************************************** */
        if ($this->input->post('dropdown_perpage') != NULL) {
            $perPage = $this->input->post('dropdown_perpage');
        }//null
        else {
            $perPage = 8;
        }//else

        /*         * *************************************************** */


        $is_search = FALSE;
        $CountRows = NULL;
        $TableData = NULL;
        $offset = $valor_pagina;
        $escolha = NULL;
        $escolha2 = NULL;
        $field_table = '';
        $data_table = '';
        $total_rows = 0;


        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):

        /*      if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->administrador->get_total_tupla($data_table,$field_table);
          $TableData = $this->administrador->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

          unset($_POST['table_search']);
         */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->turma->getAllTupla();
            $TableData = $this->turma->getAll($perPage, $offset);
        endif;



        $config = array(
            'base_url' => base_url('/manage/turma'),
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

       


        //Titulo da view
        $dados['title'] = 'Cursos';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        $dados['table'] = $TableData;

        $this->load->view('/administrador/manage/manage_turma', $dados);
        
        
        
    }//turma
    
    
    public function aviso(int $valor_pagina = 0){
        
        
        $this->load->model('Aviso_model', 'aviso');

        //   die($this->curso->getAllTupla());

        isSessionStarted();


        //Quantidade por pagina
        /*         * *************************************************** */
        if ($this->input->post('dropdown_perpage') != NULL) {
            $perPage = $this->input->post('dropdown_perpage');
        }//null
        else {
            $perPage = 8;
        }//else

        /*         * *************************************************** */


        $is_search = FALSE;
        $CountRows = NULL;
        $TableData = NULL;
        $offset = $valor_pagina;
        $escolha = NULL;
        $escolha2 = NULL;
        $field_table = '';
        $data_table = '';
        $total_rows = 0;


        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):

        /*      if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->administrador->get_total_tupla($data_table,$field_table);
          $TableData = $this->administrador->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

          unset($_POST['table_search']);
         */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->aviso->getAllTupla();
            $TableData = $this->aviso->getAll($perPage, $offset);
        endif;



        $config = array(
            'base_url' => base_url('/manage/turma'),
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

       


        //Titulo da view
        $dados['title'] = 'Cursos';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        $dados['table'] = $TableData;

        $this->load->view('/administrador/manage/manage_aviso', $dados);
        
        
    }//aviso
    
    

    //Gerenciamento de Curso
    public function curso($valor_pagina = 0) {


        $this->load->model('Curso_model', 'curso');

        //   die($this->curso->getAllTupla());

        isSessionStarted();


        //Quantidade por pagina
        /*         * *************************************************** */
        if ($this->input->post('dropdown_perpage') != NULL) {
            $perPage = $this->input->post('dropdown_perpage');
        }//null
        else {
            $perPage = 8;
        }//else

        /*         * *************************************************** */


        $is_search = FALSE;
        $CountRows = NULL;
        $TableData = NULL;
        $offset = $valor_pagina;
        $escolha = NULL;
        $escolha2 = NULL;
        $field_table = '';
        $data_table = '';
        $total_rows = 0;


        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):

        /*      if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->administrador->get_total_tupla($data_table,$field_table);
          $TableData = $this->administrador->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

          unset($_POST['table_search']);
         */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->curso->getAllTupla();
            $TableData = $this->curso->getAll($perPage, $offset);
        endif;



        $config = array(
            'base_url' => base_url('/manage/curso'),
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

                 <th  style="text-align: center">Titulo</th>
                 <th  style="text-align: center">Status</th>
                 <th  style="text-align: center">Ações</th>

                 ';


        //Titulo da view
        $dados['title'] = 'Cursos';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        $dados['table'] = $TableData;

        $this->load->view('/administrador/manage/manage_curso', $dados);
    }


    //Mostra as informações da matéria
    public function infoMateria(int $id) {


        $this->load->model('materia_model', 'materia');
        $dados = array('ID' => $id);
        $resultado = $this->materia->getWhere($dados);

        $this->load->view('administrador/manage/info/info_materia', $resultado[0]);
    }//infoMateria

   

    /**
     * Lista todas as matérias registradas no banco de dados
     * @param type $valor_pagina
     */
     public function materia($valor_pagina = 0) {


        $this->load->model('Materia_model', 'materia');

        //   die($this->materia->getAllTupla());

        isSessionStarted();


//Quantidade por pagina
        /*         * *************************************************** */
        if ($this->input->post('dropdown_perpage') != NULL) {
            $this->session->set_userdata('perPage', $this->input->post('dropdown_perpage'));
            $perPage = $this->session->userdata('perPage');
        }//null
        else {
            if ($this->session->userdata('perPage') == NULL)
                $perPage = 8;
        }//else
        $dados['perPage'] = $perPage;
        /*         * *************************************************** */


        $is_search = FALSE;
        $CountRows = NULL;
        $TableData = NULL;
        $offset = $valor_pagina;
        $escolha = NULL;
        $escolha2 = NULL;
        $field_table = '';
        $data_table = '';
        $total_rows = 0;


        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):

        /*      if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->administrador->get_total_tupla($data_table,$field_table);
          $TableData = $this->administrador->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

          unset($_POST['table_search']);
         */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->materia->getAllTupla();
            $TableData = $this->materia->getAll($perPage, $offset);
        endif;



        $config = array(
            'base_url' => base_url('/manage/materia'),
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

           <th  style="text-align: center">Titulo</th>
           <th  style="text-align: center">Status</th>
           <th  style="text-align: center">Ações</th>

           ';


        //Titulo da view
        $dados['title'] = 'Matérias';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        $dados['table'] = $TableData;

        $this->load->view('/administrador/manage/manage_materia', $dados);
    }


    /**
     * Lista a table com todos os administradores
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



        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):
        /*
          if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->administrador->get_total_tupla($data_table, $field_table);
          $TableData = $this->administrador->get_all_pessoa($offset, $perPage, TRUE, $data_table, $field_table);

          unset($_POST['table_search']); */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->administrador->getAllTupla();
            $TableData = $this->administrador->getAll($offset, $perPage);
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
           <th  style="text-align: center">CPF</th>
           <th  style="text-align: center">Status</th>
           <th  style="text-align: center">Ações</th>
           ';

        //Opções de campos da drodown_search
        $dados['dropdown_options'] = '
            <option value="primeiroNome">Nome</option>
            ';

        //Deixar o dropdown selecionado
        $escolha = (strcmp(strtoupper($field_table), 'ID') == 0) ? '<option selected>ID</option>' : '<option>ID</option>';
        $escolha2 = (strcmp(strtoupper($field_table), 'EMAIL') == 0) ? '<option selected>Email</option>' : '<option>Email</option>';
        $dados['dropdown_options'] = $dados['dropdown_options'] . $escolha . $escolha2;


        //Titulo da view
        $dados['title'] = 'Administradores';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();


        $dados['table'] = $TableData;
        $dados['entidade'] = 'Administrador';

        $this->load->view('/administrador/manage/manage', $dados);
    }

    /**
     * Lista a table com todos os professores
     * @param type $valor_pagina
     */
    public function professor($valor_pagina = 0) {

        isSessionStarted();
        $this->load->model('professor_model', 'professor');

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


        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):

        /*  if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->professor->get_total_tupla($data_table, $field_table);
          $TableData = $this->professor->get_all_pessoa($offset, $perPage, TRUE, $data_table, $field_table);

          unset($_POST['table_search']); */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->professor->getAllTupla();
            $TableData = $this->professor->getAll($offset, $perPage);
        endif;



        $config = array(
            'base_url' => base_url('/manage/professor'),
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
           <th  style="text-align: center">CPF</th>
           <th  style="text-align: center">Status</th>
           <th  style="text-align: center">Ações</th>
           ';

        //Opções de campos da drodown_search
        $dados['dropdown_options'] = '
            <option value="primeiroNome">Nome</option>
            ';

        //Deixar o dropdown selecionado
        $escolha = (strcmp(strtoupper($field_table), 'ID') == 0) ? '<option selected>ID</option>' : '<option>ID</option>';
        $escolha2 = (strcmp(strtoupper($field_table), 'EMAIL') == 0) ? '<option selected>Email</option>' : '<option>Email</option>';
        $dados['dropdown_options'] = $dados['dropdown_options'] . $escolha . $escolha2;


        //Titulo da view
        $dados['title'] = 'Professores';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();



        $dados['table'] = $TableData;
        $dados['entidade'] = 'Professor';

        $this->load->view('/administrador/manage/manage', $dados);
    }

    /**
     * Lista a table com todos os alunos
     * @param type $valor_pagina
     */
    public function aluno($valor_pagina = 0) {

        isSessionStarted();
        $this->load->model('aluno_model', 'aluno');

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


        //inicia a busca
        if (strcmp($this->input->post('table_search'), '') != 0) {
            $this->session->set_userdata('is_search', TRUE);
        }//IF | IS_SEARCH
        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
        if ($this->session->userdata('is_search')):
        /*
          if ((strcmp($this->input->post('table_search'), '') != 0)):
          $this->session->set_userdata('table_search', $this->input->post('table_search'));
          $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
          endif;

          $data_table = $this->session->userdata('table_search');
          $field_table = $this->session->userdata('dropdown_search');

          $CountRows = $this->aluno->get_total_tupla($data_table, $field_table);
          $TableData = $this->aluno->get_all_pessoa($offset, $perPage, TRUE, $data_table, $field_table);

          unset($_POST['table_search']); */

        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->aluno->getAllTupla();
            $TableData = $this->aluno->getAll();
        endif;



        $config = array(
            'base_url' => base_url('/manage/aluno'),
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
           <th  style="text-align: center">CPF</th>
           <th  style="text-align: center">Status</th>
           <th  style="text-align: center">Ações</th>
           ';

        //Opções de campos da drodown_search
        $dados['dropdown_options'] = '
            <option value="primeiroNome">Nome</option>
            ';

        //Deixar o dropdown selecionado
        $escolha = (strcmp(strtoupper($field_table), 'ID') == 0) ? '<option selected>ID</option>' : '<option>ID</option>';
        $escolha2 = (strcmp(strtoupper($field_table), 'EMAIL') == 0) ? '<option selected>Email</option>' : '<option>Email</option>';
        $dados['dropdown_options'] = $dados['dropdown_options'] . $escolha . $escolha2;


        //Titulo da view
        $dados['title'] = 'Alunos';

        //Inicializo a classe de paginação
        $this->pagination->initialize($config);

        //Criação do HTML com os links
        $dados['pagination'] = $this->pagination->create_links();

        $dados['table'] = $TableData;
        $dados['entidade'] = 'Aluno';

        $this->load->view('/administrador/manage/manage', $dados);
    }

    
    /**
     * Redireciona entidade para o método de modificação
     */
    public function alter(string $entidade, int $id) {

        isSessionStarted();


        switch (strtoupper($entidade)) {


            case 'ADMINISTRADOR':
                $this->alterAdministrador($id);
                break;

            case 'PROFESSOR':
                $this->alterProfessor($id);
                break;

            case 'ALUNO':
                $this->alterAluno($id);
                break;

            case 'MATERIA':
                $this->alterMateria($id);
                break;

            default: show_404();
        }//switch
    }

    // Altera informações da matéria
    private function alterMateria(int $id) {



        $this->load->library(array('form_validation', 'session'));
        $this->load->model('materia_model', 'materia');


        //Declaração de variaveis
        $dados = NULL;

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('apresentacao', '"Apresentação"', 'trim|max_length[250]');
        $this->form_validation->set_rules('titulo', '"Titulo"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('objetivo', '"Objetivo"', 'trim|max_length[250]');
        $this->form_validation->set_rules('ementa', '"Ementa"', 'trim|max_length[250]');
        $this->form_validation->set_rules('bibliografia', '"Bibliografia"', 'trim|max_length[250]');

        //inicio a verificação da regras
        if ($this->form_validation->run()) {


            $dados = array(
                'TITULO' => $this->input->post('titulo'),
                'APRESENTACAO' => "" . $this->input->post('apresentacao'),
                'OBJETIVO' => "" . $this->input->post('objetivo'),
                'EMENTA' => "" . $this->input->post('ementa'),
                'BIBLIOGRAFIA' => "" . $this->input->post('bibliografia'),
                'STATUS' => 'Ativado',
                'MATERIAL' => "",
                'EXTRACLASSE' => "" . $this->input->post('extraclasse')
            );


            $dados_where = array('ID' => $id);

            $retorno = $this->materia->updateWhere($dados, $dados_where);

            if ($retorno) {

                $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Matéria atualizada com sucesso </div> ');
                redirect(base_url('/manage/materia'));
            }//if
            else {

                $this->session->set_flashdata('mensagem_usuario', ' <div style = "text-align:center" class=" alert alert-danger"> Falha ao atualizar </div> ');
            }//else
        }//validation
        else {

            if (strcmp(validation_errors(), '') == 0) {
                //Limpo a mensagem de erro
                $this->session->set_flashdata('mensagem_usuario', '');
            }//if
            else {
                $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
                  ' . validation_errors() . '
                  </div> ');
            }//else
        }//validation

        $dados = array(
            "ID" => $id
        );

        $retorno = $this->materia->getWhere($dados);

        $this->load->view('/administrador/manage/alter/alter_materia', $retorno[0]);
    }
   
    /**
     * Desativa usuário no banco de dados
     * @param type $entidade
     * @param int $id
     */
    public function desativar($entidade = NULL, int $id = NULL) {

        isSessionStarted();
        if ($entidade == NULL || $id == NULL) {
            show_404();
            log_message('info', 'Access in function desativar of class Manage with out parameters');
        }//if | NULL parameters


        switch (strtoupper($entidade)) {

            case 'ADMINISTRADOR':

                $this->load->model('administrador_model', 'adm');

                //Verificando se adminstrador existe no banco de dados
                $retorno = $this->adm->isAdministradorById($id);
                if (!$retorno) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Administrador não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/administrador'), 'reflash');
                }//if | $retorno


                $retorno = $this->adm->desativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Administrador desativado com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar o administrador <striong> Contate o admnistrador do sistema </string> </div>  ');

                redirect(base_url('/manage/administrador'), 'reflash');

                break;

            case 'PROFESSOR':


                $this->load->model('professor_model', 'professor');

                //Verificando se professor existe no banco de dados
                $retorno = $this->professor->isProfessorById($id);
                if (!$retorno) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Professor não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/professor'), 'reflash');
                }//if | $retorno


                $retorno = $this->professor->desativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Professor desativado com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar o professor <striong> Contate o admnistrador do sistema </string> </div>  ');

                redirect(base_url('/manage/professor'), 'reflash');

                break;

            case 'ALUNO':
                $this->load->model('aluno_model', 'aluno');

                //Verificando se model existe no banco de dados
                $retorno = $this->aluno->isAlunoById($id);
                if (!$retorno) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Aluno não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/aluno'), 'reflash');
                }//if | $retorno


                $retorno = $this->aluno->desativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Aluno desativado com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar o aluno <striong> Contate o admnistrador do sistema </string> </div>  ');

                redirect(base_url('/manage/aluno'), 'reflash');
                break;


            case 'MATERIA':


                $this->load->model('materia_model', 'materia');

                //Verificando se a materia existe no banco de dados
                $dados = array(
                    'ID' => $id
                );
                $retorno = $this->materia->getWhere($dados);
                if ($retorno == NULL) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Matéria não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/professor'), 'reflash');
                }//if | $retorno


                $retorno = $this->materia->desativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Materia desativada com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar a Matéria <striong> Contate o administrador do sistema </string> </div>  ');

                redirect(base_url('/manage/materia'), 'reflash');

                break;





            default: show_404();
        }//switch
    }

    /**
     * Ativa usuário no banco de dados
     * @param type $entidade
     * @param int $id
     */
    public function ativar($entidade = NULL, int $id = NULL) {

        isSessionStarted();

        if ($entidade == NULL || $id == NULL) {
            show_404();
            log_message('info', 'Access in function desativar of class Manage with out parameters');
        }//if | NULL parameters


        switch (strtoupper($entidade)) {

            case 'ADMINISTRADOR':

                $this->load->model('administrador_model', 'adm');

                //Verificando se adminstrador existe no banco de dados
                $retorno = $this->adm->isAdministradorById($id);
                if (!$retorno) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Administrador não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/administrador'), 'reflash');
                }//if | $retorno


                $retorno = $this->adm->ativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Administrador ativado com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar o administrador <striong> Contate o admnistrador do sistema </string> </div>  ');

                redirect(base_url('/manage/administrador'), 'reflash');

                break;

            case 'PROFESSOR':

                $this->load->model('professor_model', 'professor');

                //Verificando se professor existe no banco de dados
                $retorno = $this->professor->isProfessorById($id);
                if (!$retorno) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Professor não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/professor'), 'reflash');
                }//if | $retorno


                $retorno = $this->professor->ativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Professor ativado com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar o professor <striong> Contate o admnistrador do sistema </string> </div>  ');

                redirect(base_url('/manage/professor'), 'reflash');

                break;

            case 'ALUNO':
                $this->load->model('aluno_model', 'aluno');

                //Verificando se aluno existe no banco de dados
                $retorno = $this->aluno->isAlunoById($id);
                if (!$retorno) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Aluno não existe na base de dados </div> ');
                    log_message('info', 'Menage->desativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/aluno'), 'reflash');
                }//if | $retorno


                $retorno = $this->aluno->ativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Aluno ativado com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar o aluno <striong> Contate o admnistrador do sistema </string> </div>  ');

                redirect(base_url('/manage/aluno'), 'reflash');
                break;

            case 'MATERIA':


                $this->load->model('materia_model', 'materia');

                //Verificando se a materia existe no banco de dados
                $dados = array(
                    'ID' => $id
                );
                $retorno = $this->materia->getWhere($dados);
                if ($retorno == NULL) {
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-danger"> Matéria não existe na base de dados </div> ');
                    log_message('info', 'Menage->ativar(' . $entidade . ',' . $id . ') -> Entidade não existe no banco de dados');
                    redirect(base_url('/manage/professor'), 'reflash');
                }//if | $retorno


                $retorno = $this->materia->ativar($id);
                if ($retorno)
                    $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Materia ativada com sucesso </div> ');
                else
                    $this->session->set_flashdata('mensagem_manage', '  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar a Matéria <strong> Contate o administrador do sistema </string> </div>  ');

                redirect(base_url('/manage/materia'), 'reflash');

                break;




            default: show_404();
        }//switch
    }

    /**
     * Gerencia as configurações do sistema
     */
    public function configuration() {

        isSessionStarted();
        
        //Alterando banco de dados/
        if ($this->input->post('banco') != NULL) {

            $selected_database = $this->input->post('banco');
            $this->session->set_userdata('database', $selected_database);
        }//if
        
        $dados['last_query'] = $this->administrador->last_query();
        $this->load->view('administrador/configuration',$dados);
        
        
    }//configuration

    /**
     * Lista arquivos de log do sistema
     */
    public function log() {

        $dropdown = NULL;
        $file = NULL;

        $this->load->helper('file');

        //Lista de arquivos
        $list_files = get_filenames(APPPATH . '/logs');

        //Pulo o arquivo index.html
        for ($i = 1; $i < sizeof($list_files); $i++) {

            $dropdown = $dropdown . ' <option> ' . $list_files[$i] . ' </option>  ';
        }//for

        $dados['dropdown'] = $dropdown;

        if ($this->input->post('log-file') == NULL):
            $file = 'log-' . date('Y') . '-' . date('m') . '-' . date('d') . '.php';
        else:
            $file = $this->input->post('log-file');
        endif;

        $dados['title'] = $file;

        $string_file = APPPATH . 'logs/' . $file;

        $string_log = read_file($string_file);

        $this->session->set_userdata('log_text', $string_log);

        $this->load->view('administrador/manage/log/log_management', $dados);
    }

}//class


