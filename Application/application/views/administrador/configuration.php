<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE | Configuration</title>

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
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/dist/css/skins/'.$this->session->userdata('main_theme').'.min.css'); ?>   ">

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
                        Configurações
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
                                    <h3 class="box-title"> Gerais </h3>
                                </div>

                                <!-- BODY -->
                                <form method="post" action="<?php echo base_url('/manage/configuration/theme'); ?>">

                                    <div class="box-body " style="height: 200px; ">
                                        <!--------------- THEME --------------->
                                        <div class="form-group has-feedback col-md-5">
                                            <select  required class="form-control" name="theme" >
                                                <option value="">Escolha o tema - Atual(<?php echo $this->session->userdata('main_theme'); ?>)</option>
                                                <option value="skin-blue">Blue</option>
                                                <option value="skin-black">Black</option>
                                                <option value="skin-purple">Purple</option>
                                                <option value="skin-green">Green</option>
                                                <option value="skin-red">Red</option>
                                                <option value="skin-yellow">Yellow</option>
                                                <option value="skin-blue-light">Blue-Light</option>
                                                <option value="skin-black-light">Black-Light</option>
                                                <option value="skin-purple-light">Purple-Light</option>
                                                <option value="skin-green-light">Green-Light</option>
                                                <option value="skin-red-light">Red-Light</option>
                                                <option value="skin-yellow-light">Yellow-Light</option>
                                            </select>
                                        </div>
                                        <!--------------- /. THEME --------------->
                                        <!-- /. col-md-left  -->
                                        <div class="col-md-2">
                                            <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-save"></i> Salvar </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>

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
<script src="<?php  echo base_url('data-views/dashboard/dist/js/adminlte.min.js'); ?>  "></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('data-views/dashboard/dist/js/demo.js'); ?>  "></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
</body>
</html>
