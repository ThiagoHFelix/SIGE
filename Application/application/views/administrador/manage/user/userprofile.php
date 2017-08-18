<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Default Dashborad</title>
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    
                    <a href="<?php echo base_url('/manage/administrador'); ?>"> <button class="fa fa-arrow-circle-left btn btn-primary btn-sm"> <small>Voltar</small></button> </a> 
                    
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url($this->uri->segment(1) . '/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home </a></li>                      
                        <li><a href="<?php echo base_url($this->uri->segment(1) . '/manage/administrador'); ?>"><i class="fa fa-users"></i> Gerenciamento Administradores </a></li>                      
                        <li><a href="<?php echo base_url($this->uri->segment(1) . '/manage/administrador/userprofile/'.$this->uri->segment(5)); ?>"><i class="fa fa-users"></i> Perfil de usuário </a></li>                      
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">



                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php  echo $FOTO; ?>" alt="User profile picture">

                                    <h3 class="profile-username text-center"> <?php echo $PRIMEIRONOME.' '.$SOBRENOME; ?></h3>

                                    <p class="text-muted text-center"> <?php echo $entidade; ?> </p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>E-mail</b> <a class="pull-right"><?php  echo $EMAIL; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Telefone</b> <a class="pull-right"><?php  echo $TELEFONE; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Sexo</b> <a class="pull-right"><?php 
                                            
                                           /* if($sexo == 1):
                                                echo 'Masculino';
                                            else:
                                                echo 'Feminino';
                                            endif;
                                            
                                            */
                                            ?></a>
                                        </li>
                                    </ul>
                                    
                                    <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a>
                                    <a href="#" class="btn btn-danger btn-block"><b>Excluir</b></a>
                                    
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->


                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Sobre</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> Cursos </strong>

                                    <p class="text-muted">
                                       Todos os cursos cadastrados 
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Matérias </strong>

                                    <p class="text-muted"> Todas as matérias cadastradas </p>

                                    <hr>

                                    <strong><i class="fa fa-pencil margin-r-5"></i> Matérias Finalizadas </strong>

                                    <p>
                                       
                                        <span class="label label-success">Português</span>
                                        <span class="label label-success">Matemática</span>
                                        
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Quem sou eu </strong>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->


                        </div>


                        <div class="col-md-9 ">


                            <div class=" box box-primary " style=" height: 790px;"> </div>

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
