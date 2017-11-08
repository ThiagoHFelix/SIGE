<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE | Notas</title>
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
                <section class="content-header" style="height:690px;">


                    <div class="col-xs-12">



                        <?php
                        //Variavel responsável por avisar usuário sobre o sucesso do cadastro
                        echo $this->session->flashdata('message_nota');
                        ?>

                        <div class="row" >

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/cadastro/nota/' . $this->uri->segment(3)); ?>">  <button class="btn btn-app"  >
                                        <span class="fa fa-users" aria-hidden="true"></span>
                                        Inserir nota
                                    </button> </a>

                            </div>


                            <div class="col-md-6">

                                <div class="text-center login-logo">

                                    <p> Gerenciamento de Notas </p>


                                </div>

                            </div>

                            <div class="col-md-4">


                                <!--------------- TITULO --------------->
                                <div class="form-group has-feedback">
                                    <input  required id="search" type="text" onkeyup="search()" class="form-control" placeholder="Procurar Aluno">
                                    <span class="fa fa-search form-control-feedback"></span>
                                </div>
                                <!--------------- /. TITULO --------------->


                            </div>


                        </div>



                        <div class="box box-solid"  >


                            <div class="box-header text-center">

                                <p> <strong>Turma:</strong><?php if (isset($TURMA)): echo $TURMA['TITULO'] . ' | ';
                        endif;
                        ?>  <strong>Matéria:</strong> <?php if (isset($MATERIA)): echo $MATERIA['TITULO'];
                                    endif;
                        ?> </p>

                            </div>

                            <div class="box-body table-responsive no-padding" style="height:450px; overflow:auto;">
                                <table id="table_notas" class="table table-responsive table-hover text-center" >

                                    <thead>  <tr> 


                                            <th  style="text-align: center">Nome do Aluno</th>
                                            <th  style="text-align: center">Numero da Prova</th>
                                            <th  style="text-align: center">Nota</th>


                                        </tr> </thead>
                                    <tbody>

                                        <?php if (isset($notas_alunos)): ?>
                                            <?php foreach ($notas_alunos as $nota_aluno): ?>
                                                <tr>

                                                    <td>  <?php echo $nota_aluno['PRIMEIRONOME'] . ' ' . $nota_aluno['SOBRENOME']; ?>  </td>
                                                    <td>  <?php echo $nota_aluno['NUMPROVA']; ?>  </td>
                                                    <td>  <?php echo $nota_aluno['NOTA']; ?>  </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->


                            <div class="box-footer">



                                <div class="box-tools pull-left" >
                                </div>
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
            });


            //XXX Sxript para filtrar nomes da table table_notas
            function search() {

                // Declare variables 
                var input, filter, table, tr, td, i;
                input = document.getElementById("search");
                filter = input.value.toUpperCase();
                table = document.getElementById("table_notas");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            



            }//search



        </script>


    </body>
</html>
