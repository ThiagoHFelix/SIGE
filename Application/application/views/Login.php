<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/bower_components/Ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/dist/css/AdminLTE.min.css?v=3'); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url('data-views/dashboard/plugins/iCheck/square/blue.css'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style type="text/css">



            body{
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.2)), color-stop(100%,rgba(255,255,255,0.2))), url("<?php echo base_url('data-views/home/img/background2.jpg '); ?> ") repeat 0 0;
                
                background-color: #fff;
                backace-visibility: 10;
                background-size: 1300px;
                display: flex;
            }

        </style>


        <?php

          //Botão selecionado

          $entidade_selecionada = $this->uri->segment(2);

          $texto_button = array(

            'administrador' => 'Administrador (Selecionado)',
            'professor' => 'Professor',
            'aluno' => 'Aluno'

          );

          switch(strtoupper($entidade_selecionada)){


            case 'ADMINISTRADOR':
                    $texto_button['administrador'] =  'Administrador (Selecionado)';
                    $texto_button['professor'] =  'Professor';
                    $texto_button['aluno'] =  'Aluno';
            break;

            case 'PROFESSOR':
                    $texto_button['administrador'] =  'Administrador';
                    $texto_button['professor'] =  'Professor (Selecionado)';
                    $texto_button['aluno'] =  'Aluno';
            break;

            case 'ALUNO':
                    $texto_button['administrador'] =  'Administrador';
                    $texto_button['professor'] =  'Professor';
                    $texto_button['aluno'] =  'Aluno (Selecionado)';
            break;

            

          }//switch



        ?>

    </head>
    <body class="hold-transition  ">

        <div class="login-box">
            <div class="login-logo" style="padding-top:0px;">
                <a style="color:white;" href="<?php echo base_url(); ?>"><b>C</b>entro - <b>E</b>scolar</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Identifique-se para utilzar o sistema</p>

                <form action="<?php echo base_url('/login/' . $this->uri->segment(2)); ?>" method="post">
                    <div class="form-group has-feedback">
                        <input required name="username" type="email" class="form-control" value="<?php echo setValue('username'); ?>" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input required name="password" type="password" class="form-control" value="<?php echo setValue('password'); ?>" placeholder="<?php echo $this->lang->line('placeholder_password'); ?>">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-12 text-center">
                            <div class="" >
                                <p class="validation_erros" > <?php echo $this->session->flashdata('aviso_login'); ?> </p>
                            </div>
                            <button type="submit" class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="glyphicon glyphicon-log-in"></i><?php echo $this->lang->line('button_login'); ?> </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <div class="social-auth-links text-center">
                    <p> Logar como </p>
                    <a href="<?php echo base_url('/login/administrador'); ?>" class="btn btn-block btn-social btn-primary btn-flat"><i class="fa fa-user"></i> <?php echo $texto_button['administrador'];  ?> </a>
                    <a href="<?php echo base_url('/login/professor'); ?>" class="btn btn-block btn-social btn-info btn-flat"><i class="fa fa-user"></i> <?php echo $texto_button['professor'];  ?> </a>
                    <a href="<?php echo base_url('/login/aluno'); ?>" class="btn btn-block btn-social btn-success btn-flat"><i class="fa fa-user"></i> <?php echo $texto_button['aluno'];  ?> </a>
                    <br/>
                    <a href="#" class="link-muted" style="text-align: center"><?php echo $this->lang->line('recovery_pass'); ?></a>

                </div>
                <!-- /.social-auth-links -->

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="<?php echo base_url('data-views/dashboard/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url('data-views/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('data-views/dashboard/plugins/iCheck/icheck.min.js'); ?>"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });


        </script>
    </body>
</html>
