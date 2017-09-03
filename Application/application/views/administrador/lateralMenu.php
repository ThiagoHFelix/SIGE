
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->session->userdata('user_foto'); ?>       " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('user_name'); ?></p>
                <a href="<?php echo base_url('/dashboard'); ?>"><i class="fa fa-user-circle text-success"></i> <?php echo $this->session->userdata('entidade'); ?> </a>
            </div>
        </div>

         <!-- search form -->
      
          <div  class="sidebar-form" style="height: 35px; text-align: center; ">
              <p class="box-title" style="color:white; margin-top:5px;"><?php
              date_default_timezone_set('America/Sao_Paulo');
              echo 'Hoje: '. date('d/m/Y')?></p>
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
                    <i class="fa fa-home"></i> <span>Inicio</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            
                    <li class="treeview">

                <a href="#">
                    <i class="fa fa-navicon"></i>
                    <span> Gerenciamento </span>
                    <span class="pull-right-container">

                    </span>
                </a>



                <!-- GERENCIAR ENTIDADES -->
                <ul class="treeview-menu">

                    <!-- ADMINISTRADOR -->
                    <li><a href="<?php echo base_url('/manage/administrador'); ?>"><i class="fa fa-users"></i> Administrador </a></li>
                    <!-- PROFESSOR -->
                    <li><a href="<?php echo base_url('/manage/professor'); ?>"><i class="fa fa-users"></i> Professor </a></li>
                    <!-- ALUNO -->
                    <li><a href="#"><i class="fa fa-users"></i> Aluno </a></li>
                    <!-- MATÉRIA -->
                    <li><a href="#"><i class="fa fa-book"></i> Matéria </a></li>
                    <!-- CURSO -->
                    <li><a href="#"><i class="fa fa-graduation-cap"></i> Curso </a></li>

                </ul>


            </li>
            
            <li>
                <a href="<?php echo base_url('/dashboard'); ?>">
                    <i class="fa fa-area-chart"></i> <span>Relatórios</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
       
            <li>
                <a href="<?php echo base_url('/dashboard'); ?>">
                    <i class="fa fa-pencil"></i> <span>Registrar nota</span>
                    <span class="pull-right-container">
                       <!-- <small class="label pull-right bg-green">inicio</small> -->
                    </span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url('/dashboard'); ?>">
                    <i class="fa fa-comments"></i> <span>Chat</span>
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
