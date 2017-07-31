
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('data-views/dashboard/dist/img/avatar0.png'); ?>       " class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $this->session->userdata('user_name'); ?></p>
                            <a href="<?php echo base_url($this->uri->segment(1).'/dashboard'); ?>"><i class="fa fa-user-circle text-success"></i> <?php echo $this->session->userdata('entidade'); ?> </a>
                        </div>
                    </div>
                    
                    
                    
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
                      
                        
                
                        <li class="treeview">
                            
                            <a href="#">
                                <i class="fa fa-navicon"></i>
                                <span> Gerenciamento </span>
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right "> Adm </span>
                                </span>
                            </a>
                            
                            <!-- GERENCIAR ENTIDADES -->
                            <ul class="treeview-menu">
                                
                                <!-- ADMINISTRADOR -->
                                <li><a href="<?php echo base_url('/manage/administrador'); ?>"><i class="fa fa-users"></i> Administrador </a></li>
                                <!-- PROFESSOR -->
                                <li><a href="#"><i class="fa fa-users"></i> Professor </a></li>
                                <!-- ALUNO -->
                                <li><a href="#"><i class="fa fa-users"></i> Aluno </a></li>
                               
                            </ul>
                            
                            
                           
                            
                            
                            
                        </li>
                        
                        
                     
                      
                </section>
                <!-- /.sidebar -->
            </aside>
