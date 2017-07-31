<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('/en/dashboard'); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b></b>CE</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Centro Escolar</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">


        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">1000</span>
                    </a>



                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>

                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>


                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">


                        <img src="<?php
                        //Verifico se o usuário tem alguma foto cadastrada
                        if (strcmp($this->session->userdata('user_foto'), "") == 0):
                            echo base_url('data-views/dashboard/dist/img/avatar0.png');
                        else:
                            //FIXIT padronizar 
                            echo $this->session->userdata('user_foto');
                        endif;
                        ?>  " class="user-image" alt="User Image">



                        <span class="hidden-xs"><?php echo $this->session->userdata('user_name'); ?></span>
                    </a>
                    <ul class="dropdown-menu">


                        <!-- User image -->
                        <li class="user-header">

                            <img src=" <?php
                        //Verifico se o usuário tem alguma foto cadastrada
                        if (strcmp($this->session->userdata('user_foto'), "") == 0):
                            echo base_url('data-views/dashboard/dist/img/avatar0.png');
                        else:
                            //FIXIT padronizar 
                            echo $this->session->userdata('user_foto');
                        endif;
                        ?>  " class="img-circle" alt="User Image">
                            <p>
                                 <?php echo $this->session->userdata('user_name'); ?>
                                <small> <?php echo $this->session->userdata('entidade'); ?> </small>
                            </p>
                        </li>

                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>



                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('/dashboard/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>   

            </ul>
        </div>
    </nav>
</header>