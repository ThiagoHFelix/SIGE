
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

        <!-- search form --

        <p class="box-title text-center" style=" margin-top:5px;"><?php
          // 
            ?></p>

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

            <li>
                <a href="<?php echo base_url('/dashboard'); ?>">
                    <i class="fa fa-book"></i> <span>Minhas Materias</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">5</small> 
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


        </ul>





    </section>
    <!-- /.sidebar -->
</aside>
