<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visualizar extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('url', 'funcoes'));
           //XXX Bibliotecas
        $this->load->library('session');
        isSessionStarted();
    }//construtor


    
    public function administrador(string $cpf) {

        $this->load->model('Administrador_model', 'administrador');
        $resultado = $this->administrador->getAdministrador($cpf);
        if ($resultado === NULL):
            show_404();
            return 0;
        endif;
        $dados = $resultado;
        $dados['entidade'] = 'Administrador';

        $this->load->view('administrador/manage/visualizar/userprofile', $dados);
    }//administrador



    public function professor(string $cpf) {

        $this->load->model('Professor_model', 'professor');
        $resultado = $this->professor->getProfessor($cpf);

        if ($resultado === NULL):
            show_404();
            return 0;
        endif;

        $dados = $resultado;
        $dados['entidade'] = 'Professor';

        $this->load->view('administrador/manage/visualizar/userprofile', $dados);
    }//professor



    public function aluno(string $cpf) {

        $this->load->model('Aluno_model', 'aluno');
        $resultado = $this->aluno->getAluno($cpf);
        if ($resultado === NULL):
            show_404();
            return 0;
        endif;
        $dados = $resultado;
        $dados['entidade'] = 'Aluno';

        $this->load->view('administrador/manage/visualizar/userprofile', $dados);
    }//aluno



    public function aviso(int $id) {


        $this->load->model('Aviso_model', 'aviso');

        if ($this->exists('AVISO', $id)):


            $this->load->view('/administrador/manage/visualizar/info_aviso', $this->aviso->getAviso((int) $id));
        else:
            show_404();
        endif;
    }//aviso 



    private function exists(string $entidade, $id) {


        switch (strtoupper($entidade)) {


            case 'ADMINISTRADOR':
                $return = $this->administrador->getAdministrador($id);
                break;

            case 'ALUNO':
                $return = $this->aluno->getAluno($id);
                break;

            case 'PROFESSOR':
                $return = $this->professor->getProfessor($id);
                break;

            case 'AVISO':
                $return = $this->aviso->getAviso((int) $id);
                break;

            default:return FALSE;
        }//switch

        if ($return !== NULL) {
            return TRUE;
        }//IF

        return FALSE;
    }//exists



    /**
     * Mostra todas as informaçoes de uma turma
     * @param int $id ID da turma a ser vizualizada
     */
    public function turma(int $id = 0) {

        if ($id === 0):
            show_404();
        endif;

        $this->load->model('turma_model', 'turma');
        
        $turma = $this->turma->getWhere(array('ID' => $id))[0];
        $resultado[0]['materias'] = '';
      //  die(var_dump($turma));

        if ($turma !== NULL) {
            
            $dados['TITULO'] = $turma['TITULO'];
            $dados['STATUS'] = $turma['STATUS'];
            $dados['DATAINICIAL'] = $turma['DATAINICIAL'];
            $dados['SALA'] = $turma['SALA'];
            $dados['TEMPOAULA'] = $turma['TEMPOAULA'];
            $dados['QUANTDIA'] = $turma['QUANTDIA'];
            $dados['QUANTDIA'] = $turma['QUANTDIA'];
            $dados['QUANTMAXALUNO'] = $turma['QUANTMAXALUNO'];
            $dados['QUANTMINALUNO'] = $turma['QUANTMINALUNO'];

            
            //Buscando alunos da turma
            $this->load->model('curso_model', 'curso');
            $alunos = $this->curso->query('SELECT * FROM PESSOA,MATRICULA_TURMA WHERE MATRICULA_TURMA.FK_TURMA_ID = '.$turma['ID'].' AND MATRICULA_TURMA.FK_PESSOA_ID = PESSOA.ID');
            $dados['ALUNOS'] = $alunos;
            
            //Buscar dados da materia da turma
            $this->load->model('materia_model', 'materia');
            $materia = $this->materia->getWhere(array('ID' => $turma['FK_MATERIA_ID']))[0];
           
            $dados['MATERIA'] = $materia['TITULO'];

           

            $this->load->view('administrador/manage/info/info_turma',$dados);
        }//if
        else {
            show_404();
        }//else
    }//turma



    /**
     * /Mostra as informações do Curso
     * @param int $id
     */
    public function curso(int $id) {


        $this->load->model('curso_model', 'curso');
        $this->load->model('materia_model', 'materia');
        $resultado = $this->curso->getWhere(array('ID' => $id));
        $resultado[0]['materias'] = '';



        if ($resultado) {
            //Buscar todas as materias do curso
            $return = $this->curso->getMaterias($id);

            if ($return) {
                foreach ($return as $materia) {
                    $return = $this->materia->getWhere(array('ID' => $materia['FK_MATERIA_ID']));
                    $resultado[0]['materias'] = $resultado[0]['materias'] . '<br/>' . $return[0]['TITULO'];
                }//foreach
            }//if
            
            //XXX Verifico qual entidade esta buscando a view
            if(strcmp(strtoupper($this->session->userdata('entidade')),'ADMINISTRADOR') === 0):
                $this->load->view('administrador/manage/info/info_curso', $resultado[0]);
            else:
                $this->load->view('aluno/manage/visualizar/info_curso', $resultado[0]);
            endif;
            
            
        }//if
        else {
            show_404();
        }//else
    }//curso
    
    /**
     * Mostra ao usuario todas as materias que ele esta matriculado no momento
     */
    public function minhas_turmas(){
       
        //XXX Bibliotecas
        $this->load->model('Aluno_model','aluno');
        $this->load->model('Curso_model','curso');
        $this->load->model('Turma_model','turma');
        $this->load->model('Materia_model','materia');
        
        //XXX Variaveis
        $user_id = $this->session->userdata('user_id');
        $aluno = $this->aluno->getAlunoById($user_id);
        $curso = NULL;
        $turma = NULL;
        $materias = NULL;
        
        //XXX Verifico se o aluno foi encontrado no banco de dados
        if ($aluno !== NULL):

            //XXX Busco curso no banco de dados
            $curso = $this->curso->query('SELECT * FROM CURSO WHERE CURSO.ID =' . $aluno['FK_CURSO_ID']);

            //XXX Verifico se o curso foi encontrado
            if ($curso != NULL):

                $dados['CURSO'] = $curso;
                $materias = $this->materia->query('SELECT * FROM MATERIA AS M ,CURSO_MATERIA AS CM WHERE CM.FK_CURSO_ID  = '.$curso[0]['ID'].' AND M.ID = CM.FK_MATERIA_ID');
               
            
                //XXX Verifico se as materias foram encontradas
                if ($materias != NULL):

                    $dados['MATERIAS'] = $materias;
                    $turmas = $this->turma->query(' SELECT * FROM MATRICULA_TURMA AS MT,TURMA AS T WHERE MT.FK_PESSOA_ID = '.$aluno['ID'].' AND MT.FK_TURMA_ID = T.ID');
                    $dados['TURMAS'] = $turmas;
                    
                else:
                    showError('message_minhas_turmas', 'As materias do aluno não foram encontradas no banco de dados', 'alert alert-info');
                endif;

            else:
                showError('message_minhas_turmas', 'O curso deste aluno não foi encontrado no banco de dados', 'alert alert-info');
            endif;

        else:
            showError('message_minhas_turmas', 'Este aluno não foi encontrado no banco de dados', 'alert alert-info');
        endif;

        $this->load->view('aluno/manage/visualizar/info_minhas_turmas',$dados);
        
    }//minhas_turmas


}//class


