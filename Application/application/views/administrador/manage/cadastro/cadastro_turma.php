<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SIGE | Cadastro Turma</title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>  ">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/bower_components/font-awesome/css/font-awesome.min.css'); ?>  ">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/bower_components/Ionicons/css/ionicons.min.css'); ?>  ">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/dist/css/AdminLTE.min.css'); ?>   ">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/dist/css/skins/_all-skins.min.css'); ?>   ">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">




    </head>
    <body class="hold-transition <?php echo $this->session->userdata('main_theme'); ?> sidebar-mini">


        <!-- Site wrapper -->
        <div class="wrapper">


            <?php
            //Carrega header
            $this->load->view('administrador/header');
            ?>
            <!-- =============================================== -->
            <?php
            //Carrega Manu Lateral
            $this->load->view('administrador/lateralMenu');
            ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="height:900px">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="col-xs-12">
                        <!--------------------------- / HEADER / ------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row"  style="margin-bottom:-20px">

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/manage/turma'); ?>">  <button class="btn btn-app "  >
                                        <span class="fa fa-users" aria-hidden="true"></span>
                                        Gerenciar Turmas
                                    </button> </a>

                            </div>


                            <div class="col-md-8">

                                <div class="text-center login-logo">

                                    <div class=" box-header register-logo">
                                        <a> Cadastro de Turma</a>
                                    </div>


                                </div>



                            </div>


                            <div class="col-md-2 pull-right"  >



                            </div>


                        </div>

                        <!--------------------------------------------------------------------------------------------------------------------------------------------------------->
                    </div>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-md-12">

                        <!--------------- AVISO --------------->
                        <div class="form-group has-feedback text-center " >
                            <?php echo $this->session->flashdata('mensagem_usuarioTurma'); ?>
                        </div>
                        <!--------------- /. AVISO --------------->
                    </div>
                    <!--style="height: 500px; " -->

                    <div class="col-md-12" >

                        <div class="box box-solid" >
                            <div class="box-header text-center"> Todos os campos com o caracter (*) são obrigatórios </div>

                            <div class="box-body">
                                <?php echo form_open('cadastro/turma'); ?>


                                <div class="col-md-12">

                                    <!--------------- TITULO --------------->
                                    <div class="form-group has-feedback">
                                        <input  required name="titulo" type="text" class="form-control " value="<?php echo setValue('titulo'); ?>" placeholder="Titulo*">
                                        <span class="fa fa-users form-control-feedback"></span>
                                    </div>
                                    <!--------------- /. TITULO --------------->

                                </div>
                                <div class="col-md-6">
                                    
                                    
                                       <div class="col-md-6">

                                        <!--------------- TEMPO DE AULA --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="tempoaula" type="text" class="form-control " value="<?php echo setValue('tempoaula'); ?>" placeholder="Tempo de Aula*"
                                                    data-inputmask='"mask": "99:99:99"' data-mask>
                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. TEMPO DE AULA --------------->

                                    </div>
                                    <div class="col-md-6">

                                        <!--------------- DATA INICIO --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="datainicio" type="date" class="form-control" value="<?php echo setValue('datainicio'); ?>" placeholder="Data de Inicio">
                                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. NASCIMENTO --------------->


                                    </div>

                                   


                                    <div class="col-md-6">  
                                        <!--------------- QUANTIDADE DE AULAS --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="quantaula" type="number" class="form-control " maxlength="3" value="<?php echo setValue('quantaula'); ?>" placeholder="Quantidade de Aulas*">
                                            <span class="fa fa-info form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. QUANTIDADE DE AULAS  --------------->
                                    </div>
                                    <div class="col-md-6">

                                        <!--------------- SALA  --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="sala" type="text" class="form-control " maxlength="12" value="<?php echo setValue('sala'); ?>" placeholder="Sala">
                                            <span class="fa fa-info form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. SALA --------------->


                                    </div>



                                    <div class="col-md-6">  
                                        <!--------------- MAX ALUNOS --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="maxalunos" type="number" class="form-control " maxlength="2" value="<?php echo setValue('maxalunos'); ?>" placeholder="Maximo de Alunos*">
                                            <span class="fa fa-users form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. MAX ALUNOS --------------->
                                    </div>

                                    <div class="col-md-6">
                                        <!--------------- MIN ALUNOS --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="minalunos" type="number" class="form-control " maxlength="2" value="<?php echo setValue('minalunos'); ?>" placeholder="Minimo de Alunos*">
                                            <span class="fa fa-users form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. MIN ALUNOS --------------->
                                    </div>







                                </div>
                                <div class="col-md-6">
                                    
                                     <!--------------- MATERIAS --------------->
                                    <div class="form-group has-feedback">
                                        <select  required class="form-control" name="materias" >
                                            <option value="" >Matérias*</option> 

                                            <?php if (isset($materias)): ?> 
                                                <?php foreach ($materias as $materia): ?>

                                                    <option 
                                                    <?php
                                                    if (strcmp($this->input->post('materias'), $materia['ID']) === 0): echo 'selected';
                                                    endif;
                                                    ?> 
                                                        value="<?php echo $materia['ID'] ?>"><?php echo $materia['TITULO']; ?></option>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </select>
                                    </div>
                                    <!--------------- /. MATERIAS --------------->

                                    <!--------------- PROFESSORES --------------->
                                    <div class="form-group has-feedback">
                                        <select  required class="form-control" name="professores" >
                                            <option value="">Professores*</option>

                                            <?php if (isset($professores)): ?> 
                                                <?php foreach ($professores as $professor): ?>

                                                    <option 
                                                    <?php
                                                    if (strcmp($this->input->post('professores'), $professor['ID']) === 0): echo 'selected';
                                                    endif;
                                                    ?> 
                                                        value="<?php echo $professor['ID'] ?>"><?php echo $professor['PRIMEIRONOME'] . ' ' . $professor['SOBRENOME']; ?></option>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </select>
                                    </div>
                                    <!--------------- /. PROFESSORES --------------->





                                    <!--------------- TURNO --------------->
                                    <div class="form-group has-feedback">
                                        <select  required class="form-control" name="turno" >
                                            <option value="">Turno*</option>

                                            <?php if (isset($turnos)): ?> 
                                                <?php foreach ($turnos as $turno): ?>

                                                    <option <?php
                                                    if (strcmp($this->input->post('turno'), $turno['ID']) === 0): echo 'selected';
                                                    endif;
                                                    ?> value="<?php echo $turno['ID'] ?>"><?php echo $turno['TITULO']; ?></option>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </select>
                                    </div>
                                    <!--------------- /. TURNO --------------->


                                 



                                </div>

                                <div class="row">
                                    <div class="col-md-12">


                                        <div class="" style="overflow-x: auto; height:200px; background-color: lightyellow">
                                            <!------------------------------------------------------------------ SEGUNDA ------------------------------------------------------>
                                            <div id="dia-semana"  >                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input"

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Segunda-Feira') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>   

                                                               value="Segunda-Feira" name="diasemana[]" >
                                                        Segunda-Feira
                                                    </label>

                                                </div>

                                                <div class="col-md-6 pull-rigth">

                                                    <div class="col-md-6">
                                                        <!--------------- HORA INICIO - SEGUNDA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horasegunda" type="text" class="form-control " value="<?php echo setValue('horasegunda'); ?>" placeholder="Inicio da Aula Segunda"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - SEGUNDA --------------->

                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - SEGUNDA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="quantaula_segunda" type="number" class="form-control " value="<?php echo setValue('quantaula_segunda'); ?>" placeholder="Quantidade Aula"
                                                                     >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - SEGUNDA --------------->

                                                    </div>

                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ SEGUNDA ------------------------------------------------------>
                                            <!------------------------------------------------------------------ TERÇA ------------------------------------------------------>
                                            <div id="dia-semana"  >                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input" 

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Terça-Feira') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>       

                                                               value="Terca-Feira" name="diasemana[]" >
                                                        Terça-Feira
                                                    </label>

                                                </div>

                                                <div class="col-md-6 pull-rigth">
                                                    <div class="col-md-6"> 
                                                        <!--------------- HORA INICIO - TERÇA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horaterca" type="text" class="form-control " value="<?php echo setValue('horaterca'); ?>" placeholder="Inicio da Aula Terça"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - TERÇA --------------->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - TERÇA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="quantaula_terca" type="number" class="form-control " value="<?php echo setValue('quantaula_terca'); ?>" placeholder="Quantidade Aula"
                                                                     >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - TERÇA --------------->

                                                    </div>

                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ TERÇA ------------------------------------------------------>
                                            <!------------------------------------------------------------------ QUARTA ------------------------------------------------------>
                                            <div id="dia-semana"  >                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input" 

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Quarta-Feira') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>   

                                                               value="Quarta-Feira" name="diasemana[]" >
                                                        Quarta-Feira
                                                    </label>

                                                </div>

                                                <div class="col-md-6 pull-rigth">
                                                    <div class="col-md-6">
                                                        <!--------------- HORA INICIO - QUARTA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horaquarta" type="text" class="form-control " value="<?php echo setValue('horaquarta'); ?>" placeholder="Inicio da Aula Quarta"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - QUARTA --------------->


                                                    </div>

                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - QUARTA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="quantaula_quarta" type="number" class="form-control " value="<?php echo setValue('quantaula_quarta'); ?>" placeholder="Quantidade Aula"
                                                                     >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - QUARTA --------------->

                                                    </div>

                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ QUARTA ------------------------------------------------------>
                                            <!------------------------------------------------------------------ QUINTA ------------------------------------------------------>
                                            <div id="dia-semana">                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input" 

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Quinta-Feira') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>   

                                                               value="Quinta-Feira" name="diasemana[]" >
                                                        Quinta-Feira
                                                    </label>

                                                </div>

                                                <div class="col-md-6 pull-rigth">
                                                    <div class="col-md-6"> 
                                                        <!--------------- HORA INICIO - QUINTA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horaquinta" type="text" class="form-control " value="<?php echo setValue('horaquinta'); ?>" placeholder="Inicio da Aula Quinta"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - QUINTA --------------->


                                                    </div>

                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - QUINTA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="quantaula_quinta" type="number" class="form-control " value="<?php echo setValue('quantaula_quinta'); ?>" placeholder="Quantidade Aula"
                                                                     >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - QUINTA --------------->

                                                    </div>


                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ QUINTA ------------------------------------------------------>
                                            <!------------------------------------------------------------------ SEXTA ------------------------------------------------------>
                                            <div id="dia-semana" >                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input" 

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Sexta-Feira') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>   

                                                               value="Sexta-Feira" name="diasemana[]" >
                                                        Sexta-Feira
                                                    </label>

                                                </div>
                                                <div  class="col-md-6">
                                                    <div class="col-md-6">
                                                        <!--------------- HORA INICIO - SEXTA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horasexta" type="text" class="form-control " value="<?php echo setValue('horasexta'); ?>" placeholder="Inicio da Aula Sexta"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - SEXTA --------------->


                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - SEXTA --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="quantaula_sexta" type="number" class="form-control " value="<?php echo setValue('quantaula_sexta'); ?>" placeholder="Quantidade Aula"
                                                                     >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - SEXTA --------------->

                                                    </div>




                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ QUINTA ------------------------------------------------------>
                                            <!------------------------------------------------------------------ SABADO ------------------------------------------------------>
                                            <div id="dia-semana" >                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input"

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Sabado') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>   

                                                               value="Sabado" name="diasemana[]" >
                                                        Sábado
                                                    </label>

                                                </div>

                                                <div class="col-md-6 pull-rigth">
                                                    <div class="col-md-6">  
                                                        <!--------------- HORA INICIO - SABADO --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horasabado" type="text" class="form-control " value="<?php echo setValue('horasabado'); ?>" placeholder="Inicio da Aula Sábado"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - SABADO --------------->


                                                    </div>

                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - SABADO --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="quantaula_sabado" type="number" class="form-control " value="<?php echo setValue('quantaula_sabado'); ?>" placeholder="Quantidade Aula"
                                                                     >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - SABADO --------------->

                                                    </div>

                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ SABADO ------------------------------------------------------>
                                            <!------------------------------------------------------------------ DOMINGO ------------------------------------------------------>
                                            <div id="dia-semana" >                 
                                                <div class="col-md-6 pull-left">

                                                    <label class="form-check-label" style="padding:0px 15px">
                                                        <input type="checkbox" class="form-checkbox-input" 

                                                               <?php if ($this->input->post('diasemana') !== NULL): ?>
                                                                   <?php foreach ($this->input->post('diasemana') as $dia): ?>
                                                                       <?php
                                                                       if (strcmp($dia, 'Domingo') === 0): echo 'checked';
                                                                       endif;
                                                                       ?> 
                                                                   <?php endforeach; ?>       
                                                               <?php endif; ?>   

                                                               value="Domingo" name="diasemana[]" >
                                                        Domingo
                                                    </label>

                                                </div>

                                                <div class="col-md-6 pull-rigth">
                                                    <div class="col-md-6">
                                                        <!--------------- HORA INICIO - DOMINGO --------------->
                                                        <div class="form-group has-feedback">
                                                            <input   name="horadomingo" type="text" class="form-control " value="<?php echo setValue('horadomingo'); ?>" placeholder="Inicio da Aula Domingo"
                                                                     data-inputmask='"mask": "99:99:99"' data-mask>
                                                            <span class="fa fa-clock-o form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. HORA INICIO - DOMINGO --------------->


                                                    </div>

                                                    <div class="col-md-6">
                                                        <!--------------- QUANTIDADE AULA - DOMINGO --------------->
                                                        <div class="form-group has-feedback">
                                                            <input  name="quantaula_domingo" type="number" class="form-control " value="<?php echo setValue('quantaula_domingo'); ?>" placeholder="Quantidade Aula"
                                                                    >
                                                            <span class="fa fa-exclamation-circle form-control-feedback"></span>
                                                        </div>
                                                        <!--------------- /. QUANTIDADE AULA - DOMINGO --------------->

                                                    </div>

                                                </div>
                                            </div>
                                            <!------------------------------------------------------------------./ DOMINGO ------------------------------------------------------>

                                        </div>



                                    </div>
                                </div>

                                <br/>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group has-feedback">

                                            <textarea required maxlength="250" class="form-control" minlength="255" rows="6" name="infoadd" placeholder="infoadd*"><?php echo setValue('infoadd'); ?></textarea>
                                            <span class="fa fa-book form-control-feedback"></span>

                                        </div> 

                                    </div>
                                </div>



                                <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-pencil"></i> Cadastrar </button>
                                </form>
                            </div>

                        </div>
                    </div>





            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- =============================================== -->
    <?php
//Carrega footer
    $this->load->view('administrador/footer');
    ?>

</div>


<div class="control-sidebar-bg"></div>

<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="<?php echo base_url('data-views/dashboard/bower_components/jquery/dist/jquery.min.js'); ?>  "></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('data-views/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>     "></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('data-views/dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>     "></script>
<!-- FastClick -->
<script src="<?php echo base_url('data-views/dashboard/bower_components/fastclick/lib/fastclick.js'); ?>  "></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('data-views/dashboard/dist/js/adminlte.min.js'); ?>  "></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('data-views/dashboard/dist/js/demo.js'); ?>  "></script>

<!-- CK EDITOR-->
 <!--  <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
<script src="<?php echo base_url('data-views/biblioteca/ckeditor-basic/ckeditor.js'); ?>  "></script>

<!-- Select2 -->
<script src="<?php echo base_url('data-views/dashboard/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>

<!-- InputMask -->
<script src="<?php echo base_url('data-views/dashboard/plugins/input-mask/jquery.inputmask.js'); ?> "></script>
<script src="<?php echo base_url('data-views/dashboard/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?php echo base_url('data-views/dashboard/plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Money Euro
        $('[data-mask]').inputmask()


    });



</script>

<script>
    CKEDITOR.replace('infoadd');
</script>


</body>
</html>
