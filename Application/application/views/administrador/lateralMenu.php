
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->session->userdata('user_foto'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('user_name'); ?></p>
                <a href="<?php echo base_url('/dashboard'); ?>"><i class="fa fa-user-circle text-success"></i> <?php echo strtoupper($this->session->userdata('entidade')); ?> </a>
            </div>
        </div>

         <!-- search form


        <div  class="sidebar-form info" style="height: 35px; text-align: center; ">
              <p class="box-title" style="color:white; margin-top:5px;"><?php
              //date_default_timezone_set('America/Sao_Paulo');
              //echo 'Hoje: '. date('d/m/Y')?></p>
        </div>

      <!-- /.search form -->

        <!--


        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>



        -->


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU PRINCIPAL</li>

            <li>
                <a href="<?php echo base_url('/dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Inicio</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            
            

            <li>
                <a href="<?php echo base_url('/cadastro/selectAlunoTurma'); ?>">
                    <i class="fa fa-users"></i> <span>Matricular</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url('/manage/administrador'); ?>">
                    <i class="fa fa-users"></i> <span>Administradores</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('/manage/aluno'); ?>">
                    <i class="fa fa-users"></i> <span>Alunos</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('/manage/professor'); ?>">
                    <i class="fa fa-users"></i> <span>Professores</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('/manage/curso'); ?>">
                    <i class="fa fa-graduation-cap"></i> <span>Cursos</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('/manage/materia'); ?>">
                    <i class="fa fa-book"></i> <span>Materias</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url('/manage/turma'); ?>">
                    <i class="fa fa-users"></i> <span>Turmas</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url('/manage/aviso'); ?>">
                    <i class="fa fa-calendar-check-o"></i> <span>Avisos</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('/dashboard'); ?>">
                    <i class="fa fa-gears"></i> <span>Configuração</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>








    </section>
    <!-- /.sidebar -->
</aside>
