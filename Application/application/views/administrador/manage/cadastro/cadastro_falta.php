<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SIGE | Cadastro de Frequência</title>

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
            <div class="content-wrapper"style="height:980px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="col-xs-12">
                        <!--------------------------- / HEADER / ------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row"  style="margin-bottom:-20px">

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/manage/faltas/' . $this->uri->segment(3)); ?>">  <button class="btn btn-app "  >
                                        <span class="fa fa-book" aria-hidden="true"></span>
                                        Gerenciar Frequência
                                    </button> </a>

                            </div>


                            <div class="col-md-8">

                                <div class="text-center login-logo">

                                    <div class=" box-header register-logo">
                                        <a> Inserção de Frequência </a>
                                    </div>


                                </div>



                            </div>


                            <div class="col-md-2 pull-right"  >



                            </div>


                        </div>
                        <!--------------------------------------------------------------------------------------------------------------------------------------------------------->

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-md-12">

                        <!--------------- AVISO --------------->
                        <div class="form-group has-feedback text-center " >
                            <?php echo $this->session->flashdata('mensagem_nota'); ?>
                        </div>
                        <!--------------- /. AVISO --------------->
                    </div>

                    <div class="col-md-12" >

                        <div class="box box-solid" >
                            <div class="box-header text-center">


                                <p> <strong>Turma:</strong><?php
                                    if (isset($TURMA)): echo $TURMA[0]['TITULO'] . ' | ';
                                    endif;
                                    ?>  <strong>Matéria:</strong> <?php
                                    if (isset($MATERIA)): echo $MATERIA[0]['TITULO'];
                                    endif;
                                    ?> </p>


                                <p>Todos os campos com o caracter (*) são obrigatórios </p> </div>


                            <?php echo form_open('cadastro/falta/' . $this->uri->segment(3)); ?>

                            <div class="col-md-12"> 

                                <!--------------- ALUNO --------------->
                                <div class="form-group has-feedback">
                                    <select  required class="form-control" name="aluno" >
                                        <option value="">Aluno*</option>
                                        <?php //XXX Carrego alunos na combobox  ?>
                                        <?php foreach ($alunos as $aluno): ?>

                                            <option <?php
                                            if (strcmp($this->input->post('aluno'), $aluno['ID']) === 0): echo 'selected';
                                            endif;
                                            ?> value="<?php echo $aluno['ID'] ?>"><?php echo $aluno['PRIMEIRONOME'] . ' ' . $aluno['SOBRENOME']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!--------------- /. ALUNO --------------->

                            </div>
                            <div class="box-body">
                                <div class="col-md-6">


                                      <!--------------- Frequência --------------->
                                <div class="form-group has-feedback">
                                    <select  required class="form-control" name="frequencia" >
                                        <option value="">Frequência*</option>
                                        <option value="1">Presente</option>
                                        <option value="0">Ausente</option>
                                        
                                    </select>
                                </div>
                                <!--------------- /. Frequência --------------->


                                </div>

                                <div class="col-md-6">

                                   
                                     <!--------------- AULA DO DIA --------------->
                                <div class="form-group has-feedback">
                                    <select  required class="form-control" name="aula_dia" >
                                        <option value="">Aula do dia*</option>
                                        <option value="1">Primeira</option>
                                        <option value="2">Segunda</option>
                                        
                                    </select>
                                </div>
                                <!--------------- /. AULA DO DIA --------------->


                                </div>

                                <div class="col-md-12">
                                    
                                     <!--------------- INFORMAÇOES--------------->
                                    <div class="form-group has-feedback text-center" style=" font-size: 13pt; padding: 5px 5px;">
                                        <span class="fa fa-info-circle form-control-feedback"></span>
                                        <?php  echo 'Data de registro: '.date('d/m/y').' - Dia semana: '.date('l');?>
                                   </div>
                                    <!--------------- /. INFORMAÇOES --------------->
                                    
                                    Informações adicionais:
                                    <div class="form-group has-feedback">

                                        <textarea  maxlength="250" class="form-control"  rows="6" name="complemento" placeholder="complemento*"><?php echo setValue('complemento'); ?></textarea>
                                        <span class="fa fa-book form-control-feedback"></span>

                                    </div> 
                                    <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-pencil"></i> Cadastrar </button>

                                </div>




                            </div>


                            </form>


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

            CKEDITOR.replace('complemento');
        </script>

    </body>
</html>
