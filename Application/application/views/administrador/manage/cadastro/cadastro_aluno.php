<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SIGE | Matricula Aluno</title>

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
            <div class="content-wrapper"style="height:980px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="col-xs-12">
                        <!--------------------------- / HEADER / ------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row"  style="margin-bottom:-20px">

                            <div class="col-md-2">

                                <a href="<?php echo base_url('/manage/aluno'); ?>">  <button class="btn btn-app "  >
                                        <span class="fa fa-users" aria-hidden="true"></span>
                                        Gerenciar Aluno
                                    </button> </a>

                            </div>


                            <div class="col-md-8">

                                <div class="text-center login-logo">

                                    <div class=" box-header register-logo">
                                        <a> Matricula de Aluno</a>
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
<div class="col-md-12">
                            
                             <!--------------- AVISO --------------->
                                <div class="form-group has-feedback text-center " >
                                    <?php echo $this->session->flashdata('mensagem_usuario'); ?>
                                </div>
                                <!--------------- /. AVISO --------------->
                        </div>

                    <div class="col-md-12" >

                        <div class="box box-solid" >
                            <div class="box-header text-center"> Todos os campos com o caracter (*) são obrigatórios </div>
                            

                            <?php echo form_open_multipart('cadastro/aluno'); ?>
                            
                            <div class="col-md-12"> 
                            
                                      <div class="form-group has-feedback" >

                                            <input type="file" class="form-control" id="imagem" name="imagem"  size="20">

                                        </div>

                            
                            </div>
                            <div class="box-body">
                            <div class="col-md-6">


                                <!--------------- PRIMEIRO NOME --------------->
                                <div class="form-group has-feedback">
                                    <input  required name="primeiroNome" type="text" class="form-control " value="<?php echo setValue('primeiroNome'); ?>" placeholder="Primerio Nome*">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <!--------------- /. PRIMEIRO NOME --------------->

                                <!--------------- SOBRENOME --------------->
                                <div class="form-group has-feedback">
                                    <input  required name="sobrenome" type="text" class="form-control" value="<?php echo setValue('sobrenome'); ?>" placeholder="Sobrenome*">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <!--------------- /. SOBRENOME --------------->

                                <!--------------- NASCIMENTO --------------->
                                <div class="form-group has-feedback">
                                    <input  required name="nascimento" type="date" class="form-control" value="<?php echo setValue('nascimento'); ?>" placeholder="Data de nascimento*">
                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                </div>
                                <!--------------- /. NASCIMENTO --------------->

                                <!--------------- STATUS ------------------
                                <div class="form-group has-feedback">
                                    <select class="form-control" >
                                        <option > Selecione o status </option>
                                        <option > Ativo </option>
                                        <option > Desativo </option>
                                    </select>
                                </div>
                                <!--------------- /. STATUS --------------->

                                <!--------------- CEP --------------->
                                <div class="form-group has-feedback">
                                    <input  name="cep" id="cep" type="text" class="form-control" value="<?php echo setValue('cep'); ?>" placeholder="CEP"
                                            data-inputmask='"mask": "99999-999"' data-mask
                                            >
                                    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                                </div>
                                <!--------------- /. CEP --------------->


                                   <!--------------- ESTADO --------------->
                                    <div class="form-group ">
                                        <select class="form-control " name="estado">
                                            <option value="">Selecione seu estado</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'AC') === 0): echo 'selected';
                                endif;
                                ?>  value="AC">Acre</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'AL') === 0): echo 'selected';
                                                endif;
                                ?>  value="AL">Alagoas</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'AP') === 0): echo 'selected';
                                                endif;
                                ?> value="AP">Amapá</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'AM') === 0): echo 'selected';
                                                endif;
                                ?> value="AM">Amazonas</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'BA') === 0): echo 'selected';
                                                endif;
                                ?> value="BA">Bahia</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'CE') === 0): echo 'selected';
                                                endif;
                                ?> value="CE">Ceará</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'DF') === 0): echo 'selected';
                                                endif;
                                ?> value="DF">Distrito Federal</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'ES') === 0): echo 'selected';
                                                endif;
                                ?> value="ES">Espírito Santo</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'GO') === 0): echo 'selected';
                                                endif;
                                ?> value="GO">Goiás</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'MA') === 0): echo 'selected';
                                                endif;
                                ?> value="MA">Maranhão</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'MT') === 0): echo 'selected';
                                                endif;
                                ?> value="MT">Mato Grosso</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'MS') === 0): echo 'selected';
                                                endif;
                                ?> value="MS">Mato Grosso do Sul</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'MG') === 0): echo 'selected';
                                                endif;
                                ?> value="MG">Minas Gerais</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'PA') === 0): echo 'selected';
                                                endif;
                                ?> value="PA">Pará</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'PB') === 0): echo 'selected';
                                                endif;
                                ?> value="PB">Paraíba</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'PR') === 0): echo 'selected';
                                                endif;
                                ?> value="PR">Paraná</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'PE') === 0): echo 'selected';
                                                endif;
                                ?> value="PE">Pernambuco</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'PI') === 0): echo 'selected';
                                                endif;
                                ?> value="PI">Piauí</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'RJ') === 0): echo 'selected';
                                                endif;
                                ?> value="RJ">Rio de Janeiro</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'RN') === 0): echo 'selected';
                                                endif;
                                ?> value="RN">Rio Grande do Norte</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'RS') === 0): echo 'selected';
                                                endif;
                                ?> value="RS">Rio Grande do Sul</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'RO') === 0): echo 'selected';
                                                endif;
                                ?> value="RO">Rondônia</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'RR') === 0): echo 'selected';
                                                endif;
                                ?> value="RR">Roraima</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'SC') === 0): echo 'selected';
                                                endif;
                                ?> value="SC">Santa Catarina</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'SP') === 0): echo 'selected';
                                                endif;
                                ?> value="SP">São Paulo</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'SE') === 0): echo 'selected';
                                                endif;
                                ?> value="SE">Sergipe</option>
                                            <option <?php if (strcmp($this->input->post('estado'), 'TO') === 0): echo 'selected';
                                                endif;
                                ?> value="TO">Tocantins</option>
                                        </select>
                                        <span class="form-control-feedback"></span>
                                    </div>
                                    <!--------------- /. ESTADO --------------->


                                <!--------------- CIDADE --------------->
                                <div class="form-group has-feedback">
                                    <input  name="cidade" type="text" class="form-control" value="<?php echo setValue('cidade'); ?>" placeholder="Cidade"  >
                                    <span class="fa fa-building form-control-feedback"></span>
                                </div>
                                <!--------------- /. CIDADE --------------->

                                <!--------------- BAIRRO --------------->
                                <div class="form-group has-feedback">
                                    <input  name="bairro" type="text" class="form-control" value="<?php echo setValue('bairro'); ?>" placeholder="Bairro"  >
                                    <span class="fa fa-map form-control-feedback"></span>
                                </div>
                                <!--------------- /. BAIRRO --------------->


                                
                                <!--------------- RUA --------------->
                                <div class="form-group has-feedback">
                                    <input  name="rua" type="text" class="form-control" value="<?php echo setValue('rua'); ?>" placeholder="Rua"  >
                                    <span class="fa fa-road form-control-feedback"></span>
                                </div>
                                <!--------------- /. RUA --------------->
                              


                            </div>

                            <div class="col-md-6">
                                
                             
                                
                               <!--------------- EMAIL --------------->
                                <div class="form-group has-feedback">
                                    <input   required name="email" type="email" class="form-control "  maxlength="30" value="<?php echo setValue('email'); ?>" placeholder="Email*">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <!--------------- /. EMAIL --------------->

                                <!--------------- CPF --------------->
                                <div class="form-group has-feedback">
                                    <input required name="cpf" type="text" class="form-control "  value="<?php echo setValue('cpf'); ?>" placeholder="CPF*"
                                            data-inputmask='"mask": "999.999.999-99"' data-mask
                                            >
                                    <span class="fa fa-user-circle-o form-control-feedback"></span>
                                </div>
                                <!--------------- /. CPF --------------->

                                <!--------------- RG --------------->
                                <div class="form-group has-feedback">
                                    <input  name="rg" type="text" class="form-control "  value="<?php echo setValue('rg'); ?>" placeholder="RG"
                                            data-inputmask='"mask": "99.999.999-*"' data-mask
                                            >
                                    <span class="fa fa-user-circle form-control-feedback"></span>
                                </div>
                                <!--------------- /. RG --------------->

                                <!--------------- TELEFONE --------------->
                                <div class="form-group has-feedback">
                                    <input  name="telefone" type="tel" class="form-control "  value="<?php echo setValue('telefone'); ?>" placeholder="Telefone"
                                            data-inputmask='"mask": "(99)9999-9999"' data-mask
                                            >
                                    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                                </div>
                                <!--------------- /. TELEFONE --------------->

                                 <!--------------- SEXO --------------->
                                    <div class="form-group has-feedback">
                                        <select  required class="form-control" name="sexo" >
                                            <option value="">Sexo*</option>
                                            <option <?php if (strcmp($this->input->post('sexo'), 'Masculino') === 0): echo 'selected';
                                                endif;
                                ?> value="Masculino">Masculino</option>
                                            <option <?php if (strcmp($this->input->post('sexo'), 'Feminino') === 0): echo 'selected';
                                                endif;
                                ?> value="Feminino">Feminino</option>
                                        </select>
                                    </div>
                                    <!--------------- /. SEXO --------------->

                                <!--------------- SENHA --------------->
                                <div class="form-group has-feedback">
                                    <input required name="senha" type="password" class="form-control" minlength="5" maxlength="20" value="<?php echo setValue('senha'); ?>" placeholder="Senha*">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <!--------------- /. SENHA --------------->


                                <!--------------- CONFIRMAÇÃO DA SENHA --------------->
                                <div class="form-group has-feedback">
                                    <input  required name="conf_senha" type="password" class="form-control" minlength="5" maxlength="20" value="<?php echo setValue('conf_senha'); ?>" placeholder="Confirme a senha*">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <!--------------- /. CONFIRMAÇÃO DA SENHA --------------->

                                  
                                 <!--------------- CURSOS --------------->
                                    <div class="form-group has-feedback">
                                        <select  required class="form-control" name="cursos" >
                                            <option value="" >Curso*</option> 

                                            <?php if (isset($cursos)): ?> 
                                                <?php foreach ($cursos as $curso): ?>

                                                    <option 
                                                    <?php
                                                    if (strcmp($this->input->post('cursos'), $curso['ID']) === 0): echo 'selected';
                                                    endif;
                                                    ?> 
                                                        value="<?php echo $curso['ID'] ?>"><?php echo $curso['TITULO']; ?></option>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </select>
                                    </div>
                                    <!--------------- /. CURSOS --------------->
                                
                                
                            </div>
                            
                            <div class="col-md-12">
                                        Informações adicionais da Matricula:
                                        <div class="form-group has-feedback">

                                            <textarea required maxlength="250" class="form-control" minlength="255" rows="6" name="infoadd" placeholder="infoadd*"><?php echo setValue('infoadd'); ?></textarea>
                                            <span class="fa fa-book form-control-feedback"></span>

                                        </div> 
                                
                                 <button type="submit"  class="btn btn-block btn-social btn-primary btn-block btn-flat"><i class="fa fa-pencil"></i> Cadastrar </button>


                            </div>
                            
                            
                            
                           
                      
                        </div>
                      
                        
                        </form>


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
 <!--  <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
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


            });
            
                CKEDITOR.replace('infoadd');
        </script>

    </body>
</html>
