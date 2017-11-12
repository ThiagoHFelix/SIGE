<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    /**
     * Construtor padrão
     */
    public function __construct() {

        parent::__construct();

        $this->load->helper(array('url', 'funcoes'));
        $this->load->library(array('session', 'pagination'));
        $this->load->helper(array('funcoes', 'form'));
        $this->load->model('administrador_model', 'administrador');
        $this->load->model('professor_model', 'professor');
        $this->load->model('aluno_model', 'aluno');

        isSessionStarted();
    }//construtor padrao


    
    
    public function falta(int $idTurma) {
        
        //XXX Variaveis 
        $dados = array();

        //XXX Busco a turma informada
        $this->load->model('Turma_model', 'turma');
        $turma = $this->turma->getWhere(array('ID' => $idTurma));
        
        //XXX Verifico se foi encontrada
        if ($turma === NULL):
            
            //XXX Armazeno a turma para mostrar informaçoes na view
            $dados['TURMA'] = $turma;
            
            //XXX A turma nao foi encontrada, entao aviso o usuario 
            showError('mensagem_nota', 'Esta turma não foi encontrada no banco de dados verifique e tente novamente mais tarde', 'alert alert-danger');

        else:

            //XXX As informaçoes sao armazenadas para serem mostradas na view  
            $dados['TURMA'] = $turma;
        
            //XXX Busco materia da turma
            $this->load->model('Materia_model','materia');
            $dados['MATERIA'] = $this->materia->getWhere(array('ID' => $turma[0]['FK_MATERIA_ID']));
           
            //XXX Busco todos os alunos que fazem parte desta turma
            $this->load->model('curso_model', 'curso');
            $alunos = $this->curso->query('SELECT * FROM PESSOA,MATRICULA_TURMA WHERE MATRICULA_TURMA.FK_TURMA_ID = '.$idTurma.' AND MATRICULA_TURMA.FK_PESSOA_ID = PESSOA.ID');
            
            //XXX Verifico se algum aluno foi encontrado
            if($alunos === NULL):
                
                //XXX Nenhum aluno encontrado, informo o usuario
                showError('mensagem_nota', 'Nenhum aluno desta turma foi encontrado', 'alert alert-info');

            else:
                
                //XXX Registro os alunos na variavel dados para acessar na view
                $dados['alunos'] = $alunos;
                
            endif;
            

        endif;
        
        

        //XXX Validaçao de dados da view
        if ($this->validationFalta($idTurma)):

            //XXX Insiro a nota no banco de dados   
            $this->insertFalta($idTurma);
            
            //XXX Limpo os dados do POST para nao aparecer novamente nos campos
            $_POST = array();

        endif;

        $this->load->view('administrador/manage/cadastro/cadastro_falta', $dados);
        
    }//falta

    
    
    
    
    /**
     * Realiza o cadastro de nota de um aluno em uma turma
     * @param int $idTurma ID da turma
     */
    public function nota(int $idTurma) {
        
        //XXX Variaveis 
        $dados = array();

        //XXX Busco a turma informada
        $this->load->model('Turma_model', 'turma');
        $turma = $this->turma->getWhere(array('ID' => $idTurma));
        
        //XXX Verifico se foi encontrada
        if ($turma === NULL):
            
            //XXX Armazeno a turma para mostrar informaçoes na view
            $dados['TURMA'] = $turma;
            
            //XXX A turma nao foi encontrada, entao aviso o usuario 
            showError('mensagem_nota', 'Esta turma não foi encontrada no banco de dados verifique e tente novamente mais tarde', 'alert alert-danger');

        else:

            //XXX As informaçoes sao armazenadas para serem mostradas na view  
            $dados['TURMA'] = $turma;
        
            //XXX Busco materia da turma
            $this->load->model('Materia_model','materia');
            $dados['MATERIA'] = $this->materia->getWhere(array('ID' => $turma[0]['FK_MATERIA_ID']));
           
            //XXX Busco todos os alunos que fazem parte desta turma
            $this->load->model('curso_model', 'curso');
            $alunos = $this->curso->query('SELECT * FROM PESSOA,MATRICULA_TURMA WHERE MATRICULA_TURMA.FK_TURMA_ID = '.$idTurma.' AND MATRICULA_TURMA.FK_PESSOA_ID = PESSOA.ID');
            
            //XXX Verifico se algum aluno foi encontrado
            if($alunos === NULL):
                
                //XXX Nenhum aluno encontrado, informo o usuario
                showError('mensagem_nota', 'Nenhum aluno desta turma foi encontrado', 'alert alert-info');

            else:
                
                //XXX Registro os alunos na variavel dados para acessar na view
                $dados['alunos'] = $alunos;
                
            endif;
            

        endif;
        
        

        //XXX Validaçao de dados da view
        if ($this->validationNota($idTurma)):

            //XXX Insiro a nota no banco de dados   
            $this->insertNota($idTurma);
            
            //XXX Limpo os dados do POST para nao aparecer novamente nos campos
            $_POST = array();

        endif;

        $this->load->view('administrador/manage/cadastro/cadastro_nota', $dados);
        
    }//nota

    
    
    /**
     * Validaçao de campos da view CADASTRO_NOTA
     * @param int $idTurma
     * @return boolean
     */
    public function validationNota(int $idTurma) {
        
        //XXX Carregamento de bibliotecas
        $this->load->library('form_validation');
        $this->load->model('Notas_model','nota');
        
        //XXX Variaveis
        $nota = NULL;
        $notas_econtradas = NULL;
        $id_aluno = NULL;
        $id_turma = $idTurma;
        $num_prova = NULL;
        
        //XXX Criaçao de regras dos campos
        $this->form_validation->set_rules('aluno','ALUNO','required|alpha_numeric|trim');
        $this->form_validation->set_rules('nota','NOTA','required|decimal|trim|max_length[4]|min_length[3]');
        $this->form_validation->set_rules('numeroProva','NUMERO DA PROVA','required|is_natural|trim');
        $this->form_validation->set_rules('complemento','Complemento','required|trim|max_length[250]');
        
        //XXX Executo a validaçao
        if($this->form_validation->run()):
            
            //XXX Verifico se a nota e no maximo 10 e no minimo 0
            $nota = $this->input->post('nota');
            if($nota >= 0 && $nota <= 10):
                
                $id_aluno = $this->input->post('aluno');
                $num_prova = $this->input->post('numeroProva');
                
                //XXX Busco no banco de dados as notas com o mesmo numero inserido
                $notas_econtradas = $this->nota->query(' SELECT * FROM AVALIADO WHERE AVALIADO.FK_PESSOA_ID = '.$id_aluno.' AND AVALIADO.FK_TURMA_ID = '.$id_turma.' AND NUMPROVA = '.$num_prova);
                
                //XXX Registro no log o SQL
                log_message('DEBUG', 'SQL de busca no cadastro de notas ===> '.' SELECT * AVALIADO WHERE AVALIADO.FK_PESSOA_ID = '.$id_aluno.' AND AVALIADO.FK_TURMA_ID = '.$id_turma.' AND NUMPROVA = '.$num_prova);
           
                //XXX Verifico se este numero de nota ja foi inserido para este aluno
                if($notas_econtradas === NULL):
                    
                    //XXX Este numero nao foi inserido
                    return TRUE;
                    
                else:
                    //XXX Aviso que este numero de nota ja foi inserido para este aluno
                    showError('mensagem_nota', 'Este número da nota já foi inserido para este aluno', '');
                    
                endif;
                
            else:
                
                showError('mensagem_nota', 'Nota inválida, a nota deve ser maior que 0 e menor que 10' , '');
                
            endif;
            
        else:
            
            //XXX Mostro ao usuario o que ele errou
            showError('mensagem_nota', validation_errors() , '');
            
        endif;
        
        return FALSE; 
        
    }//validationNota


   /**
    * Validaçao de campos do cadastro de faltas
    * @param int $idTurma ID da turma
    * @return boolean TRUE se os campos forem validados e FALSE se nao
    */
    public function validationFalta(int $idTurma) {
        
        //XXX Carregamento de bibliotecas
        $this->load->library('form_validation');
        $this->load->model('Notas_model','nota');
        
        //XXX Variaveis
   
        
        
        //XXX Criaçao de regras dos campos
        $this->form_validation->set_rules('aluno','ALUNO','required|alpha_numeric|trim');
        $this->form_validation->set_rules('frequencia','FREQUENCIA','required|alpha_numeric|trim');
        $this->form_validation->set_rules('aula_dia','AULA DO DIA','required|alpha_numeric|trim');
         $this->form_validation->set_rules('complemento','Complemento','required|trim|max_length[250]');
        
        //XXX Executo a validaçao
        if($this->form_validation->run()):
           
            return TRUE;
           
        else:
            
            //XXX Mostro ao usuario o que ele errou
            showError('mensagem_nota', validation_errors() , '');
            
        endif;
        
        return FALSE; 
        
    }//validationNota

    
    public function insertFalta(int $idTurma){
        
        
        //XXX Carregamento de bibliotecas
        $this->load->model('Faltas_model','faltas');
        
        //XXX Variaveis
        $dados_frequencia = array(
            
            'FK_TURMA_ID' => $idTurma,
            'FK_PESSOA_ID' => $this->input->post('aluno'),
            'PRESENCA' => $this->input->post('frequencia'),
            'ASSUNTO_AULA' => $this->input->post('complemento'),
            'AULA' => $this->input->post('aula_dia'),
            'DIA_SEMANA' => date('l')
                
        );
          
        $retorno = $this->faltas->insert($dados_frequencia);  
        
        //XXX Verifico se o insert foi bem sucedido
        if($retorno === TRUE):
            
            showError('mensagem_nota', 'A Frequencia foi inserida com sucesso', 'alert alert-success');
            return TRUE;
            
        else:
            //XXX Insert foi mau sucedido
            
            //XXX Aviso o usuario
            showError('mensagem_nota','Ocorreu um erro ao inserir a FREQUENCIA no banco de dados - Contate o ADMINISTRADOR se o problema continuar', 'alert alert-info');
            return FALSE;
            
        endif;
          
    }//insertNota

    
    public function insertNota(int $idTurma){
        
        //XXX Variaveis
        $dados_nota = array(
            'FK_TURMA_ID' => $idTurma,
            'FK_PESSOA_ID' => $this->input->post('aluno'),
            'NOTA' => $this->input->post('nota'),
            'COMPLEMENTO' => $this->input->post('complemento'),
            'NUMPROVA' => $this->input->post('numeroProva')
        );
          
        $retorno = $this->nota->insert($dados_nota);  
        
        //XXX Verifico se o insert foi bem sucedido
        if($retorno === TRUE):
            
            showError('mensagem_nota', 'A nota foi inserida com sucesso', 'alert alert-success');
            return TRUE;
            
        else:
            //XXX Insert foi mau sucedido
            
            //XXX Aviso o usuario
            showError('mensagem_nota','Ocorreu um erro ao inserir a nota no banco de dados - Contate o ADMINISTRADOR se o problema continuar', 'alert alert-info');
            return FALSE;
            
        endif;
          
    }//insertNota


    /**
     * Seleciona o Aluno para fazer a matricula
     */
    public function selectAlunoTurma() {


        //Buscar todos os Alunos
        $alunos = $this->aluno->getAll();
        if ($alunos !== NULL):

            $dados['alunos'] = $alunos;

        else:

            showError('mensagem_selectAluno', 'Não há ALUNOS cadastrados, por favor cadastre para continuar', 'warning');

        endif;


        $this->load->view('administrador/manage/cadastro/Matricula_Turma/select_aluno', $dados);
    }//matriculaTurma



    /**
     * Verifica se o aluno existe
     * @param int $id
     * @return boolean TRUE se o aluno existe e FALSE se nao
     */
    private function alunoExist(int $id) {

        $return = $this->aluno->getAlunoById($id);

        if ($return !== NULL):
            return TRUE;
        else:
            return FALSE;
        endif;
    }//alunoExist



    /**
     * Verifica se ao menos uma turma foi escolhida para a matricula
     */
    private function verificaAlunoTurma() {

        $quantidade_materia_turma = $this->input->post('v_y');

        for ($i = 0; $i < $quantidade_materia_turma; $i++):

            $data = $this->input->post('turma_category_' . $i);

            if ($data !== NULL):
                return TRUE;
            endif;

        endfor;

        return FALSE;
    }//verificaAlunoTurma



    /**
     * 
     * @param int $id
     * @return boolean
     */
    public function alunoTurma(int $id) {

        //Verifico se o aluno existe
        if (!$this->alunoExist($id)):
            show_404();
            return FALSE;
        endif;

        //Verificando se ha Materias registradas
        $this->load->model('Materia_model', 'materia');
        $materias = $this->materia->getAll();
        if ($materias !== NULL):

            $dados['materias'] = $materias;
            //Verificando Cursos registrados
            $this->load->model('Curso_model', 'curso');
            $cursos = $this->curso->getAll();
            if ($cursos !== NULL):
                //Verifico se ALUNO existe
                $aluno = $this->aluno->getAlunoById($id);
                if ($aluno !== NULL):

                    //Registro dados do aluno
                    $dados['aluno'] = $aluno;
                    //Busco curso do aluno
                    $cursoAluno = $this->curso->getWhere(array('ID' => $aluno['FK_CURSO_ID']))[0];

                    if ($cursoAluno !== NULL):


                        //Registro dados do curso
                        $dados['curso'] = $cursoAluno;

                        //FIXIT  query apenas para teste, fazer funçao no model para isso
                        $materiasCurso = $this->curso->query('SELECT * FROM CURSO_MATERIA,MATERIA 
                            WHERE 
                                CURSO_MATERIA.FK_CURSO_ID = ' . $cursoAluno['ID'] . ' AND 
                                CURSO_MATERIA.FK_MATERIA_ID = MATERIA.ID'
                        );

                        //Verifico se existem materias neste curso
                        if ($materiasCurso !== NULL):

                            $dados['materiasCurso'] = $materiasCurso;

                            $this->load->model('Turma_model', 'turma');

                            //Busco todas as matriculas em turmas deste aluno no banco de dados
                            $dados['matriculas'] = $this->curso->query(' SELECT * FROM MATRICULA_TURMA WHERE FK_PESSOA_ID = ' . $aluno['ID']);


                            if ($this->verificaAlunoTurma()):

                                if ($this->insertMatriculaTurma($id)):

                                    // showError('mensagem_MatriculaTurma', 'Matricula realizada com sucesso', 'info');
                                    showMessegeModal('mensagem_MatriculaTurma', 'Sucesso', '<p>Matricula realizada com sucesso</p>.<p> Voce esta cadastrado nas seguintes materias: </p>');
                                else:
                                    showError('mensagem_MatriculaTurma', 'Ocorreu um erro interno durante o cadastro <strong> CONTATE O ADMINISTRADOR SE O PROBLEMA PERSISTIR </strong>', 'info');
                                endif;


                            else:
                            // showError('mensagem_MatriculaTurma', 'Nenhuma turma foi selecionada', 'info');
                            endif;

                        else:
                            showError('mensagem_MatriculaTurma', 'Não foi possível encontrar as MATERIAS deste CURSO <strong> Entre em contato com o administrador </strong>', 'info');
                        endif;

                    else:
                        showError('mensagem_MatriculaTurma', 'Não foi possível encontrar o CURSO do ALUNO', 'info');
                    endif;

                    $dados['aluno'] = $aluno;
                else:
                    showError('mensagem_MatriculaTurma', 'Aluno não registrado no banco de dados', 'info');
                endif;

            else:
                showError('mensagem_MatriculaTurma', ' Não há CURSOS cadastrados, por favor cadastre para continuar ', 'info');
            endif;

        else:

            showError('mensagem_MatriculaTurma', ' Não há MATÉRIAS cadastrados, por favor cadastre para continuar ', 'info');

        endif;


        $this->load->view('administrador/manage/cadastro/Matricula_Turma/cadastro_matriculaTurma', $dados);
    }//alunoTurma



    /**
     * Matricula aluno em uma turma
     */
    private function insertMatriculaTurma(int $idPessoa) {

        $quantidade_materia_turma = $this->input->post('v_y');

        for ($i = 0; $i < $quantidade_materia_turma; $i++):

            $data = $this->input->post('turma_category_' . $i);

            //Turma Inserida
            if ($data !== NULL):

                $dados = array(
                    'FK_TURMA_ID' => $data,
                    'FK_PESSOA_ID' => $idPessoa,
                    'INFOADD' => '',
                    'STATUS' => 'ATIVADO'
                );

                $retorno = $this->aluno->insertAlunoTurma($dados);
                if ($retorno === FALSE):
                    return FALSE;
                endif;


            endif;

        endfor;

        return TRUE;
    }//matriculaTurma



    public function turma() {

        //Busco todas as Materias
        $dados['materias'] = $this->getMaterias();

        if ($dados['materias'] !== NULL):

            //Busco todas os Professores
            $dados['professores'] = $this->getProfessores();

            if ($dados['professores'] !== NULL):

                //Busco todos os turnos
                $dados['turnos'] = $this->getTurnos();
                if ($dados['turnos'] !== NULL):

                    // die('asdasd'.$this->input->post('titulo'));

                    if ($this->validationTurma() === TRUE):


                        if ($this->validationDiaSemana() === TRUE):

                            //inserir no banco de dados
                            if ($this->insertTurma()):

                                showError('mensagem_manageTurma', 'Turma cadastrada com sucesso', 'alert alert-success');
                                redirect(base_url('/manage/turma'));

                            else:
                                showError('mensagem_usuarioTurma', 'Ocorreu um erro ao cadastrar a TURMA <strong>Se o problema persistir contate o ADMINISTRADOR </strong>', 'alert alert-danger');
                            endif;

                        endif;

                    endif;

                endif;

            endif;

        endif;


        $this->load->view('/administrador/manage/cadastro/cadastro_turma', $dados);
    }//turma



    private function insertTurma() {

        $dados = array(
            'DATAINICIAL' => $this->input->post('datainicio'),
            'STATUS' => 'ATIVADO',
            'INFOADD' => $this->input->post('infoadd'),
            'SALA' => $this->input->post('sala'),
            'TEMPOAULA' => $this->input->post('tempoaula'),
            'TITULO' => $this->input->post('titulo'),
            'QUANTDIA' => $this->input->post('quantaula'),
            'QUANTMAXALUNO' => $this->input->post('maxalunos'),
            'QUANTMINALUNO' => $this->input->post('minalunos'),
            'FK_MATERIA_ID' => $this->input->post('materias'),
            'FK_PESSOA_ID' => $this->input->post('professores'),
            'FK_TURNO_ID' => $this->input->post('turno'),
        );

        $return = $this->turma->insert($dados);

        if ($return):
            $this->insertDiaSemana();
            //$this->turma->remove($this->turma->lastID());
            return TRUE;
        else:

            return FALSE;
        endif;
    }//insertTurma



    public function insertDiaSemana() {

        foreach ($this->input->post('diasemana') as $dia):


            if (strcmp(strtoupper($dia), strtoupper('Segunda-Feira')) == 0):

                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horasegunda'),
                    'QUANTAULA' => $this->input->post('quantaula_segunda')
                );

                $this->turma->insertDiaSemana($dados);

                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));

            endif;

            if (strcmp(strtoupper($dia), strtoupper('Terca-Feira')) == 0):

                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horaterca'),
                    'QUANTAULA' => $this->input->post('quantaula_terca')
                );

                $this->turma->insertDiaSemana($dados);
                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));

            endif;

            if (strcmp(strtoupper($dia), strtoupper('Quarta-Feira')) == 0):

                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horaquarta'),
                    'QUANTAULA' => $this->input->post('quantaula_quarta')
                );

                $this->turma->insertDiaSemana($dados);
                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));

            endif;

            if (strcmp(strtoupper($dia), strtoupper('Quinta-Feira')) == 0):

                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horaquinta'),
                    'QUANTAULA' => $this->input->post('quantaula_quinta')
                );

                $this->turma->insertDiaSemana($dados);

                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));

            endif;

            if (strcmp(strtoupper($dia), strtoupper('Sexta-Feira')) == 0):


                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horasexta'),
                    'QUANTAULA' => $this->input->post('quantaula_sexta')
                );

                $this->turma->insertDiaSemana($dados);
                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));


            endif;

            if (strcmp(strtoupper($dia), strtoupper('Sabado')) == 0):

                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horasabado'),
                    'QUANTAULA' => $this->input->post('quantaula_sabado')
                );

                $this->turma->insertDiaSemana($dados);
                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));


            endif;

            if (strcmp(strtoupper($dia), strtoupper('Domingo')) == 0):

                $dados = array(
                    'TITULO' => $dia,
                    'HORAINICIAL' => $this->input->post('horadomingo'),
                    'QUANTAULA' => $this->input->post('quantaula_domingo')
                );

                $this->turma->insertDiaSemana($dados);
                $this->turma->insertRelacao(array(' FK_TURMA_ID' => $this->turma->lastID(), 'FK_DIA_SEMANA_ID' => $this->turma->lastIdDiaSemana()));


            endif;


        endforeach;
    }//insertDiaSemana



    /**
     *  Busca todas as materias para o cadastro de TURMA
     * @return type Array se encontrar, NULL se nao encontrar
     */
    private function getMaterias() {

        $this->load->model('Materia_model', 'materia');
        $materias = $this->materia->getAll();
        if ($materias !== NULL):
            return $materias;
        else:
            showError('mensagem_usuarioTurma', 'Não há Materias cadastradas, por favor cadastre antes de criar uma Turma', 'alert alert-warning');
            return NULL;
        endif;
    }//getMaterias



    /**
     *  Busca todas os professores para o cadastro de TURMA
     * @return type Array se encontrar, NULL se nao encontrar
     */
    private function getProfessores() {

        $this->load->model('Professor_model', 'materia');
        $professores = $this->professor->getAll();
        if ($professores !== NULL):
            return $professores;
        else:
            showError('mensagem_usuarioTurma', 'Não há Professores(as) cadastrados, por favor cadastre antes de criar uma Turma', 'alert alert-warning');
            return NULL;
        endif;
    }//getProfessores



    /**
     *  Busca todas os turnos para o cadastro de TURMA
     * @return type Array se encontrar, NULL se nao encontrar
     */
    private function getTurnos() {


        $this->load->model('Turma_model', 'turma');
        $turnos = $this->turma->getAllTurno();
        if ($turnos !== NULL):
            return $turnos;
        else:
            showError('mensagem_usuarioTurma', 'Não há Turno cadastrado, por favor cadastre antes de criar uma Turma', 'alert alert-warning');
            return NULL;
        endif;
    }//getTurnos



    private function validationDiaSemana() {

        if ($this->input->post('diasemana') !== NULL):

            foreach ($this->input->post('diasemana') as $dia):

                $this->makeValidationDia($dia);

            endforeach;

            if ($this->form_validation->run()):
                return TRUE;
            endif;

            showError('mensagem_usuarioTurma', validation_errors(), 'alert alert-warning');
            return FALSE;

        else:
            showError('mensagem_usuarioTurma', 'Nenhum dia da semana foi inserido, insira no minimo um para continuar', 'alert alert-warning');
            return FALSE;
        endif;
    }//validationDiaSemana



    /**
     * Cria rules para os dias da semana selecionados 
     * @param type $dia Dia atual
     */
    private function makeValidationDia($dia) {


        if (strcmp(strtoupper($dia), strtoupper('Segunda-Feira')) == 0):

            $this->form_validation->set_rules('horasegunda', 'Horaria de Inicio na Segunda-Feira', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_segunda', 'Quantidade de Aulas na Segunda-Feira', 'trim|max_length[3]|required|alpha_numeric');

        endif;

        if (strcmp(strtoupper($dia), strtoupper('Terca-Feira')) == 0):

            $this->form_validation->set_rules('horaterca', 'Horaria de Inicio na Terça-Feira', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_terca', 'Quantidade de Aulas na Terça-Feira', 'trim|max_length[3]|required|alpha_numeric');

        endif;

        if (strcmp(strtoupper($dia), strtoupper('Quarta-Feira')) == 0):

            $this->form_validation->set_rules('horaquarta', 'Horaria de Inicio na Quarta-Feira', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_quarta', 'Quantidade de Aulas na Quarta-Feira', 'trim|max_length[3]|required|alpha_numeric');

        endif;

        if (strcmp(strtoupper($dia), strtoupper('Quinta-Feira')) == 0):

            $this->form_validation->set_rules('horaquinta', 'Horaria de Inicio na Quinta-Feira', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_quinta', 'Quantidade de Aulas na Quinta-Feira', 'trim|max_length[3]|required|alpha_numeric');

        endif;

        if (strcmp(strtoupper($dia), strtoupper('Sexta-Feira')) == 0):

            $this->form_validation->set_rules('horasexta', 'Horaria de Inicio na Sexta-Feira', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_sexta', 'Quantidade de Aulas na Sexta-Feira', 'trim|max_length[3]|required|alpha_numeric');

        endif;

        if (strcmp(strtoupper($dia), strtoupper('Sabado')) == 0):

            $this->form_validation->set_rules('horasabado', 'Horaria de Inicio na Sabado', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_sabado', 'Quantidade de Aulas na Sabado', 'trim|max_length[3]|required|alpha_numeric');

        endif;

        if (strcmp(strtoupper($dia), strtoupper('Domingo')) == 0):

            $this->form_validation->set_rules('horadomingo', 'Horaria de Inicio na Domingo', 'trim|max_length[8]|min_length[8]|required');
            $this->form_validation->set_rules('quantaula_domingo', 'Quantidade de Aulas na Domingo', 'trim|max_length[3]|required|alpha_numeric');

        endif;
    }//makeValidationDIa



    private function validationTurma() {


        $this->load->library('form_validation');

        //Criando regras de validaçao
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|max_length[50]|required');
        $this->form_validation->set_rules('materias', 'Materia', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('professores', 'Professor', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('maxalunos', 'Maximo de Alunos', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('minalunos', 'Minimo de Alunos', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('tempoaula', 'Tempo da Aula', 'trim|required');
        $this->form_validation->set_rules('turno', 'Turno', 'trim|required');
        $this->form_validation->set_rules('sala', 'Sala', 'trim|max_length[12]');
        $this->form_validation->set_rules('quantaula', 'Quantidade de Aulas', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('tempoaula', 'Tempo da Aula', 'trim|required');
        $this->form_validation->set_rules('infoadd', 'Informaçoes Adicionais', 'trim|max_length[255]');
        $this->form_validation->set_rules('datainicio', 'Data de Inicio da Turma', 'required|trim|max_length[10]');

        if ($this->form_validation->run()):
            return TRUE;
        else:
            showError('mensagem_usuarioTurma', validation_errors(), 'alert alert-warning');
            return FALSE;
        endif;
    }//turma



    public function aviso() {

        $this->load->helper(array('form', 'url'));
        if ($this->validaAviso()) {

            if ($this->insertAviso()):
                showError('mensagem_manageAviso', 'Aviso criado com sucesso', 'success');
                redirect(base_url('/manage/aviso'));
            endif;
        }//if

        $this->load->view('/administrador/manage/cadastro/cadastro_aviso');
    }//aviso



    /**
     * Insere aviso no banco de dados
     * @return boolean TRUE or FALSE
     */
    private function insertAviso() {


        $this->load->model('Aviso_model', 'aviso');

        $titulo = $this->input->post('titulo');
        $mensagem = $this->input->post('mensagem');

        $return = $this->aviso->insert(array('TITULO' => $titulo, 'MENSAGEM' => $mensagem));
        if ($return):

            $avisoPara = $this->input->post('avisopara');

            for ($i = 0; $i < count($avisoPara); $i++):


                if (strcmp($avisoPara[$i], 'ADM') === 0):
                    $return = $this->insertAvisoAdministrador();
                    if (!$return):
                        showError('error', 'Um erro ocorreu enquanto era cadastrado o aviso com os ADMINISTRADORES <strong> ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA SE O PROBLEMA PERSISTIR </strong>', 'danger');
                        return FALSE;
                    endif;

                endif;
                if (strcmp($avisoPara[$i], 'PRO') === 0):
                    $return = $this->insertAvisoProfessor();
                    if (!$return):
                        showError('error', 'Um erro ocorreu enquanto era cadastrado o aviso com os PROFESSORES <strong> ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA SE O PROBLEMA PERSISTIR </strong>', 'danger');
                        return FALSE;
                    endif;

                endif;
                if (strcmp($avisoPara[$i], 'ALU') === 0):
                    $return = $this->insertAvisoAluno();
                    if (!$return):
                        showError('error', 'Um erro ocorreu enquanto era cadastrado o aviso com os ALUNOS <strong> ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA SE O PROBLEMA PERSISTIR </strong>', 'danger');
                        return FALSE;
                    endif;

                endif;

            endfor;

            return TRUE;
        else:
            return FALSE;
        endif;
    }

//insertAviso

    /**
     * Cadastra a relaçao de aviso com todos os professores
     * @return boolean TRUE or FALSE
     */
    private function insertAvisoProfessor() {

        $professores = $this->professor->getAll();
        if ($professores === NULL):
            return TRUE;
        endif;
        $lastID = $this->aviso->lastID();
        foreach ($professores as $professor):

            $return = $this->aviso->insertRelation(array('FK_AVISO_ID' => $lastID, 'FK_PESSOA_ID' => $professor['ID']));
            if (!$return):
                return FALSE;
            endif;

        endforeach;

        return TRUE;
    }

//insertAvisoProfessor

    /**
     * Cadastra a relacao de aviso com todos so alunos
     * @return boolean TRUE or FALSE
     */
    private function insertAvisoAluno() {

        $alunos = $this->aluno->getAll();
        if ($alunos === NULL):
            return TRUE;
        endif;

        $lastID = $this->aviso->lastID();
        foreach ($alunos as $aluno):

            $return = $this->aviso->insertRelation(array('FK_AVISO_ID' => $lastID, 'FK_PESSOA_ID' => $aluno['ID']));
            if (!$return):
                return FALSE;
            endif;

        endforeach;

        return TRUE;
    }

//insertAvisoAluno

    /**
     * Cadastra a relacao de aviso com todos os administradores
     * @return boolean TRUE or FALSE
     */
    private function insertAvisoAdministrador() {

        $administradores = $this->administrador->getAll();
        if ($administradores === NULL):
            return TRUE;
        endif;
        $lastID = $this->aviso->lastID();
        foreach ($administradores as $administrador):

            $return = $this->aviso->insertRelation(array('FK_AVISO_ID' => $lastID, 'FK_PESSOA_ID' => $administrador['ID']));
            if (!$return):
                return FALSE;
            endif;

        endforeach;

        return TRUE;
    }

//insertAvisoAdministrador

    /**
     * Faz a validacao de aviso
     * @return boolean TRUE se for validado, FALSE se nao
     */
    private function validaAviso() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required|min_length[5]|max_length[240]');

        if ($this->form_validation->run()) {

            if ($this->input->post('avisopara') === NULL) {
                showError('mensagem_aviso', 'Selecione o(s) grupo(s) que receberá o aviso', 'danger');
                return FALSE;
            }//if
            else {
                return TRUE;
            }//else            
        }//if
        else {
            showError('mensagem_aviso', validation_errors(), 'danger');
            return FALSE;
        }//else
    }

//validaAviso

    /**
     * Cadastra uma nova materia no banco de dados
     */
    public function materia() {



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

            $retorno = $this->materia->insert($dados);

            if ($retorno) {

                $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Matéria cadastrada com sucesso </div> ');
                redirect(base_url('/manage/materia'));
            }//if
            else {
                
            }//else
        }//validation
        else {


            showError('mensagem_manage', validation_errors(), 'warning');
        }//validation


        $this->load->view('/administrador/manage/cadastro/cadastro_materia');
    }

//materia

    /**
     * Cadastra um novo curso no banco de dados
     */
    public function curso() {

        $this->load->model('materia_model', 'materia');

        $dados['Mate'] = $this->materia->getAll();

        if (isset($dados['Mate'])):

            if ($this->validationCurso()):
                $this->cadastraCurso();
            endif;

        else:
            showError('mensagem_usuario', 'Não há MATERIA cadastrada, por favor CADASTRE para continuar', 'alert alert-warning');
        endif;

        $this->load->view('/administrador/manage/cadastro/cadastro_curso', $dados);
    }

//curso

    private function cadastraCurso() {

        //Verificando se o titulo existe no banco de dados
        $titulo_post = $this->input->post('titulo');

        echo 'Carregando...';

        $return = $this->curso->getAll();
        //Corresponde a existencia do titulo no banco de dados
        $existe = FALSE;

        foreach ($return as $curso) {

            if (strcmp(strtoupper($curso['TITULO']), strtoupper($titulo_post)) == 0) {

                $existe = TRUE;

                $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-warning">
                        Este titulo já existe, por favor tente outro !
                        </div> ');

                break;
            }//if
        }//foreach
        //Titulo nao existe no banco de dados
        if (!$existe) {



            $dados = array(
                'TITULO' => $this->input->post('titulo'),
                'STATUS' => 'Ativado',
                'DESCRICAO' => "DESCRIÇAO DO CURSO <br/>" . $this->input->post('descricao') . "<br/> DURAÇAO DO CURSO <br/>" . $this->input->post('duracao') .
                "<br/> VAGAS <br/>" . $this->input->post('vagas') . "<br/> CARGA HORARIA <br/>" . $this->input->post('carga_horaria')
            );

            //Inserindo curso
            $return = $this->curso->insert($dados);
            if ($return) {

                //Buscando o id da Materia inserida
                $tituloCurso = $this->input->post('titulo');
                $return = $this->curso->getWhere(array('TITULO' => $tituloCurso));
                $idCurso = $return[0]['ID'];



                $materias = $this->input->post('materia');


                foreach ($materias as $materia) {
                    $tempo = $this->input->post('semestre_' . $materia);
                    $return = $this->curso->insertRelacao(array('FK_MATERIA_ID' => $materia, 'FK_CURSO_ID' => $idCurso, 'SEMESTRE' => $tempo));
                    //Erro ao inserir
                    if (!$return) {

                        $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
                            Ocorreu um erro na tentativa de cadastro de relaçao do Curso <strong> Contate o administrador </strong>
                             </div> ');

                        //Registrar log
                    }//if
                }//foreach


                $this->session->set_flashdata('mensagem_manage', ' <div style = "text-align:center" class=" alert alert-success"> Curso cadastrado com sucesso </div> ');
                redirect(base_url('/manage/curso'));
            }//if
            else {

                $this->session->set_flashdata('mensagem_usuario', '<div class=" alert alert-danger">
                    Ocorreu um erro na tentativa de cadastro de curso <strong> Contate o administrador </strong>
                  </div> ');
            }//else
        }//if
    }

//cadastraCurso

    private function validationCurso() {

        $this->load->library(array('form_validation', 'session'));
        $this->load->model('curso_model', 'curso');


        //Declaração de variaveis
        $dados = NULL;

        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('titulo', '"Titulo"', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('descricao', '"Descriçao do Curso"', 'trim|max_length[62]');
        $this->form_validation->set_rules('duracao', '"Duraçao do curso"', 'trim|max_length[62]');
        $this->form_validation->set_rules('vagas', '"Vagas"', 'trim|max_length[62]');
        $this->form_validation->set_rules('carga_horaria', '"Carga Horaria"', 'trim|max_length[62]');



        //inicio a verificação da regras
        if ($this->form_validation->run()) {


            if ($this->validationMateriasCurso()):

                return TRUE;


            else:
                return FALSE;
            endif;
        }//validation
        else {

            showError('mensagem_usuario', validation_errors(), 'warning');
        }//validation
    }

//cadastraCurso

    /**
     * Faz a validaçao das materias inseridas no curso
     */
    private function validationMateriasCurso() {

        $materias = $this->input->post('materia');
        if ($materias !== NULL):


            //die(var_dump($this->input->post('periodo_ordinal')).var_dump($this->input->post('materia')));
            foreach ($materias as $materia):
                $this->form_validation->set_rules('semestre_' . $materia, '"Semestre"', 'trim|required');
            endforeach;


            if ($this->form_validation->run()):
                return TRUE;
            else:
                showError('mensagem_usuario', validation_errors(), 'alert alert-warning');
                return FALSE;
            endif;

        else:
            showError('mensagem_usuario', 'Nenhuma MATÉRIA foi selecionada, para cadastrar um novo curso é necessário no minimo uma', 'alert alert-warning');
            return FALSE;
        endif;
    }

//makeValidationMateriasCurso

    /**
     * Cadastra um novo administrador no banco de dados
     */
    public function administrador() {

        $returnValidacao = $this->validacaoPessoa();
        if ($returnValidacao !== NULL) {


            //Verifico se CPF ja existe no banco de dados
            $cpf = $this->input->post('cpf');
            $return = $this->administrador->verificaCPF($cpf);
            if (!$return) {

                $returnData = $this->insertData('ADMINISTRADOR', $returnValidacao);
                if ($returnData) {
                    showError('mensagem_manage', 'Administrador cadastrado com sucesso', 'success');
                    redirect(base_url() . 'manage/administrador');
                }//if    
                else {
                    showError('mensagem_usuario', 'Não foi possível cadastrar o administrador no banco de dados <strong> CONTATE O ADMINISTRADOR </strong>', 'danger');
                }//else
            }//if
            else {
                showError('mensagem_usuario', 'O CPF inserido já existe, por favor insira outro', 'warning');
            }//else
        }//if
        //Carregamento da view de cadastro
        $this->load->view('administrador/manage/cadastro/cadastro_administrador');
    }

//administrador
    /**
     * Cadastra um novo professor no banco de dados
     */

    public function professor() {

        $returnValidacao = $this->validacaoPessoa();
        if ($returnValidacao !== NULL) {


            //Verifico se CPF ja existe no banco de dados
            $cpf = $this->input->post('cpf');
            $return = $this->professor->verificaCPF($cpf);
            if (!$return) {

                $returnData = $this->insertData('PROFESSOR', $returnValidacao);
                if ($returnData) {
                    showError('mensagem_manage', 'Professor cadastrado com sucesso', 'success');
                    redirect(base_url() . 'manage/professor');
                }//if    
                else {
                    showError('mensagem_usuario', 'Não foi possível cadastrar o Professor<strong> CONTATE O ADMINISTRADOR </strong>', 'danger');
                }//else
            }//if
            else {
                showError('mensagem_usuario', 'O CPF inserido já existe, por favor insira outro', 'warning');
            }//else
        }//if
        //Carregamento da view de cadastro
        $this->load->view('administrador/manage/cadastro/cadastro_professor');
    }

//professor

    /**
     * Busca todas os Cursos para o cadastro do aluno
     */
    private function getCurso() {

        $this->load->model('Curso_model', 'curso');
        $cursos = $this->curso->getAll();
        if ($cursos !== NULL):
            return $cursos;
        else:
            showError('mensagem_usuario', 'Não há nenhum CURSO cadastrado, por favor CADASTRE um CURSO para continuar', 'alert alert-warning');
            return NULL;
        endif;
    }

//getCurso

    /**
     * Cadastra um novo aluno no banco de dados
     */
    public function aluno() {

        $dados['cursos'] = $this->getCurso();

        if ($dados['cursos'] !== NULL):

            $returnValidacao = $this->validacaoPessoa('ALUNO');
            if ($returnValidacao !== NULL) {

                //Verifico se CPF ja existe no banco de dados
                $cpf = $this->input->post('cpf');
                $return = $this->aluno->verificaCPF($cpf);
                if (!$return) {

                    $returnData = $this->insertData('ALUNO', $returnValidacao);
                    if ($returnData) {
                        showError('mensagem_manage', 'Aluno cadastrado com sucesso', 'alert alert-success');
                        redirect(base_url() . 'manage/aluno');
                    }//if    
                    else {
                        showError('mensagem_usuario', 'Não foi possível cadastrar o aluno no banco de dados <strong> CONTATE O ADMINISTRADOR </strong>', 'danger');
                    }//else
                }//if
                else {
                    showError('mensagem_usuario', 'O CPF inserido já existe, por favor insira outro', 'alert alert-warning');
                }//else
            }//if

        endif;


        //Carregamento da view de cadastro
        $this->load->view('administrador/manage/cadastro/cadastro_aluno', $dados);
    }

//aluno

    /**
     * Validaçao de dados de pessoas
     * @return type Retorna string com o local da imagem de perfil,NULL no caso de falha
     */
    private function validacaoPessoa(string $entidade = NULL) {



        $this->load->library(array('form_validation', 'session'));
        //Criando regras para a validação do formulário
        $this->form_validation->set_rules('primeiroNome', '"Primeiro nome"', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sobrenome', '"Sobrenome"', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sexo', '"Sexo"', 'trim|required|max_length[9]');
        $this->form_validation->set_rules('estado', '"Estado"', 'min_length[2]|max_length[2]');
        $this->form_validation->set_rules('rua', '"Rua"', 'max_length[20]');
        $this->form_validation->set_rules('cep', '"CEP"', 'max_length[9]');
        $this->form_validation->set_rules('bairro', '"Bairro"', 'max_length[20]');
        $this->form_validation->set_rules('cidade', '"Cidade"', 'max_length[20]');
        $this->form_validation->set_rules('cpf', '"CPF"', 'max_length[14]');
        $this->form_validation->set_rules('rg', '"RG"', 'max_length[15]');
        $this->form_validation->set_rules('nascimento', '"Nascimento"', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('senha', '"Senha"', 'trim|required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('conf_senha', '"Confirmação da senha"', 'trim|required|max_length[20]|min_length[5]|matches[senha]');
        $this->form_validation->set_rules('email', '"Email"', 'valid_email|max_length[40]');
        $this->form_validation->set_rules('telefone', '"Telefone"', 'max_length[13]');
        $this->form_validation->set_rules('telefone', '"Telefone"', 'max_length[13]');
        if (strcmp(strtoupper($entidade), 'ALUNO') == 0):
            $this->form_validation->set_rules('cursos', '"Curso"', 'required|trim');
            $this->form_validation->set_rules('infoadd', '"Informações Adicionais"', 'required|trim');
        endif;


        //inicio a verificação da regras
        if ($this->form_validation->run()) {

            $returnImage = $this->insertImage();

            if ($returnImage !== NULL) {
                return $returnImage;
            } else {
                $errors = $this->upload->display_errors();
                showError('mensagem_usuario', $errors, 'danger');
            }//else
        }//if | Validação de dados
        else {

            showError('mensagem_usuario', validation_errors(), 'danger');
            return NULL;
        }// Dados não validados
    }

//validacaoPessoa

    /**
     * Insere os dados de uma pessoa no banco de dados
     * @param string $entidade Qual tipo de pessoa
     * @param string $localImagem Local da imagem de perfil
     * @return type TRUE em caso de sucesso, FALSE em caso de falha e NULL se a entidade nao existir
     */
    private function insertData(string $entidade, string $localImagem) {

        $dados = array(
            'PRIMEIRONOME' => $this->input->post('primeiroNome'),
            'SOBRENOME' => $this->input->post('sobrenome'),
            'NASCIMENTO' => $this->input->post('nascimento'),
            'STATUS' => 'Ativado',
            'ESTADO' => $this->input->post('estado'),
            'RUA' => $this->input->post('rua'),
            'CEP' => $this->input->post('cep'),
            'BAIRRO' => $this->input->post('bairro'),
            'CIDADE' => $this->input->post('cidade'),
            'SENHA' => $this->input->post('senha'),
            'SEXO' => $this->input->post('sexo'),
            'CPF' => $this->input->post('cpf'),
            'RG' => $this->input->post('rg'),
            'FOTO' => $localImagem,
            'PESSOA_TIPO' => strtoupper($entidade)
        );





        switch (strtoupper($entidade)) {

            case 'ADMINISTRADOR':
                return $this->insertAdministrador($dados);


            case 'ALUNO':

                $dados['FK_CURSO_ID'] = $this->input->post('cursos');
                $dados['INFO_MATRICULA'] = $this->input->post('infoadd');
                $dados['STATUS_MATRICULA'] = 'CURSANDO';

                return $this->insertAluno($dados);


            case 'PROFESSOR':
                return $this->insertProfessor($dados);


            default:return NULL;
        }//switch
    }

//insereDados

    /**
     * Insere dados do Administrador no banco de dados
     * @return boolean
     */
    private function insertAdministrador(array $dados) {

        if ($this->administrador->insert($dados)) {

            if ($this->administrador->insertEmail(array('EMAIL' => $this->input->post('email'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->administrador->lastID()))) {


                if ($this->administrador->insertTelefone(array('NUMERO' => $this->input->post('telefone'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->administrador->lastID()))) {
                    log_message('debug', 'Tabela PESSOA,EMAIL e TELEFONE inseridas com sucesso no cadastro do administrador inserido com sucesso');
                    return TRUE;
                }//if
                else {
                    log_message('error', 'Erro ao inserir TELEFONE do Administrador no banco de dados');
                    return FALSE;
                }//else
            }//if
            else {
                log_message('error', 'Erro ao inserir EMAIL do Administrador no banco de dados');
                return FALSE;
            }//else
        }//if
        else {
            log_message('error', 'Erro ao inserir Administrador no banco de dados');
            return FALSE;
        }//else
    }

//insertAdministrador

    /**
     * Insere dados do Professor no banco de dados
     * @return boolean
     */
    private function insertProfessor(array $dados) {

        if ($this->professor->insert($dados)) {

            if ($this->professor->insertEmail(array('EMAIL' => $this->input->post('email'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->professor->lastID()))) {


                if ($this->professor->insertTelefone(array('NUMERO' => $this->input->post('telefone'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->professor->lastID()))) {
                    log_message('debug', 'Tabela PESSOA,EMAIL e TELEFONE inseridas com sucesso no cadastro do professor inserido com sucesso');
                    return TRUE;
                }//if
                else {
                    log_message('error', 'Erro ao inserir TELEFONE do Professor no banco de dados');
                    return FALSE;
                }//else
            }//if
            else {
                log_message('error', 'Erro ao inserir EMAIL do Professor no banco de dados');
                return FALSE;
            }//else
        }//if
        else {
            log_message('error', 'Erro ao inserir Professor no banco de dados');
            return FALSE;
        }//else
    }

//insertProfessor

    /**
     * Insere dados do Aluno no banco de dados
     * @return boolean
     */
    private function insertAluno(array $dados) {

        if ($this->aluno->insert($dados)) {

            if ($this->aluno->insertEmail(array('EMAIL' => $this->input->post('email'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->aluno->lastID()))) {


                if ($this->aluno->insertTelefone(array('NUMERO' => $this->input->post('telefone'), 'TIPO' => 'Contato', 'FK_PESSOA_ID' => $this->aluno->lastID()))) {
                    log_message('debug', 'Tabela PESSOA,EMAIL e TELEFONE inseridas com sucesso no cadastro do aluno inserido com sucesso');
                    return TRUE;
                }//if
                else {
                    log_message('error', 'Erro ao inserir TELEFONE do Aluno no banco de dados');
                    return FALSE;
                }//else
            }//if
            else {
                log_message('error', 'Erro ao inserir EMAIL do Aluno no banco de dados');
                return FALSE;
            }//else
        }//if
        else {
            log_message('error', 'Erro ao inserir Aluno no banco de dados');
            return FALSE;
        }//else
    }

//insertAluno

    /**
     * Faz o upload da imagem 
     * @return type Local da imagem em case de sucesso, NULL em caso de falha
     */
    private function insertImage() {

        //Configuração do upload da imagem
        $config['file_name'] = uniqid() . '-' . time();
        $config['upload_path'] = './user_img/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1024;
        $config['max_width'] = 160;
        $config['max_height'] = 160;
        $this->load->library('upload', $config);



        if ($this->upload->do_upload('imagem')) {

            return base_url('/user_img/' . $this->upload->data()['file_name']);
        }//if 
        else {

            //Imagem nao inserida
            if (strcmp($this->upload->display_errors(), '<p>Você não selecionou o arquivo para fazer upload.</p>') != 0) {

                showError('mensagem_usuario', $this->upload->display_errors(), 'danger');
                return NULL;
            }//if
            else {
                return base_url('/user_img/avatar.png');
            }//else
        }//else
    }

//insertImage
}

//class
