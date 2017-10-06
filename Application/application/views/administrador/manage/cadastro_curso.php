<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SIGE | Cadastro Curso</title>

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

                    <a href="<?php echo base_url('/manage/materia'); ?>"> <button class="fa fa-arrow-circle-left btn btn-primary btn-sm"> <small>Voltar</small></button> </a>

                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('/dashboard'); ?>"><i class="fa fa-home"></i> Inicio </a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12" >

                            <div class="box box-solid" style="height: 800px; margin-left: auto; margin-right: auto;">
                                <div class=" box-header register-logo">
                                    <a> Cadastro de Curso </a>
                                </div>


                              <?php echo form_open('manage/cadastro/curso');  ?>



                                    <div class="row" >
                                        <div class="col-md-12" >

                                            <div style="margin-left: 16px; text-align:center; margin-right: 16px;" class="alert alert-info" > Todos os campos com o caracter (*) são obrigatórios </div>

                                        </div>

                                    </div>

                                    <div class="col-md-12" >

                                            <!--------------- TITULO --------------->
                                            <div class="form-group has-feedback">
                                                <input  required name="titulo" type="text" class="form-control " value="<?php echo setValue('titulo'); ?>" placeholder="Titulo da matéria*">
                                                <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
                                            </div>
                                            <!--------------- /. TITULO --------------->

                                    </div>

                                    <div class="col-md-6">



                                        <!--------------- Descrição Geral --------------->
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" rows="5" name="descricao" placeholder="Descrição Geral"><?php echo setValue('descricao'); ?></textarea>
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Descrição Geral --------------->



                                      <!--------------- Descrição de Duração --------------->
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" rows="5" name="duracao" placeholder="Descreva a duração do curso" ><?php echo setValue('duracao'); ?></textarea>
                                            <span class="fa fa-dot-circle-o form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Descrição de Duração --------------->


                                    </div>

                                    <div class="col-md-6">

                                          <!--------------- Descrição de Vagas --------------->
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" rows="5" name="vagas" placeholder="Descrição sobre as Vagas" ><?php echo setValue('vagas'); ?></textarea>
                                            <span class="glyphicon glyphicon-bookmark form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Descrição de Vagas --------------->

                                          <!--------------- Carga Horaria     --------------->
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" rows="5" name="carga_horaria" placeholder="Carga Horaria" ><?php echo setValue('carga_horaria'); ?></textarea>
                                            <span class="glyphicon glyphicon-book form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Carga Horaria  --------------->

</div>
<div class="col-md-12">
                                          <table id="list_materia" class="table table-bordered " >

                                            <thead >
                                              <tr>
                                              <td>
                                                Nome da Matéria
                                              </td>

                                              <td>
                                                Ações
                                              </td>

                                              </tr>
                                            </thead>

                                            <tbody>
                                              <?php foreach ($Mate as $materia): ?>

                                                <tr>
                                                  <td>
                                                    <?php echo $materia['TITULO']; ?>
                                                  </td>
                                                  <td>
                                                    <div class="form-check" >
                                                      <span class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="<?php echo $materia['ID']; ?>"  >
                                                        Adicionar
                                                        </span>
                                                  </td>
                                                </tr>

                                              <?php endforeach; ?>

                                            </tbody>



                                          </table>
</div>

<div class="col-md-6 pull-left">


  <!--------------- AVISO --------------->
  <div class="form-group has-feedback text-center" >
      <?php echo $this->session->flashdata('mensagem_usuario'); ?>
  </div>
  <!--------------- /. AVISO --------------->
</div>

<div class="col-md-6 pull-right">
                                        <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-pencil"></i> Cadastrar </button>
</div>

                            </div>
                            </form>
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
