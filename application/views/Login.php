<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->lang->line('title'); ?> </title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">


        <link rel="stylesheet" href="<?php echo base_url('data-views/login/css/style.css?v=2'); ?>">



        <style type="text/css">

        </style>


    </head>

    <body> 
      
        <div class="select_language" >


            <ul class="languagepicker roundborders">
                <a ><li><img src=""/>Language</li></a>
                <a href="<?php echo base_url('pt_BR/login'); ?>"><li><img src="http://i41.tinypic.com/zx4ity.jpg"/>Portuguese</li></a>
                <a href="<?php echo base_url('en/login'); ?>"><li><img src="http://i64.tinypic.com/fd60km.png"/>English</li></a>
            </ul>



        </div>


        <form method="post" action="<?php echo base_url($this->uri->segment(1).'/login/' . $this->uri->segment(3)); ?>" >
            <div class="wrap">

                <!--    <div class="avatar">
                        <img id="user_img" onchange="loadImg()" src="<?php echo base_url('/data-views/login/img/avatar.png'); ?>">
                    </div>  -->

                <p class="main_title"> Centro Escolar </p>

                <input type="text" name="username" value="<?php echo setValue('username'); ?>" placeholder="<?php echo $this->lang->line('placeholder_user'); ?>" >
                <div class="bar">
                    <i></i>
                </div>
                <input type="password" name="password" value="<?php
                echo setValue('password');
                ?>" placeholder="<?php echo $this->lang->line('placeholder_password'); ?>" >
                <a href="forgot" class="forgot_link"><?php echo $this->lang->line('recovery_pass'); ?></a>

                <div  class="entidadepicker-div" >
                    <ul class="roundborders entidadepicker" style="display: inline;  "> 
                        <a href="<?php echo base_url($this->uri->segment(1).'/login/administrador'); ?>"> <li  > <?php echo $this->lang->line('adm_login'); ?> </li> </a>
                        <a href="<?php echo base_url($this->uri->segment(1).'/login/professor'); ?>">  <li > <?php echo $this->lang->line('prof_login'); ?> </li> </a>
                        <a href="<?php echo base_url($this->uri->segment(1).'/login/aluno'); ?>"> <li > <?php echo $this->lang->line('alun_login'); ?> </li> </a>
                    </ul>
                </div>
           

                <button> <?php echo $this->lang->line('button_login'); ?> </button>
                <p class="validation_erros" > <?php echo $inform_login; ?> </p>
            </div>

        </form>
        <script src="<?php echo base_url('data-views/login/js/script.js'); ?>"></script>

    </body>
</html>
