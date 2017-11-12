<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE | Minhas Turmas</title>
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



        <style type="text/css">


            .materia{

                padding:30px 30px;
                border:1px solid lightgray;
                margin-bottom:5px;
                border-radius:5px;
                
                

            }
            
            .materia .titulo{
                font-size:18pt;
            }
            
            .materia:hover{
                
                box-shadow:0px 10px 50px lightgray;
                border:1px solid lightblue;
                
            }
            
            .turma{
                
                padding:10px 40px;
                border-left:1px solid lightgray;
            }


        </style>







    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">


            <?php
            //Carrega header
            $this->load->view('aluno/header');
            ?>
            <!-- =============================================== -->
            <?php
            //Carrega Manu Lateral
            $this->load->view('aluno/lateralMenu');
            ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <section class="content" style="height: 600px;">

                    <div class="col-xs-12" >

                        <?php
                        //Variavel responsável por avisar usuário sobre o sucesso do cadastro
                        echo $this->session->flashdata('message_minhas_turmas');
                        ?>

                        <div class="col-md-2">

                            <a href="<?php echo base_url('/'); ?>">  <button class="btn btn-app"  >
                                    <span class="fa fa-dashboard" aria-hidden="true"></span>
                                    Inicio
                                </button> </a>

                        </div>

                        <div class="col-md-8">

                            <div class="login-logo">

                                <?php if (isset($CURSO)): ?>

                                    <?php echo 'Curso: ' . $CURSO[0]['TITULO']; ?>

                                <?php else: ?>

                                    <p> Curso nao informado </p>

                                <?php endif; ?>


                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-12">


                                <div class="box box-solid" >

                                    <div class="box-header">

                                    </div>

                                    <div class="box-body" style="height: 450px; overflow: auto;">

                                        <?php if (isset($MATERIAS)): ?>
                                            <?php foreach ($MATERIAS as $MATERIA): ?>

                                                <div>

                                                    <div class="materia"><p class="titulo"><?php echo  $MATERIA['TITULO']; ?></p>

                                                        <?php if (isset($TURMAS)): ?>
                                                        <div style="font-size:12pt;">Turma:</div>
                                                            <?php foreach ($TURMAS as $TURMA): ?>
                                                                 <div class="turma">
                                                                <?php if ($TURMA['FK_MATERIA_ID'] === $MATERIA['ID']): ?>
                                                                    <?php echo $TURMA['TITULO']; ?> 
                                                                <?php endif; ?>
                                                                     </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        <?php endif; ?>

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
            $this->load->view('aluno/footer');
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
