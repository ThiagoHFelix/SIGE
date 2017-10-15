<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SIGE | Matricula Turma</title>

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
            <div class="content-wrapper" style="height:650px">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="col-xs-12">
                        <!--------------------------- / HEADER / ------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row"  style="margin-bottom:-20px">

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/cadastro/matriculaAlunoTurma'); ?>">  <button class="btn btn-app "  >
                                        <span class="fa fa-info" aria-hidden="true"></span>
                                        Seleção de Alunos
                                    </button> </a>

                            </div>


                            <div class="col-md-8">

                                <div class="text-center login-logo">

                                    <div class=" box-header register-logo">
                                        <a> Matricula de Aluno </a>
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
                            <?php echo $this->session->flashdata('mensagem_MatriculaTurma'); ?>
                        </div>
                        <!--------------- /. AVISO --------------->
                    </div>
                    <!--style="height: 500px; " -->

                    <div class="col-md-12" >

                        <div class="box box-solid" >


                            <div class="box-header">

                            </div>

                            <div class="box-body" style="height:500px;overflow: auto">


                                <?php //Crio os espaços para a seleçao de turma de cada materia ?>
                                <?php if (isset($materiasCurso)): ?>
                                    <?php foreach ($materiasCurso as $materia): ?>
                                        <div class="box-header"><?php echo 'Matéria: ' . $materia['TITULO']; ?>&nbsp;&nbsp;&nbsp;<?php echo 'Status: ' . $materia['STATUS']; ?></div>

                                        

                                        <div style="height:200px; overflow: auto; background-color: lightyellow;">

                                            <?php
                                            //Busco todas as turmas desta materia
                                            $turmas = $this->turma->getWhere(array('FK_MATERIA_ID' => $materia['ID']));
                                            ?>
                                            <?php if ($turmas !== NULL): ?> 




                                                <?php
                                                //Busco todas as turmas de cada materia
                                                foreach ($turmas as $turma):
                                                    ?>
                                                    <div  class="col-md-12" >



                                                        <div class="col-md-4">

                                                            <?php echo $turma['TITULO']; ?>

                                                        </div>
                                                        <div class="col-md-4">

                                                            <?php echo $turma['STATUS']; ?>

                                                        </div>
                                                        <div class="col-md-4">

                                                            <?php echo $turma['DATAINICIAL']; ?>

                                                        </div>


                                                    </div>
                                                <?php endforeach;
                                                ?>
                                            <?php endif; ?> 





                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>


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


            })
        </script>

    </body>
</html>
