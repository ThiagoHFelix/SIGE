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


                <!-- Main content -->
                <section class="content">


                    <div class="row">


                        <div  class="col-md-12" >


                            <div class="row">



                            </div>

                            <div class="row">


                                <div class="col-md-3">

                                    <div class="box box-solid" >
                                        <div class="box-body no-padding">
                                            <table id="layout-skins-list" class="table table-striped bring-up nth-2-center">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 210px;">Skin Class</th>
                                                        <th>Preview</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><code>skin-blue</code></td>
                                                        <td><a href="#" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-blue-light</code></td>
                                                        <td><a href="#" data-skin="skin-blue-light" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-yellow</code></td>
                                                        <td><a href="#" data-skin="skin-yellow" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-yellow-light</code></td>
                                                        <td><a href="#" data-skin="skin-yellow-light" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-green</code></td>
                                                        <td><a href="#" data-skin="skin-green" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-green-light</code></td>
                                                        <td><a href="#" data-skin="skin-green-light" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-purple</code></td>
                                                        <td><a href="#" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-purple-light</code></td>
                                                        <td><a href="#" data-skin="skin-purple-light" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-red</code></td>
                                                        <td><a href="#" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-red-light</code></td>
                                                        <td><a href="#" data-skin="skin-red-light" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-black</code></td>
                                                        <td><a href="#" data-skin="skin-black" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>skin-black-light</code></td>
                                                        <td><a href="#" data-skin="skin-black-light" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                </div>


                                <div class="col-md-6">

                                    <a href="<?php echo base_url('/manage/log'); ?>">  <button class="btn btn-default" style="width:100%">
                                            <span class="fa fa-gear" aria-hidden="true"></span>
                                            Log
                                        </button> </a>

                                    <?php if (strcmp(strtoupper($this->session->userdata('entidade')), 'ADMINISTRADOR') === 0): ?>
                                        <div class="box box-solid " style="margin-top:10px; padding:20px 10px ">

                                            <div class="box-header text-center " style="font-size:16pt">
                                                <small>    Banco de dados </small>
                                            </div>
                                            <div class="box-body no-padding">


                                                <div class="col-md-6">

                                                    <p>  <strong>  Versão: </strong>  <?php echo $this->db->version(); ?> </p>
                                                    <p>  <strong>  Plataforma: </strong>  <?php echo $this->db->platform(); ?> </p>
                                                    <p>  <strong>  Atual Banco: </strong>  <?php echo $this->session->userdata('database'); ?> </p>
                                                    <p>  <strong>  Last Query: </strong>  <?php echo $last_query; ?> </p>
                                                </div>




                                                <div class="col-md-6">

                                                    <form method="POST" action="<?php echo base_url('/manage/configuration'); ?>" >
                                                        <!--------------- BANCO ------------------>
                                                        <div class="form-group  has-feedback">
                                                            <select required name="banco" class="form-control" >
                                                                <option value=""> Selecione o banco </option>
                                                                <option value="test_linux"> Desenvolvimento 1 (test) </option>
                                                                <option value="test_linux2"> Desenvolvimento 2 (test2)</option>
                                                            </select>
                                                        </div>
                                                        <!--------------- /. BANCO --------------->


                                                        <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-save "></i> Salvar </button>
                                                    </form>

                                                </div>




                                            </div>


                                        </div>
                                    <?php endif; ?>





                                </div>


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
