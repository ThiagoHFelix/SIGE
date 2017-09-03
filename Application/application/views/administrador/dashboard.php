<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE | Home</title>

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
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Inicio </a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                    <div class="row">


                        <div  class="col-md-12" >


                            <div class="box box-primary " style="height: 200px;" >

                                <!-- HEADER -->
                                <div class="box-header with-border" >
                                    <h3 class="box-title"> Links Rápidos </h3>

                                </div>

                                <!-- BODY -->

                                <div class="box-body" style="height: 200px; ">


                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-users" aria-hidden="true"></span>
                                            Alunos
                                        </button> </a>

                                    <a href="<?php echo base_url('/manage/professor'); ?>">  <button class="btn btn-app" >
                                            <span class="fa fa-users" aria-hidden="true"></span>
                                            Professores
                                        </button> </a>

                                    <a href="<?php echo base_url('/manage/administrador'); ?>">  <button class="btn btn-app" >
                                            <span class="fa fa-users" aria-hidden="true"></span>
                                            Administradores
                                        </button> </a>

                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-graduation-cap" aria-hidden="true"></span>
                                            Cursos
                                        </button> </a>

                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-book" aria-hidden="true"></span>
                                            Matérias
                                        </button> </a>

                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-users" aria-hidden="true"></span>
                                            Turmas
                                        </button> </a>

                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                            Registrar Nota
                                        </button> </a>

                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-comments" aria-hidden="true"></span>
                                            Chat
                                        </button> </a>

                                    <a href="#">  <button class="btn btn-app" >
                                            <span class="fa fa-area-chart" aria-hidden="true"></span>
                                            Relatórios
                                        </button> </a>

                                    <a href="<?php echo base_url('manage/configuration'); ?>">  <button class="btn btn-app" >
                                            <span class="fa fa-gears" aria-hidden="true"></span>
                                            Configurações
                                        </button> </a>

                                </div>

                                <!-- /.box-body -->



                            </div>


                        </div>

                    </div>

                    <!----------------- SEGUNDA LINHA -------------------------------------->

                    <div class="row" >

                        <!-- BOX LEFT -->
                        <div class="col-md-8">

                            <div class="box box-primary" style="height: 235px;">
                                <!------------------ INICIO BOX ------------------->
                                <div class="box-header with-border">
                                    <h3 class="box-title">Quadro de Avisos</h3>
                                </div>

                                <div class="box-body ">
                                    <!------------------ INICIO BODY---------------->



                                    <!------------------ FIM BODY------------------->
                                </div>

                                <div class="box-footer with-border">



                                </div>

                                <!------------------ FIM BOX ------------------->
                            </div>

                        </div>


                        <!-- BOX RIGHT -->
                        <div class="col-md-4" >
                            <!------------------ MENSAGENS BOX ------------------->
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Novas Mensagens</span>
                                    <span class="info-box-number">2</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!------------------ /. MENSAGENS BOX ------------------->

                            <!------------------  ALUNOS MATRICULADOS ------------------->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>25</h3>

                                    <p>Alunos Matriculados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!------------------ /. ALUNOS MATRICULADOS ------------------->


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
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })
        </script>
    </body>
</html>
