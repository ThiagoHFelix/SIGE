<!DOCTYPE HTML>

<html lang="pt-BR">

    <head>

        <title> <?php echo $title; ?> </title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" media="screen" href="<?php echo base_url('/data-views/home/css/style.css?v='); ?>" />


    </head>


    <body>

        <div class="conteiner" >

            <header class="header">

                <div class="logo">
                    <p><?php echo $title_header; ?></p>
                </div>

                <div class="login" >

                    <a href=" <?php echo base_url('/login'); ?> ">   <input class="btn" type="submit" value="<?php echo $title_btn_login; ?>" name="login" /> </a>

                </div>


                <!-- Main Menu -->
                <nav  class="mainnav" >

                    <ul>

                        <li> <a href="#home"> <?php echo $menu_home; ?> </a></li>
                        <li> <a href="#info"> <?php echo $menu_info; ?> </a></li>
                        <li> <a href="#contact"> <?php echo $menu_contact; ?> </a></li>

                    </ul>

                </nav>


            </header>

            <div class="content" >

                <!-- Ancora -->
                <a name="home" id="home"></a>

                <div id="#home" class="content-welcome">



                    <p id="title-bigger"><?php echo $title_bigger; ?></p>
                    <p id="title-smaller"><?php echo $title_smaller; ?></p>


                </div>





            </div>

            <footer class="footer">

                <p> <?php echo $footer_message; ?> </p>

            </footer>

        </div>

    </body>


</html>
