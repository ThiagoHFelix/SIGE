<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE - Perfil de Usuário</title>
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
                    <div class="col-xs-12">
                        <?php
                        //Variavel responsável por avisar usuário sobre o sucesso do cadastro
                        echo $this->session->flashdata('mensagem_userprofile');
                        ?>
                        <!--------------------------- / HEADER / ------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row"  style="margin-bottom:-20px">
                            <div class="col-md-2">
                            <?php if (strcmp(strtoupper($this->session->userdata('entidade')), 'ADMINISTRADOR') === 0): ?>
                                

                                    <a href="<?php echo base_url('/manage/' . ucfirst($this->uri->segment(2))); ?>">  <button class="btn btn-app "  >
                                            <span class="fa fa-users" aria-hidden="true"></span>
                                            Gerenciar <?php echo ucfirst($this->uri->segment(2)); ?>
                                        </button> </a>

                              
                            <?php endif; ?>
                                  </div>


                            <div class="col-md-8">

                                <div class="text-center login-logo">

                                    <div class=" box-header register-logo">
                                        <a> Perfil do Usuario</a>
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





                    <div class="row">



                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-solid">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $FOTO; ?>" alt="User profile picture">

                                    <h3 class="profile-username text-center"> <?php echo $PRIMEIRONOME . ' ' . $SOBRENOME; ?></h3>

                                    <p class="text-muted text-center"> <?php echo $entidade; ?> </p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>CPF</b> <a class="pull-right"><?php echo $CPF; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>RG</b> <a class="pull-right"><?php echo $RG; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Sexo</b> <a class="pull-right"><?php
                                                echo $SEXO;
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
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Sobre</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> Cursos </strong>

                                    <p class="text-muted">

                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Matérias </strong>

                                    <p class="text-muted"> </p>

                                    <hr>

                                    <strong><i class="fa fa-pencil margin-r-5"></i> Matérias Finalizadas </strong>

                                    <p>

                                        <span class="label label-success"></span>
                                        <span class="label label-success"></span>

                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Dados Adicionais </strong>

                                    <p></p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->


                        </div>


                        <div class="col-md-9 ">


                            <div class=" box box-solid " style=" height: 790px;">



                                <!------- TITULO ------>
                                <div class="col-md-12">

                                    <div class="box-header register-logo">

                                    </div>
                                    <!-------/ TITULO ------>
                                </div>




                                <!-------/ COL-MD-12 ------>

                                <!------- ESQUERDA ------>
                                <div class="col-md-5" >

                                    <div class="register-logo" style="font-size:20pt; ">
                                        Endereço
                                    </div>


                                    <div id="dados" style=" margin-left:25px;  font-size:12pt;" >

                                        <p> <?php echo '- ESTADO: ' . $ESTADO; ?> </p>
                                        <p> <?php echo '- CIDADE: ' . $CIDADE; ?> </p>
                                        <p> <?php echo '- BAIRRO: ' . $BAIRRO; ?> </p>
                                        <p> <?php echo '- CEP: ' . $CEP; ?> </p>
                                        <p> <?php echo '- RUA: ' . $RUA; ?> </p>


                                    </div>



                                </div>
                                <!-------/ ESQUERDA ------>

                                <!------- DIREITA ------>
                                <div class="col-md-6" >

                                    <div class="register-logo" style="font-size:20pt;">
                                        Dados Pessoais
                                    </div>

                                    <div id="dados" style=" margin-left:25px; font-size:12pt; " >

                                        <p> <?php echo '- CEF: ' . $CPF; ?> </p>
                                        <p> <?php echo '- RG: ' . $RG; ?> </p>
                                        <p> <?php echo '- TELEFONE: '; ?> </p>
                                        <p> <?php echo '- REGISTRO: ' . $ID; ?> </p>

                                    </div>


                                </div>
                                <!-------/ DIREITA ------>








                            </div>
                            <!-------/ BOX-PRIMARY ------>

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
