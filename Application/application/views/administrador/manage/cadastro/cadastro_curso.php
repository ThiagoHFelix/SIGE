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


        <style>
            /* Customize the label (the container) */
            .container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 16px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
                position: absolute;
                opacity: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .container input:checked ~ .checkmark {
                background-color: #2196F3;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            Try it Yourself »

        </style>

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

                    <div class="col-xs-12">
                        <!--------------------------- / HEADER / ------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row"  style="margin-bottom:-20px">

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/manage/curso'); ?>">  <button class="btn btn-app "  >
                                        <span class="fa fa-graduation-cap" aria-hidden="true"></span>
                                        Gerenciar Curso
                                    </button> </a>

                            </div>


                            <div class="col-md-8">

                                <div class="text-center login-logo">

                                    <div class=" box-header register-logo">
                                        <a> Cadastro de Curso</a>
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
                        <div class="col-md-12">

                            <!--------------- AVISO --------------->
                            <div class="form-group has-feedback text-center" >
                                <?php echo $this->session->flashdata('mensagem_usuario'); ?>
                            </div>
                            <!--------------- /. AVISO --------------->

                        </div>
                        <div class="col-md-12" >




                            <div class="box box-solid" >

                                <?php echo form_open('cadastro/curso'); ?>



                                <div class="row" >
                                    <div class="box-header text-center" >
                                        Selecione o semestre somente das matérias selecionadas
                                    </div>

                                </div>
                                <div class="box-body" >
                                    <div class="col-md-12" >

                                        <!--------------- TITULO --------------->
                                        <div class="form-group has-feedback">
                                            <input  required name="titulo" type="text" class="form-control  " value="<?php echo setValue('titulo'); ?>" placeholder="Nome do Curso*">
                                            <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. TITULO --------------->



                                        <div  class="col-md-12" style="height: 200px;overflow-x: auto; margin-bottom:40px">

                                            <?php if (isset($Mate)): $i = 0; ?>
                                                <?php foreach ($Mate as $materia): $i++; ?>

                                                    <div class="col-md-6" >
                                                        <div class="col-md-6 ">


                                                            <div class="form-check" style="text-center">
                                                                <label class="container">
                                                                    <?php echo $materia['TITULO']; ?>
                                                                    <input
                                                                    <?php if ($this->input->post('materia') !== NULL): ?>
                                                                        <?php foreach ($this->input->post('materia') as $materi): ?>
                                                                            <?php
                                                                            if (strcmp($materi, $materia['ID']) === 0): echo 'checked';
                                                                                break;
                                                                            endif;
                                                                            ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>

                                                                        type="checkbox" name="materia[]" class="form-check-input" value="<?php echo $materia['ID']; ?>"  >


                                                                    <span class="checkmark"></span>

                                                                </label>


                                                            </div>
                                                        </div>




                                                        <div class="col-md-6 ">
                                                            <!--------------- SEMESTRE --------------->
                                                            <div class="form-group has-feedback">
                                                                <select   class="form-control" name="semestre_<?php echo $materia['ID']; ?>" >

                                                                    <option  value="">Semestre*</option>
                                                                    <option 
                                                                    <?php
                                                                    if (strcmp($this->input->post('semestre_' . $materia['ID']), 'Primeiro') === 0): echo 'selected';
                                                                    endif;
                                                                    ?>
                                                                        value="Primeiro">Primeiro</option>
                                                                    <option 
                                                                    <?php
                                                                    if (strcmp($this->input->post('semestre_' . $materia['ID']), 'Segundo') === 0): echo 'selected';
                                                                    endif;
                                                                    ?>
                                                                        value="Segundo">Segundo</option>
                                                                    <option 
                                                                    <?php
                                                                    if (strcmp($this->input->post('semestre_' . $materia['ID']), 'Terceiro') === 0): echo 'selected';
                                                                    endif;
                                                                    ?>
                                                                        value="Terceiro">Terceiro</option>
                                                                    <option 
                                                                    <?php
                                                                    if (strcmp($this->input->post('semestre_' . $materia['ID']), 'Quarto') === 0): echo 'selected';
                                                                    endif;
                                                                    ?>
                                                                                value="Quarto">Quarto</option>
                                                                    <option 
                                                                    <?php
                                                                    if (strcmp($this->input->post('semestre_' . $materia['ID']), 'Quinto') === 0): echo 'selected';
                                                                    endif;
                                                                    ?>
                                                                        value="Quinto">Quinto</option>
                                                                    <option 
                                                                    <?php
                                                                    if (strcmp($this->input->post('semestre_' . $materia['ID']), 'Sexto') === 0): echo 'selected';
                                                                    endif;
                                                                    ?>
                                                                        value="Sexto">Sexto</option>
                                                                   


                                                                </select>
                                                            </div>
                                                            <!--------------- /. SEMESTRE --------------->



                                                        </div>
                                                    </div>
















                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">








                                        <!--------------- Descrição Geral --------------->
                                        Descrição Geral:
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" maxlength="62" rows="5" name="descricao" placeholder=""><?php echo setValue('descricao'); ?></textarea>
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Descrição Geral --------------->



                                        <!--------------- Descrição de Duração --------------->
                                        Descreva sobre duração do curso:
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" rows="5" maxlength="62" name="duracao" placeholder="Descreva a duração do curso" ><?php echo setValue('duracao'); ?></textarea>
                                            <span class="fa fa-dot-circle-o form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Descrição de Duração --------------->


                                    </div>

                                    <div class="col-md-6">

                                        <!--------------- Descrição de Vagas --------------->
                                        Descrição sobre as Vagas:
                                        <div class="form-group has-feedback">


                                            <textarea class="form-control" rows="5" maxlength="62" name="vagas" placeholder="Descrição sobre as Vagas" ><?php echo setValue('vagas'); ?></textarea>
                                            <span class="glyphicon glyphicon-bookmark form-control-feedback"></span>

                                        </div>


                                        <!--------------- /. Descrição de Vagas --------------->

                                        <!--------------- Carga Horaria     --------------->
                                        Carga Horaria:
                                        <div class="form-group has-feedback">
                                            <textarea class="form-control" rows="5" maxlength="62" name="carga_horaria" placeholder="Carga Horaria" ><?php echo setValue('carga_horaria'); ?></textarea>
                                            <span class="glyphicon glyphicon-book form-control-feedback"></span>
                                        </div>
                                        <!--------------- /. Carga Horaria  --------------->

                                    </div>



                                    <div class="col-md-12 ">
                                        <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-pencil"></i> Cadastrar </button>
                                    </div>

                                </div>
                                </form>

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

<!-- CK EDITOR-->
<script src="<?php echo base_url('data-views/biblioteca/ckeditor-basic/ckeditor.js'); ?>  "></script>

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

<script>
    CKEDITOR.replace('descricao');
    CKEDITOR.replace('duracao');
    CKEDITOR.replace('vagas');
    CKEDITOR.replace('carga_horaria');
</script>


</body>
</html>
