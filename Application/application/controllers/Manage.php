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
        if(strcmp($this->input->post('table_search'), '') != 0){
          $this->session->set_userdata('is_search',TRUE);
      
        }//IF | IS_SEARCH

        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
      if ($this->session->userdata('is_search')):

            if ((strcmp($this->input->post('table_search'), '') != 0)):
                $this->session->set_userdata('table_search', $this->input->post('table_search'));
                $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
            endif;

            $data_table = $this->session->userdata('table_search');
            $field_table = $this->session->userdata('dropdown_search');

            $CountRows = $this->administrador->get_total_tupla($data_table,$field_table);
            $TableData = $this->administrador->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

            unset($_POST['table_search']);
            
        else:
            $this->session->set_userdata('is_search', FALSE);
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

        $this->load->view('/administrador/manage/manage', $dados);
    }

    /**
     * Lista a table com todos os professores 
     * @param type $valor_pagina
     */
    public function professor($valor_pagina = 0){
        
        isSessionStarted();
        $this->load->model('professor_model','professor');
        
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
        if(strcmp($this->input->post('table_search'), '') != 0){
          $this->session->set_userdata('is_search',TRUE);
      
        }//IF | IS_SEARCH

        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
      if ($this->session->userdata('is_search')):

            if ((strcmp($this->input->post('table_search'), '') != 0)):
                $this->session->set_userdata('table_search', $this->input->post('table_search'));
                $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
            endif;

            $data_table = $this->session->userdata('table_search');
            $field_table = $this->session->userdata('dropdown_search');

            $CountRows = $this->professor->get_total_tupla($data_table,$field_table);
            $TableData = $this->professor->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

            unset($_POST['table_search']);
            
        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->professor->get_total_tupla();
            $TableData = $this->professor->get_all_pessoa($offset,$perPage);
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
           <th  style="text-align: center">Email</th>
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

        $this->load->view('/administrador/manage/manage', $dados);
        
    }//professor
    
    
    public function aluno($valor_pagina = 0){
        
        isSessionStarted();
        $this->load->model('aluno_model','aluno');
        
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
        if(strcmp($this->input->post('table_search'), '') != 0){
          $this->session->set_userdata('is_search',TRUE);
      
        }//IF | IS_SEARCH

        //Limpar busca
        if ($this->input->post('clear_search') !== NULL):
            $this->session->set_userdata('is_search', FALSE);
        endif;

        //Verificação para saber qual sql se deve executar
      if ($this->session->userdata('is_search')):

            if ((strcmp($this->input->post('table_search'), '') != 0)):
                $this->session->set_userdata('table_search', $this->input->post('table_search'));
                $this->session->set_userdata('dropdown_search', $this->input->post('dropdown_search'));
            endif;

            $data_table = $this->session->userdata('table_search');
            $field_table = $this->session->userdata('dropdown_search');

            $CountRows = $this->aluno->get_total_tupla($data_table,$field_table);
            $TableData = $this->aluno->get_all_pessoa($offset,$perPage,TRUE,$data_table,$field_table);

            unset($_POST['table_search']);
            
        else:
            $this->session->set_userdata('is_search', FALSE);
            $CountRows = $this->aluno->get_total_tupla();
            $TableData = $this->aluno->get_all_pessoa($offset,$perPage);
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
           <th  style="text-align: center">Email</th>
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

        $this->load->view('/administrador/manage/manage', $dados);
        
        
    }//aluno
    
    
    /**
     * Carrega o perfil do usuário
     * @param type $userid
     */
    public function userProfile($entidade, $userid = NULL) {

        isSessionStarted();


        //Verificação de parâmetro
        if (!is_numeric($userid)):
            show_404();
        else:

            $resultado = NULL;

            switch(strtoupper($entidade)){

            case 'ADMINISTRADOR':
                $this->load->model('Administrador_model','administrador');
                $resultado = $this->administrador->getPessoaById($userid);
            break;

            case 'PROFESSOR':
                $this->load->model('Professor_model','professor');
                $resultado = $this->professor->getPessoaById($userid);
            break;

            case 'ALUNO':
                $this->load->model('Aluno_model','aluno');
                $resultado = $this->aluno->getPessoaById($userid);
            break;



            }//switch

            //Usuário não existe
            if ($resultado == NULL):
                show_404();
            else:

                $dados = $resultado;
                $dados['entidade'] = $entidade;

                $this->load->view('administrador/manage/user/userprofile', $dados);

            endif;
        endif;
    }

    /**
     * Redireciona entidade para o método de modificação
     */
    public function alter($entidade = NULL, int $id =  NULL){
        
        isSessionStarted();
             
        if($entidade ==  NULL || $id == NULL){
             show_404();
             log_message('info','Access in function desativar of class Manage with out parameters');
        }//if | NULL parameters
     
        
        
        switch(strtoupper($entidade)){
            
            
            case 'ADMINISTRADOR':
                $this->alterAdministrador($id);
                break;
            
            case 'PROFESSOR':
                $this->alterProfessor($id);
                break;
            
            case 'ALUNO':
                $this->alterAluno($id);
                break;
            
            default: show_404();
            
            
            
        }//switch
       
        
    }//alter
    
    /**
     * 
     * @param int $id
     */
    private function alterAdministrador(int $id){
        
        //isSessionStarted();
        
        $this->load->model('administrador_model','adm');
        //Verificando se adminstrador existe no banco de dados
        $retorno = $this->adm->isAdministradorById($id);
        if(!$retorno){
            $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Administrador não existe na base de dados </div> ');
            log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
            redirect(base_url('/manage/administrador'),'reflash');
        }//if | $retorno
          
        //Verificação
        
        $this->load->library(array('form_validation','session'));
        $this->load->model('Administrador_model','administrador');

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');


        //inicio a verificação da regras
        if ($this->form_validation->run()){

          //busco dados para verificação do campo sexo
          $sexo_inserido = $this->input->post('sexo');


          //verificação do campo sexo
          if(strcmp(strtoupper($sexo_inserido),'') == 0){

              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Campo "Sexo" não foi selecionado </div>');

          }//if | campo sexo
        
          else{

            $nome_imagem = NULL;
            $local_imagem = NULL;

          if($_FILES['imagem']['name'] != NULL){

            $nome_imagem = uniqid().'-'.time();

            //Configuração do upload da imagem
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('imagem')){

              $retorno = $this->upload->display_errors();
              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning">'.$retorno.'</div>');

            }//if | do_upload fail
            else{

              $dados_img = $this->upload->data();
              $local_imagem = $dados_img['file_path'].''.$dados_img['file_name'];


            }//else | do_upload sucess

          }//if | Imagem inserida
          else{

              $local_imagem = base_url('/user_img/avatar.png');

          }//else | imagem não inserida

                $dados = array(

                    'PRIMEIRONOME' => $this->input->post('primeiroNome'),
                    'SOBRENOME' =>  $this->input->post('sobrenome'),
                    'NASCIMENTO' => $this->input->post('nascimento'),
                    'STATUS' => 'Ativado',
                    'ESTADO' => $this->input->post('estado'),
                    'RUA' => $this->input->post('rua'),
                    'CEP' => $this->input->post('cep'),
                    'BAIRRO' => $this->input->post('bairro'),
                    'CIDADE' => $this->input->post('cidade'),
                    'NUMRESIDENCIA' => $this->input->post('residencia'),
                    'SENHA' => $this->input->post('senha'),
                    'SEXO' => $this->input->post('sexo'),
                    'CPF' => $this->input->post('cpf'),
                    'RG' => $this->input->post('rg'),
                    'TELEFONE' => $this->input->post('telefone'),
                    'EMAIL' => $this->input->post('email'),
                    'FOTO' => $local_imagem

                );


                $retorno = $this->adm->updateAdministrador($dados,$id);
                if($retorno){
                         $this->session->set_flashdata('mensagem_manage','<div class=" alert alert-success" style=" text-align:center;"> Administrador atualizado com sucesso </div>');
                         redirect(base_url().'manage/administrador');
                }//if | retorno pessoa
                  
                
                $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o administrador no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');
                  
              
              


              }//else | Todos os dados validados

          }//if | Validação de dados
          else{

            $this->session->set_flashdata('mensagem_usuario','<div style = "text-align:center"  class=" alert alert-info">'.validation_errors().'</div>');

          }// Dados não validados

          
            //Buscando dados do administrador
            $resultado = $this->adm->getPessoaById(NULL,$id);

            //Carregamento da view de alteração
            $this->load->view('administrador/manage/alter/alter_administrador',$resultado);
            
            $this->adm->__destruct();
        
        
    }//alterAdministrador 
    
    /**
     * Altera dados do professor no banco de dados
     * @param int $id
     */
    private function alterProfessor(int $id){
        
          
        $this->load->model('professor_model','professor');
        //Verificando se professor existe no banco de dados
        $retorno = $this->professor->isProfessorById($id);
        if(!$retorno){
            $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Professor não existe na base de dados </div> ');
            log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
            redirect(base_url('/manage/professor'),'reflash');
        }//if | $retorno
          
        //Verificação
        
        $this->load->library(array('form_validation','session'));

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');


        //inicio a verificação da regras
        if ($this->form_validation->run()){

          //busco dados para verificação do campo sexo
          $sexo_inserido = $this->input->post('sexo');


          //verificação do campo sexo
          if(strcmp(strtoupper($sexo_inserido),'') == 0){

              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Campo "Sexo" não foi selecionado </div>');

          }//if | campo sexo
        
          else{

            $nome_imagem = NULL;
            $local_imagem = NULL;

          if($_FILES['imagem']['name'] != NULL){

            $nome_imagem = uniqid().'-'.time();

            //Configuração do upload da imagem
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('imagem')){

              $retorno = $this->upload->display_errors();
              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning">'.$retorno.'</div>');

            }//if | do_upload fail
            else{

              $dados_img = $this->upload->data();
              $local_imagem = $dados_img['file_path'].''.$dados_img['file_name'];


            }//else | do_upload sucess

          }//if | Imagem inserida
          else{

              $local_imagem = base_url('/user_img/avatar.png');

          }//else | imagem não inserida

                $dados = array(

                    'PRIMEIRONOME' => $this->input->post('primeiroNome'),
                    'SOBRENOME' =>  $this->input->post('sobrenome'),
                    'NASCIMENTO' => $this->input->post('nascimento'),
                    'STATUS' => 'Ativado',
                    'ESTADO' => $this->input->post('estado'),
                    'RUA' => $this->input->post('rua'),
                    'CEP' => $this->input->post('cep'),
                    'BAIRRO' => $this->input->post('bairro'),
                    'CIDADE' => $this->input->post('cidade'),
                    'NUMRESIDENCIA' => $this->input->post('residencia'),
                    'SENHA' => $this->input->post('senha'),
                    'SEXO' => $this->input->post('sexo'),
                    'CPF' => $this->input->post('cpf'),
                    'RG' => $this->input->post('rg'),
                    'TELEFONE' => $this->input->post('telefone'),
                    'EMAIL' => $this->input->post('email'),
                    'FOTO' => $local_imagem

                );


                $retorno = $this->professor->updateProfessor($dados,$id);
                if($retorno){
                         $this->session->set_flashdata('mensagem_manage','<div class=" alert alert-success" style=" text-align:center;"> Professor atualizado com sucesso </div>');
                         redirect(base_url().'manage/professor');
                }//if | retorno pessoa
                  
                
                $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível atualizar o professor no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');
                  
              }//else | Todos os dados validados

          }//if | Validação de dados
          else{

            $this->session->set_flashdata('mensagem_usuario','<div style = "text-align:center"  class=" alert alert-info">'.validation_errors().'</div>');

          }// Dados não validados

          
            //Buscando dados do professor
            $resultado = $this->professor->getPessoaById(NULL,$id);

            //Carregamento da view de alteração
            $this->load->view('administrador/manage/alter/alter_professor',$resultado);
            
            $this->professor->__destruct();
        
        
    }//alterProfessor
    
    /**
     * Altera dados do aluno no banco de dados
     * @param int $id
     */
    private function alterAluno(int $id){
        
        $this->load->model('aluno_model','aluno');
        //Verificando se aluno existe no banco de dados
        $retorno = $this->aluno->isAlunoById($id);
        if(!$retorno){
            $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Aluno não existe na base de dados </div> ');
            log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
            redirect(base_url('/manage/aluno'),'reflash');
        }//if | $retorno
          
        //Verificação
        
        $this->load->library(array('form_validation','session'));

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');


        //inicio a verificação da regras
        if ($this->form_validation->run()){

          //busco dados para verificação do campo sexo
          $sexo_inserido = $this->input->post('sexo');


          //verificação do campo sexo
          if(strcmp(strtoupper($sexo_inserido),'') == 0){

              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Campo "Sexo" não foi selecionado </div>');

          }//if | campo sexo
        
          else{

            $nome_imagem = NULL;
            $local_imagem = NULL;

          if($_FILES['imagem']['name'] != NULL){

            $nome_imagem = uniqid().'-'.time();

            //Configuração do upload da imagem
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('imagem')){

              $retorno = $this->upload->display_errors();
              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning">'.$retorno.'</div>');

            }//if | do_upload fail
            else{

              $dados_img = $this->upload->data();
              $local_imagem = $dados_img['file_path'].''.$dados_img['file_name'];


            }//else | do_upload sucess

          }//if | Imagem inserida
          else{

              $local_imagem = base_url('/user_img/avatar.png');

          }//else | imagem não inserida

                $dados = array(

                    'PRIMEIRONOME' => $this->input->post('primeiroNome'),
                    'SOBRENOME' =>  $this->input->post('sobrenome'),
                    'NASCIMENTO' => $this->input->post('nascimento'),
                    'STATUS' => 'Ativado',
                    'ESTADO' => $this->input->post('estado'),
                    'RUA' => $this->input->post('rua'),
                    'CEP' => $this->input->post('cep'),
                    'BAIRRO' => $this->input->post('bairro'),
                    'CIDADE' => $this->input->post('cidade'),
                    'NUMRESIDENCIA' => $this->input->post('residencia'),
                    'SENHA' => $this->input->post('senha'),
                    'SEXO' => $this->input->post('sexo'),
                    'CPF' => $this->input->post('cpf'),
                    'RG' => $this->input->post('rg'),
                    'TELEFONE' => $this->input->post('telefone'),
                    'EMAIL' => $this->input->post('email'),
                    'FOTO' => $local_imagem

                );


                $retorno = $this->aluno->updateAluno($dados,$id);
                if($retorno){
                         $this->session->set_flashdata('mensagem_manage','<div class=" alert alert-success" style=" text-align:center;"> Aluno atualizado com sucesso </div>');
                         redirect(base_url().'manage/aluno');
                }//if | retorno pessoa
                  
                
                $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível atualizar o aluno no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');
                  
              }//else | Todos os dados validados

          }//if | Validação de dados
          else{

            $this->session->set_flashdata('mensagem_usuario','<div style = "text-align:center"  class=" alert alert-info">'.validation_errors().'</div>');

          }// Dados não validados

          
            //Buscando dados do aluno
            $resultado = $this->aluno->getPessoaById(NULL,$id);

            //Carregamento da view de alteração
            $this->load->view('administrador/manage/alter/alter_aluno',$resultado);
            
            $this->aluno->__destruct();
        
    }//alterAluno
    
    /**
     * Verifica se o cadastro existe e o redireciona para o método de cadastro
     * @param type $entidade
     */
    public function cadastro($entidade = '') {

        isSessionStarted();

        //Seleciona o método de cadastro
        switch(strtoupper($entidade)){

          case 'ADMINISTRADOR':
                $this->cadAdministrador();
            break;
          case 'PROFESSOR':
              $this->cadProfessor();
              break;
          case 'ALUNO':
              $this->cadAluno();
              break;

          default: show_404();

        }//switch

    }//cadastro

    /**
     * Registra um novo aluno no banco de dados
     */
    private function cadAluno(){
        
        
        $this->load->library(array('form_validation','session'));
        $this->load->model('aluno_model','aluno');

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');


        //inicio a verificação da regras
        if ($this->form_validation->run()){

          //busco dados para verificação do campo sexo
          $sexo_inserido = $this->input->post('sexo');

          //busco dados para verificação do email no banco de dados
          $email_inserido = $this->input->post('email');
          $retorno = $this->aluno->get_pessoa($email_inserido);

          //verificação do campo sexo
          if(strcmp(strtoupper($sexo_inserido),'') == 0){

              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Campo "Sexo" não foi selecionado </div>');

          }//if | campo sexo
          //verificação do email no banco de dados
          else if($retorno != NULL){

             $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Este email já está cadastrado</div>');

          }//if | retorno


          //Email não está cadastrado no banco de dados
          else{

            $nome_imagem = NULL;
            $local_imagem = NULL;

          if($_FILES['imagem']['name'] != NULL){

            $nome_imagem = uniqid().'-'.time();

            //Configuração do upload da imagem
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('imagem')){

              $retorno = $this->upload->display_errors();
              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning">'.$retorno.'</div>');

            }//if | do_upload fail
            else{

              $dados_img = $this->upload->data();
              $local_imagem = $dados_img['file_path'].''.$dados_img['file_name'];


            }//else | do_upload sucess

          }//if | Imagem inserida
          else{

              $local_imagem = base_url('/user_img/avatar.png');

          }//else | imagem não inserida

                $dados = array(

                    'PRIMEIRONOME' => "" . $this->input->post('primeiroNome') . "",
                    'SOBRENOME' => "". $this->input->post('sobrenome') . "",
                    'NASCIMENTO' => "" . $this->input->post('nascimento') . "",
                    'STATUS' => 'Ativado',
                    'ESTADO' => "" . $this->input->post('estado') . "",
                    'RUA' => "" . $this->input->post('rua') . "",
                    'CEP' => "" . $this->input->post('cep') . "",
                    'BAIRRO' => "" . $this->input->post('bairro') . "",
                    'CIDADE' => "" . $this->input->post('cidade') . "",
                    'NUMRESIDENCIA' => $this->input->post('residencia'),
                    'SENHA' => "" . $this->input->post('senha') . "",
                    'SEXO' => "" . $this->input->post('sexo') . "",
                    'CPF' => "" . $this->input->post('cpf') . "",
                    'RG' => "" . $this->input->post('rg') . "",
                    'TELEFONE' => "" . $this->input->post('telefone') . "",
                    'EMAIL' => "" . $this->input->post('email') . "",
                    'FOTO' => "" . $local_imagem . ""

                );


                $retorno = $this->aluno->insert_pessoa($dados);
                if(!$retorno){

                      $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o aluno no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');

                }//if | retorno pessoa
                else{

                  $dados_pessoa = $this->aluno->get_pessoa_only($dados['EMAIL']);

                  $dados = array ( 'FK_PESSOA_ID' =>  $dados_pessoa[0]['ID']);
                  $retorno = $this->aluno->insert_aluno($dados);

                  if(!$retorno){

                        $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o aluno no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');

                  }//if | retorno aluno
                  else{

                      $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Aluno cadastrado com sucesso </div> ');
                      redirect(base_url().'manage/aluno');

                  }//else | cadastro sucess


                } //else | retorno pessoa


              }//else | Todos os dados validados

          }//if | Validação de dados
          else{

            $this->session->set_flashdata('mensagem_usuario','<div style = "text-align:center"  class=" alert alert-info">'.validation_errors().'</div>');

          }// Dados não validados



            //Carregamento da view de cadastro
            $this->load->view('administrador/manage/cadastro_aluno');

        
    }//cadAluno
    
    
    /**
     * Registra um novo professor no banco de dados
     */
    private function cadProfessor(){
        
        $this->load->library(array('form_validation','session'));
        $this->load->model('professor_model','professor');

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');


        //inicio a verificação da regras
        if ($this->form_validation->run()){

          //busco dados para verificação do campo sexo
          $sexo_inserido = $this->input->post('sexo');

          //busco dados para verificação do email no banco de dados
          $email_inserido = $this->input->post('email');
          $retorno = $this->professor->get_pessoa($email_inserido);

          //verificação do campo sexo
          if(strcmp(strtoupper($sexo_inserido),'') == 0){

              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Campo "Sexo" não foi selecionado </div>');

          }//if | campo sexo
          //verificação do email no banco de dados
          else if($retorno != NULL){

             $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Este email já está cadastrado</div>');

          }//if | retorno


          //Email não está cadastrado no banco de dados
          else{

            $nome_imagem = NULL;
            $local_imagem = NULL;

          if($_FILES['imagem']['name'] != NULL){

            $nome_imagem = uniqid().'-'.time();

            //Configuração do upload da imagem
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('imagem')){

              $retorno = $this->upload->display_errors();
              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning">'.$retorno.'</div>');

            }//if | do_upload fail
            else{

              $dados_img = $this->upload->data();
              $local_imagem = $dados_img['file_path'].''.$dados_img['file_name'];


            }//else | do_upload sucess

          }//if | Imagem inserida
          else{

              $local_imagem = base_url('/user_img/avatar.png');

          }//else | imagem não inserida

                $dados = array(

                    'PRIMEIRONOME' => "" . $this->input->post('primeiroNome') . "",
                    'SOBRENOME' => "". $this->input->post('sobrenome') . "",
                    'NASCIMENTO' => "" . $this->input->post('nascimento') . "",
                    'STATUS' => 'Ativado',
                    'ESTADO' => "" . $this->input->post('estado') . "",
                    'RUA' => "" . $this->input->post('rua') . "",
                    'CEP' => "" . $this->input->post('cep') . "",
                    'BAIRRO' => "" . $this->input->post('bairro') . "",
                    'CIDADE' => "" . $this->input->post('cidade') . "",
                    'NUMRESIDENCIA' => $this->input->post('residencia'),
                    'SENHA' => "" . $this->input->post('senha') . "",
                    'SEXO' => "" . $this->input->post('sexo') . "",
                    'CPF' => "" . $this->input->post('cpf') . "",
                    'RG' => "" . $this->input->post('rg') . "",
                    'TELEFONE' => "" . $this->input->post('telefone') . "",
                    'EMAIL' => "" . $this->input->post('email') . "",
                    'FOTO' => "" . $local_imagem . ""

                );


                $retorno = $this->professor->insert_pessoa($dados);
                if(!$retorno){

                      $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o professor no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');

                }//if | retorno pessoa
                else{

                  $dados_pessoa = $this->professor->get_pessoa_only($dados['EMAIL']);



                  $dados = array ( 'FK_PESSOA_ID' =>  $dados_pessoa[0]['ID']);
                  $retorno = $this->professor->insert_professor($dados);

                  if(!$retorno){

                        $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o professor no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');

                  }//if | retorno professor
                  else{

                      $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Professor cadastrado com sucesso </div> ');
                      redirect(base_url().'manage/professor');

                  }//else | cadastro sucess


                } //else | retorno pessoa


              }//else | Todos os dados validados

          }//if | Validação de dados
          else{

            $this->session->set_flashdata('mensagem_usuario','<div style = "text-align:center"  class=" alert alert-info">'.validation_errors().'</div>');

          }// Dados não validados



            //Carregamento da view de cadastro
            $this->load->view('administrador/manage/cadastro_professor');

        
    }//cadProfessor
    
    
    /**
     * Faz o cadastro do administrador no banco de dados
     */
    private function cadAdministrador() {

        $this->load->library(array('form_validation','session'));
        $this->load->model('Administrador_model','administrador');

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');


        //inicio a verificação da regras
        if ($this->form_validation->run()){

          //busco dados para verificação do campo sexo
          $sexo_inserido = $this->input->post('sexo');

          //busco dados para verificação do email no banco de dados
          $email_inserido = $this->input->post('email');
          $retorno = $this->administrador->get_pessoa($email_inserido);

          //verificação do campo sexo
          if(strcmp(strtoupper($sexo_inserido),'') == 0){

              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Campo "Sexo" não foi selecionado </div>');

          }//if | campo sexo
          //verificação do email no banco de dados
          else if($retorno != NULL){

             $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning"> Este email já está cadastrado</div>');

          }//if | retorno


          //Email não está cadastrado no banco de dados
          else{

            $nome_imagem = NULL;
            $local_imagem = NULL;

          if($_FILES['imagem']['name'] != NULL){

            $nome_imagem = uniqid().'-'.time();

            //Configuração do upload da imagem
            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = './user_img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('imagem')){

              $retorno = $this->upload->display_errors();
              $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-warning">'.$retorno.'</div>');

            }//if | do_upload fail
            else{

              $dados_img = $this->upload->data();
              $local_imagem = $dados_img['file_path'].''.$dados_img['file_name'];


            }//else | do_upload sucess

          }//if | Imagem inserida
          else{

              $local_imagem = base_url('/user_img/avatar.png');

          }//else | imagem não inserida

                $dados = array(

                    'PRIMEIRONOME' => "" . $this->input->post('primeiroNome') . "",
                    'SOBRENOME' => "". $this->input->post('sobrenome') . "",
                    'NASCIMENTO' => "" . $this->input->post('nascimento') . "",
                    'STATUS' => 'Ativado',
                    'ESTADO' => "" . $this->input->post('estado') . "",
                    'RUA' => "" . $this->input->post('rua') . "",
                    'CEP' => "" . $this->input->post('cep') . "",
                    'BAIRRO' => "" . $this->input->post('bairro') . "",
                    'CIDADE' => "" . $this->input->post('cidade') . "",
                    'NUMRESIDENCIA' => $this->input->post('residencia'),
                    'SENHA' => "" . $this->input->post('senha') . "",
                    'SEXO' => "" . $this->input->post('sexo') . "",
                    'CPF' => "" . $this->input->post('cpf') . "",
                    'RG' => "" . $this->input->post('rg') . "",
                    'TELEFONE' => "" . $this->input->post('telefone') . "",
                    'EMAIL' => "" . $this->input->post('email') . "",
                    'FOTO' => "" . $local_imagem . ""

                );


                $retorno = $this->administrador->insert_pessoa($dados);
                if(!$retorno){

                      $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o administrador no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');

                }//if | retorno pessoa
                else{

                  $dados_pessoa = $this->administrador->get_pessoa_only($dados['EMAIL']);



                  $dados = array ( 'FK_PESSOA_ID' =>  $dados_pessoa[0]['ID']);
                  $retorno = $this->administrador->insert_adm($dados);

                  if(!$retorno){

                        $this->session->set_flashdata('mensagem_usuario','<div class=" alert alert-danger"> Não foi possível cadastrar o administrador no banco de dados <br/> CONTATE O ADMINISTRADOR </div> ');

                  }//if | retorno administrador
                  else{

                      $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Administrador cadastrado com sucesso </div> ');
                      redirect(base_url().'manage/administrador');

                  }//else | cadastro sucess


                } //else | retorno pessoa


              }//else | Todos os dados validados

          }//if | Validação de dados
          else{

            $this->session->set_flashdata('mensagem_usuario','<div style = "text-align:center"  class=" alert alert-info">'.validation_errors().'</div>');

          }// Dados não validados



            //Carregamento da view de cadastro
            $this->load->view('administrador/manage/cadastro_administrador');


    }//cadAdministrador

    /** 
     * Desativa usuário no banco de dados 
     * @param type $entidade
     * @param int $id
     */
    public function desativar($entidade = NULL, int $id = NULL){
        
        isSessionStarted();
        if($entidade ==  NULL || $id == NULL){
         show_404();
         log_message('info','Access in function desativar of class Manage with out parameters');
     }//if | NULL parameters
     
      
    switch(strtoupper($entidade)){

      case 'ADMINISTRADOR':
          
          $this->load->model('administrador_model','adm');
          
          //Verificando se adminstrador existe no banco de dados
           $retorno = $this->adm->isAdministradorById($id);
           if(!$retorno){
                     $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Administrador não existe na base de dados </div> ');
                     log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
                     redirect(base_url('/manage/administrador'),'reflash');
           }//if | $retorno
          
          
          $retorno = $this->adm->desativar($id);
          if($retorno)
              $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-success"> Administrador desativado com sucesso </div> ');
          else
              $this->session->set_flashdata('mensagem_manage','  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar o administrador <striong> Contate o admnistrador do sistema </string> </div>  ');
     
          redirect(base_url('/manage/administrador'),'reflash');
          
        break;
     
      case 'PROFESSOR':
      
          
             $this->load->model('professor_model','professor');
          
          //Verificando se professor existe no banco de dados
           $retorno = $this->professor->isProfessorById($id);
           if(!$retorno){
                     $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Professor não existe na base de dados </div> ');
                     log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
                     redirect(base_url('/manage/professor'),'reflash');
           }//if | $retorno
          
          
          $retorno = $this->professor->desativar($id);
          if($retorno)
              $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-success"> Professor desativado com sucesso </div> ');
          else
              $this->session->set_flashdata('mensagem_manage','  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar o professor <striong> Contate o admnistrador do sistema </string> </div>  ');
     
          redirect(base_url('/manage/professor'),'reflash');
          
      break;
  
      case 'ALUNO':
           $this->load->model('aluno_model','aluno');
          
          //Verificando se model existe no banco de dados
           $retorno = $this->aluno->isAlunoById($id);
           if(!$retorno){
                     $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Aluno não existe na base de dados </div> ');
                     log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
                     redirect(base_url('/manage/aluno'),'reflash');
           }//if | $retorno
          
          
          $retorno = $this->aluno->desativar($id);
          if($retorno)
              $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-success"> Aluno desativado com sucesso </div> ');
          else
              $this->session->set_flashdata('mensagem_manage','  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao desativar o aluno <striong> Contate o admnistrador do sistema </string> </div>  ');
     
          redirect(base_url('/manage/aluno'),'reflash');
      break;    
      
      default: show_404();


    }//switch




    }//desativa

    /**
     * Ativa usuário no banco de dados
     * @param type $entidade
     * @param int $id
     */
    public function ativar($entidade = NULL, int $id = NULL){
     
     isSessionStarted(); 
           
     if($entidade ==  NULL || $id == NULL){
         show_404();
         log_message('info','Access in function desativar of class Manage with out parameters');
     }//if | NULL parameters
     
      
    switch(strtoupper($entidade)){

      case 'ADMINISTRADOR':
          
          $this->load->model('administrador_model','adm');
          
          //Verificando se adminstrador existe no banco de dados
           $retorno = $this->adm->isAdministradorById($id);
           if(!$retorno){
                     $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Administrador não existe na base de dados </div> ');
                     log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
                     redirect(base_url('/manage/administrador'),'reflash');
           }//if | $retorno
          
          
          $retorno = $this->adm->ativar($id);
          if($retorno)
              $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-success"> Administrador ativado com sucesso </div> ');
          else
              $this->session->set_flashdata('mensagem_manage','  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar o administrador <striong> Contate o admnistrador do sistema </string> </div>  ');
     
          redirect(base_url('/manage/administrador'),'reflash');
          
        break;
     
      case 'PROFESSOR':
      
             $this->load->model('professor_model','professor');
          
          //Verificando se professor existe no banco de dados
           $retorno = $this->professor->isProfessorById($id);
           if(!$retorno){
                     $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Professor não existe na base de dados </div> ');
                     log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
                     redirect(base_url('/manage/professor'),'reflash');
           }//if | $retorno
          
          
          $retorno = $this->professor->ativar($id);
          if($retorno)
              $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-success"> Professor ativado com sucesso </div> ');
          else
              $this->session->set_flashdata('mensagem_manage','  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar o professor <striong> Contate o admnistrador do sistema </string> </div>  ');
     
          redirect(base_url('/manage/professor'),'reflash');
          
      break;
  
      case 'ALUNO':
            $this->load->model('aluno_model','aluno');
          
            //Verificando se aluno existe no banco de dados
            $retorno = $this->aluno->isAlunoById($id);
            if(!$retorno){
                     $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-danger"> Aluno não existe na base de dados </div> ');
                     log_message('info', 'Menage->desativar('.$entidade.','.$id.') -> Entidade não existe no banco de dados');
                     redirect(base_url('/manage/aluno'),'reflash');
            }//if | $retorno
          
          
            $retorno = $this->aluno->ativar($id);
            if($retorno)
              $this->session->set_flashdata('mensagem_manage',' <div style = "text-align:center" class=" alert alert-success"> Aluno ativado com sucesso </div> ');
            else
              $this->session->set_flashdata('mensagem_manage','  <div style = "text-align:center" class=" alert alert-danger"> Ocorreu um erro ao ativar o aluno <striong> Contate o admnistrador do sistema </string> </div>  ');
     
            redirect(base_url('/manage/aluno'),'reflash');
      break;    
      
      default: show_404();


    }//switch




        
    }//ativar
    
    /**
     * Gerencia as configurações do sistema
     */
    public function configuration($option = NULL){
       
        isSessionStarted();
        
        if($option == NULL){
            
            $this->load->view('administrador/configuration');
            
        }//IF
        else{
            
            
            if(strcmp($option,'theme') == 0){
                
                $theme = $this->input->post('theme');
                $this->session->set_userdata('main_theme',$theme);
                
            }//if | theme
            
            
            $this->load->view('administrador/configuration');
            
                
        }//ELSE

    }//configuration
    
    /**
     * Lista arquivos de log do sistema
     */
    public function log(){
        
        $dropdown = NULL;
        $file = NULL;
       
        $this->load->helper('file');
        
        //Lista de arquivos
        $list_files = get_filenames(APPPATH.'/logs');
        
        //Pulo o arquivo index.html
        for($i = 1;$i < sizeof($list_files); $i++){
            
            $dropdown = $dropdown. ' <option> '.$list_files[$i].' </option>  ';
            
        }//for
        
        $dados['dropdown'] = $dropdown; 
        
        if($this->input->post('log-file') == NULL):
            $file = 'log-'. date('Y').'-'. date('m').'-'. date('d').'.php';
        else:
            $file = $this->input->post('log-file');
        endif;
        
        $dados['title'] = $file;
        
        $string_file = APPPATH.'logs/'.$file;
        
        $string_log = read_file($string_file);
        
        $this->session->set_userdata('log_text',$string_log);
        
        $this->load->view('administrador/manage/log/log_management',$dados);
        
    }//log
    
    

}//class
