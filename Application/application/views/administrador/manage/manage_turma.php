<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> SIGE | Turma </title>
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

        <script type="text/javascript">

            function confirmaDelete(id) {

                var retorno = confirm('Deseja realmente desativar este Curso ?');

                if (retorno == true) {

                    window.location = "<?php echo base_url('/manage/desativar/' . $this->uri->segment(2) . '/') ?>".concat(id);

                }//if | retorno



            }//function


            function confirmaActive(id) {


                var retorno = confirm('Deseja realmente ativar este Curso ?');

                if (retorno == true) {

                    window.location = "<?php echo base_url('/manage/ativar/' . $this->uri->segment(2) . '/') ?>".concat(id);

                }//if | retorno




            }//function


        </script>



    </head>
    <body class="hold-transition sidebar-mini">
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
                <section class="content" style="height:690px;">


                    <div class="col-xs-12">



                        <?php
                        //Variavel responsável por avisar usuário
                        echo $this->session->flashdata('mensagem_manageTurma');
                        ?>

                        <div class="row" >

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/cadastro/turma'); ?>">  <button class="btn btn-app"  >
                                        <span class="fa fa-users" aria-hidden="true"></span>
                                        Cadastrar Turma
                                    </button> </a>

                            </div>


                            <div class="col-md-6">

                                <div class="text-center login-logo">

                                    <p> Gerenciamento de Turmas </p>


                                </div>



                            </div>


                            <div class="col-md-4 pull-right"  >

                                <div class="box-tools pull-right  ">
                                    <form method="post" action="<?php echo base_url('/manage/' . $this->uri->segment(2)); ?>"    >
                                        <div class="input-group input-group-sm" style=" width:340px;">
                                            <div class="input-group-btn  input-group-sm" >
                                                <button name="clear_search" class="fa fa-close btn btn-primary pull-left btn-sm"> <small>Limpar pesquisa</small></button>
                                            </div>

                                            <input type="text" name="table_search" value="<?php echo $this->session->userdata('table_search'); ?>" class="form-control pull-right" placeholder="Search">
                                            <div class="input-group-btn  input-group-sm" style="width:80px;">

                                                <select name="dropdown_search" class="form-control pull-left dropdown dropdown_options" >
                                                    <?php echo $dropdown_options; ?>
                                                </select>

                                            </div>
                                            <div class="input-group-btn input-group-sm">
                                                <button type="submit" class="btn btn-prmary"><i class="fa fa-search"></i></button>
                                            </div>



                                        </div>

                                    </form>
                                </div>


                            </div>


                        </div>


                        <div class="box box-solid"  >


                            <!-- /.box-header -->

                            <table id="table_info" class="table table-bordered table-hover"  style="text-align: center">

                                <thead>  <tr> 

                                        <th  style="text-align: center">Titulo</th>
                                        <th  style="text-align: center">Status</th>
                                        <th  style="text-align: center">Inicio Previsto</th>
                                        <th  style="text-align: center">Ações</th>


                                    </tr> </thead>
                                <tbody>
                                    <?php
                                    if ($table != NULL):

                                        foreach ($table as $row):
                                            echo '<tr>';
                                            echo '<td>  ' . $row['TITULO'] . ' </td>';


                                            if (strcmp(strtoupper($row['STATUS']), 'DESATIVADO') != 0):
                                                echo '<td><span class="label label-primary"> Ativado </span></td>';

                                            else:

                                                echo '<td><span class="label label-danger"> Desativado </span></td>';

                                            endif;
                                            
                                            echo '<td>  ' . $row['DATAINICIAL'] . ' </td>';

                                            $url = base_url('/visualizar/turma/' . $row['ID']);

                                            if (strcmp(strtoupper($row['STATUS']), 'ATIVADO') == 0):

                                                $button = "

                                                     <td >
                                                        <div class=\"btn-group\">
                                                             <a href=\" " . $url . "  \">   <button class=\"fa fa-info btn  btn-primary\" ></button> </a>
                                                                 <a href='" . base_url('/update/turma/' . $row['ID']) . "'>   <button class=\"fa fa-edit btn btn-info\"></button> </a>
                                                            <a>   <button onclick=\"confirmaDelete(" . $row['ID'] . ")\" class=\"fa fa-lock btn btn-danger\"></button> </a>

                                                        </div>
                                                     </td>
                                                 ";

                                            else:

                                                $button = "

                                                     <td >
                                                        <div class=\"btn-group\">
                                                           <a href=\" " . $url . "  \">   <button class=\"fa fa-info btn  btn-primary\" ></button> </a>
                                                                 <a href='" . base_url('/update/turma/' . $row['ID']) . "'>   <button class=\"fa fa-edit btn btn-info\"></button> </a>"
                                                    . " <a>   <button onclick=\"confirmaActive(" . $row['ID'] . ")\" class=\"fa fa-unlock btn btn-info\"></button> </a>

                                                        </div>
                                                     </td>
                                                 ";

                                            endif;

                                            echo $button;


                                        endforeach;

                                    endif;
                                    ?>


                                    </tr>
                                </tbody>
                            </table>

                            <!-- /.box-body -->


                            <div class="box-footer">


                                <?php
                                echo $pagination;
                                ?>
                                <!--
                                  <ul class="pagination" style="float:right">
                                      <li class="active"><a  href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                  </ul>
                                -->

                            </div>
                            <!-- /.box -->
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

        <script>
            $(function () {
                $('#table_info').DataTable()
                $('#table_info').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })
        </script>


    </body>
</html>
