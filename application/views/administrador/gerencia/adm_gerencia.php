<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gerenciamento de Administradores</title>
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
                    <h1>
                        Gerenciamento de Administradores
                        <small>Em desenvolvimento</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url($this->uri->segment(1) . '/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home </a></li>                      
                        <li><a href="<?php echo base_url($this->uri->segment(1) . '/manage/administrador'); ?>"><i class="fa fa-users"></i> Gerenciamento Administradores </a></li>                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" style="height:590px;">


                    <div class="col-xs-12">
                        <div class="box box-primary"  >
                            <div class="box-header" >

                                <div class="btn-group-vertical">
                                    <button class="btn btn-sm fa fa-user-plus" style="width: 200%; margin-top:0px;"></button>
                                </div>

                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                    <?php
                                    if ($tableAdm != NULL):

                                        foreach ($tableAdm as $row):
                                            echo '<tr>';
                                            echo '<td>  ' . $row['id'] . ' </td>';

                                            echo '<td> ' . $row['primeiroNome'] . ' ' . $row['sobrenome'] . ' </td>';
                                            echo '<td> ' . $row['email'] . ' </td>';


                                            if ($row['status'] == 1):
                                                echo '<td><span class="label label-primary"> Ativo </span></td>';

                                            else:

                                                echo '<td><span class="label label-danger"> Desativado </span></td>';

                                            endif;

                                            $url = base_url($this->uri->segment(1) . '/manage/administrador/userprofile/' . $row['id']);
                                            echo "
                                                
                                                     <td>
                                                        <div class=\"btn-group\">
                                                             <a href=\" " . $url . "  \">   <button class=\"fa fa-edit btn  btn-success\" ></button> </a>
                                                            <a>   <button class=\"fa fa-remove btn btn-danger\"></button> </a>
                                                        </div>
                                                     </td>
                                                
                                                ";


                                        endforeach;

                                    endif;
                                    ?>


                                    </tr> 

                                </table>
                            </div>
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
    </body>
</html>
