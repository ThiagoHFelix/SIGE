<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE | Turma</title>
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

        <style>

            .p{

                margin-left:20px;
                padding: 5px 5px;
                border: 1px solid lightgray;
                background-color: whitesmoke;
                text-align: center;
                margin: 5px;    
                border-radius: 5px;
                
            }
            
         
            

        </style>


    </head>
    <body class="hold-transition skin-blue sidebar-mini">
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

                <section class="content" >

                    <div class="col-xs-12" >

                        <div class="col-md-2">
                            <?php if (strcmp(strtoupper($this->session->userdata('entidade')), 'ADMINISTRADOR') === 0): ?>

                                <a href="<?php echo base_url('/manage/turma'); ?>">  <button class="btn btn-app"  >
                                        <span class="fa fa-users" aria-hidden="true"></span>
                                        Gerenciar Turmas
                                    </button> </a>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-8">

                            <div class="login-logo">
                                <?php echo'Turma: ' . $TITULO; ?>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-12">


                                <div class="box box-solid" >

                                    <ul class="nav nav-tabs ">
                                        <li class="active"><a data-toggle="tab" href="#home">Informaçoes da Turma</a></li>
                                        <li><a data-toggle="tab" href="#menu1">Alunos</a></li>

                                    </ul>

                                    <div class="tab-content box box-solid">
                                        <div id="home" class="tab-pane fade in active content">

                                            <div class="col-md-3 p">
                                                <p >
                                                    <strong>TITULO: </strong> 
                                                    <?php
                                                    if (strcmp($TITULO, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $TITULO);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            <div class="col-md-3 p">
                                                <p>
                                                    <strong>DATA INICIAL : </strong> 
                                                    <?php
                                                    if (strcmp($DATAINICIAL, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $DATAINICIAL);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            <div class="col-md-3 p ">
                                                <p style="margin-left:20px">
                                                    <strong>STATUS : </strong> 
                                                    <?php
                                                    if (strcmp($STATUS, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $STATUS);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            <div class="col-md-3 p ">
                                                <p>
                                                    <strong>SALA : </strong> 
                                                    <?php
                                                    if (strcmp($SALA, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $SALA);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            <div class="col-md-3 p ">

                                                <p >
                                                    <strong>TEMPO AULA : </strong> 
                                                    <?php
                                                    if (strcmp($TEMPOAULA, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $TEMPOAULA);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            <div class="col-md-3 p ">

                                                <p>
                                                    <strong>QUANTIDADES DE DIA : </strong> 
                                                    <?php
                                                    if (strcmp($QUANTDIA, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $QUANTDIA);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            <div class="col-md-3 p ">
                                                <p>
                                                    <strong>QUANTIDADES DE DIA : </strong> 
                                                    <?php
                                                    if (strcmp($QUANTMAXALUNO, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $QUANTMAXALUNO);
                                                    }//else
                                                    ?></p>
                                            </div>
                                            
                                            <div class="col-md-3 p ">
                                                <p>
                                                    <strong>MATERIA : </strong> 
                                                    <?php
                                                    if (strcmp($MATERIA, '') == 0) {

                                                        echo 'Não informado';
                                                    }//if
                                                    else {

                                                        print(' ' . $MATERIA);
                                                    }//else
                                                    ?></p>
                                            </div>
                                        </div>

                                        <div id="menu1" class="tab-pane fade content" style=" height: 250px; overflow: auto">
                                            <h3>Lista de Alunos</h3>
                                            
                                           <?php foreach($ALUNOS as $aluno): ?>
                                            
                                            
                                             <div class="col-md-12 p "style="text-align:left">
                                                <p>
                                                    <strong> <?php echo $aluno['PRIMEIRONOME']; ?> </strong> 
                                                </p>
                                                
                                            </div>
                                            
                                            
                                           <?php endforeach; ?> 
                                            
                                        </div>

                                    </div>

                                </div>


                            </div>



                        </div>



                    </div>



                </section>




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
