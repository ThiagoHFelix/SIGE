<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIGE | Frequência</title>
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

                                <a href="<?php echo base_url('/cadastro/falta/' . $this->uri->segment(3)); ?>">  <button class="btn btn-app"  >
                                        <span class="fa fa-users" aria-hidden="true"></span>
                                        Inserir Frequência
                                    </button> </a>

                            </div>


                            <div class="col-md-6">

                                <div class="login-logo" style="text-align:left">

                                    <p>Gerenciamento de Frequência</p>


                                </div>

                            </div>

                            <div class="col-md-4">

                                <!--------------- OPTION --------------->
                                <div class="form-group has-feedback pull-left" style="width:50%">
                                    <select  required class="form-control" id="option" >
                                        <option value="0">Nome do Aluno</option>
                                        <option value="1">Data</option>
                                        <option value="2">Hora</option>
                                        <option value="3">Aula</option>
                                        <option value="4">Falta</option>
                                        
                                    </select>
                                </div>
                                <!--------------- /. OPTION --------------->
                                
                                <!--------------- TITULO --------------->
                                <div class="form-group has-feedback pull-right"style="width:50%">
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
                                            <th  style="text-align: center">Data</th>
                                            <th  style="text-align: center">Hora</th>
                                            <th  style="text-align: center">Aula</th>
                                            <th  style="text-align: center">Falta</th>


                                        </tr> </thead>
                                    <tbody>

                                        <?php if (isset($FREQUENTA_ALUNOS)): ?>
                                            <?php foreach ($FREQUENTA_ALUNOS as $FREQUENTA_ALUNO): ?>
                                                <tr>

                                                    <td>  <?php echo $FREQUENTA_ALUNO['PRIMEIRONOME'] . ' ' . $FREQUENTA_ALUNO['SOBRENOME']; ?>  </td>
                                                    <td>  <?php echo $FREQUENTA_ALUNO['DATA']; ?>  </td>
                                                    <td>  <?php echo $FREQUENTA_ALUNO['HORA']; ?>  </td>
                                                    
                                                    <td>  <?php if($FREQUENTA_ALUNO['AULA'] == 1): ?>
                                                        
                                                            <span class="label label-primary">Primeira Aula</span>
                                                          <?php else: ?>
                                                            <span class="label label-warning">Segunda Aula</span>
                                                          <?php endif; ?>
                                                    
                                                    </td>
                                                    
                                                    <td>  <?php if($FREQUENTA_ALUNO['PRESENCA'] == 1): ?>
                                                        
                                                            <span class="label label-primary">Presente</span>
                                                          <?php else: ?>
                                                            <span class="label label-danger">Ausente</span>
                                                          <?php endif; ?>
                                                    
                                                    </td>

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
                var input, filter, table, tr, td, i, option, option_number;
                input = document.getElementById("search");
                filter = input.value.toUpperCase();
                table = document.getElementById("table_notas");
                option = document.getElementById("option");
                
                for (i = 0; i < option.options.length; i++) {
                    if(option.options[i].selected === true){
                         option_number = i;
                    }//if
                }//for
                
                
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[option_number];
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
