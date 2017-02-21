<?php
/**
* Plugin Name: Asking
* Plugin URI: http://mypluginuri.com/
* Description: Questionario con resulatado de productos
* Version: 1.0
* Author: Besign
* Author Besign
* License: A Asking license name e.g. GPL12
*/



add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );
function my_custom_fonts() {
  echo '<style>

        #toplevel_page_conasa-asking-settings ul.wp-submenu li:nth-child(3),
        #toplevel_page_conasa-asking-settings ul.wp-submenu li:nth-child(4),
        #toplevel_page_conasa-asking-settings ul.wp-submenu li:nth-child(5),
        #toplevel_page_conasa-asking-settings ul.wp-submenu li:nth-child(6),
        #toplevel_page_conasa-asking-settings ul.wp-submenu li:nth-child(7)
        {
            display: none !important;
        }
        .boton-sin-efecto{
            background-color: rgba(250, 235, 215, 0);
            border-color: rgba(127, 255, 212, 0);
            color: #0073AA;
        }

  </style>';
}
function custom_admin_js() {
    $url = site_url().'/wp-content/plugins/asking/public/js/asking.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}

function jquery_tabify() {
     $dir = site_url().'/wp-content/plugins/asking/public';
        wp_enqueue_script(
        'blocs',
        $dir . '/js/blocs.min.js',
        array( 'jquery' )
    );       
    wp_enqueue_script(
        'formHandler',
        $dir . '/js/formHandler.js',
        array( 'jquery' )
    );    

    wp_enqueue_script(
        'jqBootstrapValidation',
        $dir . '/js/jqBootstrapValidation.js',
        array( 'jquery' )
    );
    wp_enqueue_script(
        'jquery-2.1.0',
        $dir . '/js/jquery-2.1.0.min.js',
        array( 'jquery' )
    );    
    wp_enqueue_script(
        'asking',
        $dir . '/js/asking.js',
        array( 'jquery' )
    );

    /***/
       wp_enqueue_script(
        'bootstrap',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        array( 'jquery' )
    );
       wp_enqueue_script(
        'jquery',
        $dir . 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
        array( 'jquery' )
    );     
}

function add_newstyle_stylesheet() {
    $dir = site_url().'/wp-content/plugins/asking/public';
   wp_register_style(
        'newstyle',
        $dir . '/newstyle.css'
    );
    wp_enqueue_style( 'newstyle' );   

    wp_register_style(
        'home',
        $dir . '/home.css'
    );
    wp_enqueue_style( 'home' );    

    wp_register_style(
        'bootstrap-min',
         'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
    );
    wp_enqueue_style( 'bootstrap-min' );
}

function create_asking_short($atts) /**/
{
    extract(shortcode_atts(array(
                'id' => '0',
    ), $atts));

    $dirpublic = site_url().'/wp-content/plugins/asking/public';

    $aux2 = '1';
    //media_sideload_image($file, $post_id, $desc, $return); 
    global $wpdb;
    $aux =  "SELECT * FROM `".$wpdb->prefix.'shortcode`'." WHERE `id` = ".$id;
    $titulo = $wpdb->get_results( $aux, OBJECT ); 
    $titulo = get_object_vars($titulo[0]);
    $titulo = $titulo['titulo'];
    $aux = '1';
    echo '    <style>  
                 .carousel-inner > .item > img,
          .carousel-inner > .item > a > img {
              width: 40%;
              margin: auto;
          }
            #loading {
               display: none;
            }
            #loading.show-loading{
                display:block!important;
                width:100%!important;
                text-align:center!important;    
                height:80vh!important;
                top:40vh;
                position:fixed;
                z-index:10;
                
            }
            .fondoTransparente
            {
                /*Div que ocupa toda la pantalla*/
                position:absolute;
                top:0px;
                left:0px;
                width:100%;
                height:100%;
                background-color:#fff;
                /*IE*/
                filter: alpha(opacity=50);
                /*FireFox Opera*/
                opacity: .5;
            }
            .center
            {
                position: absolute;
                /*nos posicionamos en el centro del navegador*/
                top:50%;
                left:50%;
                /*determinamos una anchura*/
                width:400px;
                /*indicamos que el margen izquierdo, es la mitad de la anchura*/
                margin-left:-200px;
                /*determinamos una altura*/
                height:300px;
                /*indicamos que el margen superior, es la mitad de la altura*/
                margin-top:-150;
                border:1px solid #808080;
                background-color:#fff;
                padding:5px;
            }
</style>
          </style>

<div class="page-container" >
        <!-- bloc-0 -->
        <div class="bloc b-divider bg-center bgc-white l-bloc" >
            <div class="container bloc-lg">
                <div class="row voffset-lg bgc-halaya-ube" id="background-color-titulo" style="padding-bottom: 20px;" >
                    <div class="col-xs-12 col-md-8 col-md-offset-2 col-sm-12"><img class="center-block animSpeedLazy" src="'.$dirpublic.'/img/LOGOTIPODELNEGATIVO.png"  style="width: 200px;" />
                        <h1 class="text-center mg-lg tc-white">'.$titulo.'</h1>
                        <div class="text-center"><button id="empezar" class="btn btn-lg animSpeedLazy animLoop02 animDelay04 animated pulse btn-carrot-orange ">EMPEZAR</button></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bloc-0 END -->
<a class="bloc-button btn btn-d scrollToTop" onclick="scrollToTarget('.$aux2.')"><span class="fa fa-chevron-up"></span></a>
        <!-- ScrollToTop Button END-->
    </div>

          <div id="loading"><center><img src="../wp-content/plugins/asking/loading.gif"/><center></div>     
    
    <div id="inicioAsking" class="page-container">
    
<!-- bloc-0 -->


<div class="bloc bgc-white l-bloc " id="bloc-0" style="display:none;">
    <div class="container bloc-lg">
        <div class="row bgc-halaya-ube">
            <div class="col-sm-4 left-columm-asking">
                <h1 class="mg-md text-center tc-white">
                    Define <br>lo que quieres
                </h1>

                <img src="'.$dirpublic.'/img/LOGOTIPODELNEGATIVO.png" class="center-block" style="width: 100px;" />
            </div>
            <div class="col-sm-8">
                  <div id="productos-para-ti"></div>
                  <form action="" method="post">
                  <input type="hidden" name="type" value="resultado">
                  <div id="myTest" class="carousel slide" data-interval="500">


                    <!-- Wrapper for slides -->
                    <div class="carousel-inner " role="listbox">';
                        $aux =  "SELECT * FROM `".$wpdb->prefix.'preguntas`'." WHERE `shortcode_id` = ".$id;
                                $preguntas = $wpdb->get_results( $aux, OBJECT );   
                                $band = "active"; 

                        foreach ($preguntas as $pregunta ) {

                            $pregunta = get_object_vars($pregunta); 
                            $aux =  "SELECT * FROM `".$wpdb->prefix.'respuestas`'." WHERE `id_pregunta` = ".$pregunta['id'];
                            $respuestas = $wpdb->get_results( $aux, OBJECT );
                            if (sizeof($respuestas) > 0 ) 
                            {
                                
                            
                                echo '<div class="item '.$band.'">
                                          <div class="col-sm-2"></div>
                                                <div class="col-sm-8">
                                                    <div class="row">';
                                                        
                                                        echo '<h4><center><div class="col-sm-12">'.$pregunta['pregunta'].'</div></center></h4>';
                                                       
                                                        foreach ($respuestas as $respuesta) {
                                                                            $respuesta = get_object_vars($respuesta);
                                                                             echo '<input type="radio" name="pregunta_'.$pregunta['id'].'" value="'.$respuesta['value'].'" class="press-next" >'. $respuesta['respuesta'].'<br>';
                                                                          
                                                                         }  

                                                     echo '</div>
                                                 </div>
                                            <div class="col-sm-2"></div>

                                         </div> ';
                            }

                                         unset($band);
                        }
                    echo '
                        <div class="item last">
                            <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <h3> <center> Ingresa tu nombre y correo para ver tu resultado  </center> </h3>
                                        <div class="col-sm-12"></div>                           
                                        <div class="col-lg-6 col-md-6 col-sm-12"><input name="nombre" placeholder="Nombre" class="form-control" type="text" required></div>                           
                                        <div class="col-lg-6 col-md-6 col-sm-12"><input name="email" placeholder="Email@dominio.com" class="form-control" type="email" required></div>                           
                                        <br><br><br>
                                        <div class="col-sm-4"></div>                           
                                        
                                        <div class="col-sm-2">
                                            <button class="btn btn-lg animSpeedLazy animLoop02 animDelay04 pulse btn-carrot-orange animated" type="submit" name="cf-submitted"  id="cf-submitted"  value="Ver Resultados">
                                                Ver Resultados
                                            </button>
                                        </div>                           
                                        <div class="col-sm-5"></div>                           
                                     </div>
                                </div>
                            <div class="col-sm-2"></div>
                        </div>';

                   echo  '</div>

            </div>

        </div>
    </div>
</div>
</form>


<!-- bloc-0 END -->

<!-- ScrollToTop Button -->
<a class="bloc-button btn btn-d scrollToTop" onclick="scrollToTarget('.$aux2.')"><span class="fa fa-chevron-up"></span></a><!-- ScrollToTop Button END-->

</div>
<!-- Main container END -->
<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myTest").carousel("pause");
    
    // Enable Carousel Controls
    /*$(".left").click(function(){
               // $(".left").preventDefault();

        $("#myTest").carousel("prev");
    });*/
    $(".press-next").click(function(){
            // $(".right").preventDefault();

            $("#myTest").carousel("next");
        
    }); 

    $("#empezar").click(function(){
            document.getElementById("background-color-titulo").style.display="none";
            document.getElementById("bloc-0").style.display="inherit";
    });

    
    
        $("#cf-submitted").click(function(event){
        
        
        event.preventDefault();
        var data = $("form").serialize();
        console.log(data);
            $.ajax({
        type : "POST",
        url  : "../wp-content/plugins/asking/save.php",
        cache: false,
        data : data,
        beforeSend: function () {
            
                    $("#loading").addClass("show-loading"); //Agregamos la clase loading al body
                    $("body").addClass("fondoTransparente"); //Agregamos la clase loading al body
                },
        success :  function(data)
        {
           $("#loading").removeClass("show-loading"); //Quitamos la clase loading al body
            $("body").removeClass("fondoTransparente"); //Agregamos la clase loading al body
            document.getElementById("myTest").style.display="none";
          $("div#productos-para-ti").html(data);
              var scrollPos =  200;
                $(window).scrollTop(scrollPos);
          
        },
          complete: function() {
           // $("#loading").removeClass("show-loading"); //Quitamos la clase loading al body

           // $(".form-horizontal").focus();
            /*var scrollPos =  $(".form-horizontal").offset().top;
            $(window).scrollTop(scrollPos);*/
          }

        });
    });
});
    
</script>
        '; 
}




function create_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "preguntas";
    


    $sql = " CREATE TABLE $table_name(
          id int(11)  NOT NULL AUTO_INCREMENT,
          pregunta varchar(250) NOT NULL,
          shortcode_id int(11) NOT NULL,
          image varchar(250)  NULL ,
          INDEX shortcode_id (shortcode_id),
          PRIMARY KEY ( id ),
          FOREIGN KEY (shortcode_id) REFERENCES ".$wpdb->prefix.'shortcode'."(id) 
          ON DELETE CASCADE 
          ON UPDATE CASCADE

        ) ;"; 

     

    $table_name = $wpdb->prefix . "respuestas";
    $sql2 = " CREATE TABLE $table_name(
          id int(11)  NOT NULL AUTO_INCREMENT,
          id_pregunta int(11) NOT NULL,
          respuesta varchar(250) NOT NULL,
          value int(11) NOT NULL,
          relation_res int(11) NOT NULL,
          image varchar(250)  NULL ,
          INDEX id_pregunta (id_pregunta),
          PRIMARY KEY ( id ),
          FOREIGN KEY (id_pregunta) REFERENCES ".$wpdb->prefix.'preguntas'."(id) 
          ON DELETE CASCADE 
          ON UPDATE CASCADE
        ) ;";  

    $table_name = $wpdb->prefix . "shortcode";    
    $sql3 = " CREATE TABLE $table_name(
          id int(11)  NOT NULL AUTO_INCREMENT,
          shortcode varchar(250) NOT NULL,
          post_type varchar(50) NOT NULL,
          titulo varchar(100) NOT NULL,
          descripcion varchar(300) NOT NULL,
          pregunta_imagen enum('Si','No')  DEFAULT NULL,
          respuesta_imagen enum('Si','No') DEFAULT NULL,
          PRIMARY KEY ( id )

        ) ;";
    

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    dbDelta($sql3);
    dbDelta($sql);
    dbDelta($sql2);
   

}



function uninstall_table()
{
    global $wpdb; 
    $table_name = $wpdb->prefix . "preguntas";
    $sql = "DROP TABLE $table_name";
    $wpdb->query($sql);

    $table_name = $wpdb->prefix . "respuestas";
    $sql = "DROP TABLE $table_name";
    $wpdb->query($sql);

    $table_name = $wpdb->prefix . "shortcode"; 
    $sql = "DROP TABLE $table_name";
    $wpdb->query($sql);  
    
    
}
/*
 * Función para añadir una página al menú de administrador de wordpress
 */
function conasa_plugin_menu(){
    //Añade una página de menú a wordpress
    $dir = site_url().'/wp-content/plugins/asking';
    add_menu_page('Ajustes plugin Asking',                      //Título de la página
                    'Asking',                                   //Título del menú
                    'administrator',                            //Rol que puede acceder
                    'conasa-asking-settings',                   //Id de la página de opciones
                    'conasa_asking_page_settings',              //Función q pinta la página de Configuración d Plugin
                    'dashicons-admin-generic');                 //Icono del menú
    
    $edit     = add_submenu_page('conasa-asking-settings', 'Ajustes plugin Asking','Edit', 'manage_options', 'conasa-asking-edit', 'edit');
    $addnew   = add_submenu_page('conasa-asking-settings', 'Ajustes plugin Asking','Add', 'manage_options', 'conasa-asking-add', 'add');
    $delete   = add_submenu_page('conasa-asking-settings', 'Ajustes plugin Asking','Delete', 'manage_options', 'conasa-asking-delete', 'delete'); 

    $add_2   = add_submenu_page('conasa-asking-settings', 'Ajustes plugin Asking','add_2', 'manage_options', 'conasa-asking-add_2', 'add_2'); 

    $add_3   = add_submenu_page('conasa-asking-settings', 'Ajustes plugin Asking','add_3', 'manage_options', 'conasa-asking-add_3', 'add_3'); 


    
    add_action( 'load'. $edit,  'edit'  );
    add_action( 'load'.$addnew, 'add'   );
    add_action( 'load'.$delete, 'delete');
    add_action( 'load'.$add_2,  'add_2' );
    add_action( 'load'.$add_3 , 'add_3'  );
    
 }

function add_2(){ 
   
         $edit = site_url().'/wp-admin/admin.php?page=conasa-asking-edit';
      $id_shorcode = $_GET['id'];
      $pregunta = $_GET['type_data'];
      
      if(empty( $id_shorcode))
      {
        echo  "<h1>Debe selecionar un formulario</h1>";
        exit;
      }
    ?>

<form action="" method="POST" >

    <?php 
        global $wpdb;     
        if(empty($pregunta))
        {
            $dir = site_url().'/wp-admin/admin.php?page=conasa-asking-add_2&type_data=RESPUESTA&id=';     
            $shortcodes =  "SELECT * FROM `".$wpdb->prefix.'preguntas`'." WHERE `shortcode_id` = ".$id_shorcode;
        }
        else
        {
            $dir = site_url().'/wp-admin/admin.php?page=conasa-asking-add_3&id=';
             
            $shortcodes =  "SELECT * FROM `".$wpdb->prefix.'respuestas`'." WHERE `id_pregunta` = ".$id_shorcode;
        }    
        $shortcodes = $wpdb->get_results( $shortcodes, OBJECT );
        print_r($shortcodes);
    ?>
     <p>
        <input type="number" value="" class="regular-text process_custom_images" id="process_custom_images" name="" max="" min="1" step="1">
        <button class="set_custom_images button" onclick="loadimage()">Set Image ID</button>
    </p>

   <table class="wp-list-table widefat fixed striped posts" >
       
        <thead>
            <th>#</th>
            <?php 
                if(empty($pregunta))
                {
                    echo   '<th>ID</th>
                            <th>PREGUNTA</th>                   
                            <th>CONFIGURACION</th>';            
                }
                else
                {
                    echo   '<th>ID</th>
                            <th>VALOR</th>
                            <th>RESPUESTA</th>                   
                            <th>CONFIGURACION</th>';           
                }
                ?>


        </thead>
        <tbody>
            <?php 

               

                
                foreach ($shortcodes as $shortcode ) {
                    $shortcode = get_object_vars($shortcode);
                    $var = " onclick=\"crud('eliminar',".$shortcode['id'].")\"";
                    if(empty($pregunta)){
                        echo    "<tr>
                                    <td><input type='checkbox' name='ids[]' value='".$shortcode['id']."'></td>
                                    <td>".$shortcode['id']."</td>
                                    <td>".$shortcode['pregunta']."</td>
                                    <td>
                                        <a href='".$dir.$shortcode['id'].'&accion=edit'."' >Editar &emsp;&emsp;</a>                                    
                                        <input  " .$var. " name='accion' class='boton-sin-efecto' type='submit' value='Eliminar'>                                    
                                        
                                        <a href='".$dir.$shortcode['id'].'&accion=edit'."' > Agregar Respuestas &emsp; &emsp; </a>
                                    </td>
                                
                                </tr> ";
                    }
                    else{

                        echo    "<tr>
                                    <td><input type='checkbox' name='ids[]' value='".$shortcode['id']."'></td>
                                    <td>".$shortcode['id']."</td>
                                    <td>".$shortcode['value']."</td>
                                    <td>".$shortcode['respuesta']."</td>
                                    <td>
                                        <a href='".$dir.$shortcode['id'].'&accion=edit'."' >Editar &emsp;&emsp;</a>                                    
                                        <input  " .$var. " name='accion' class='boton-sin-efecto' type='submit' value='Eliminar'>
                                        
                                        <a href='".$dir.$shortcode['id']."' >Agregar Valor &emsp; &emsp;</a>
                                    </td>
                                </tr> ";
                    }
                }
            ?>
        </tbody>

  </table>
   <br><br>

  <div class="container" id="questions-all">
        <?php if(empty($pregunta))
        {
            echo '<input type="hidden" name="type" value="preguntas">';
        }
        else
        {
            echo '<input type="hidden" name="type" value="respuesta">';
        }?>
        
       
            <input type="hidden" name="id" value="<?php echo  $id_shorcode ?>">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div id="dashboard_right_now" class="postbox ">
                        <h2 class="hndle ui-sortable-handle">
                            <span>
                                <?php if(empty($pregunta))
                                {
                                    echo 'Agregar Preguntas';
                                }
                                else
                                {
                                    echo 'Agregar Respuestas';
                                }?>
                            </span>
                        </h2>
                        <div class="inside">
                            <div class="main">
                                <ul>
                                    <li class="post-count">
                                        <table class="table table-hover" id="worked">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <button type="button" class="btn btn-blue add-row-question"><?php if(empty($pregunta))
                                                        {
                                                            echo 'Nueva Pregunta';
                                                        }
                                                        else
                                                        {
                                                            echo 'Nueva Respuesta';
                                                        }?>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input name="answer_1[]" placeholder="Escriba una pregunta" class="form-control" type="text">
                                                        
                                                    </td>
                                                </tr>                     
                                            </tbody>
                                        </table>
                                    </li>
                               </ul>
                                <p id="wp-version-message">
 
                                    <button type="submit" id="preguntas" name="preguntas" class="button button-primary" style="margin-top: -10px;" onclick="submitAsking('preguntas')">
                                    Guardar
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
     </div>
    </form>


    <div id="preguntas_salvadas"></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script type="text/javascript">
     $(document).ready(function(){
             var count_question = 1;
             var countanswer   = 0;   

             
            $('.new-question .add-question').click(function () {
                    countanswer++;
                var template = '<div class="new-question-set"></div>';
                $('#worked tbody').append(template);
            });
            
            
            // Control de respuestas
            $('#worked .add-row-question').click(function () {
                    countanswer++;
                var template = '<tr><td><input name="answer_'+count_question+'[]" class="form-control" placeholder="Escriba una respuesta" type="text"><button type="button" class="btn btn-danger delete-row-question">-</button></td></tr>';
                $('#worked tbody').append(template);
            });
         
            $('#worked').on('click', '.delete-row-question', function () {
                $(this).parent().parent().remove();
                countanswer--;
            }); 

     });
     </script>
     <?php
}

function add_3(){ 

    global $wpdb;
    $accion = empty($_GET['accion']);
    

    $aux  = "SELECT r.`id`,r.`id_pregunta`,p.`pregunta`,r.`respuesta`, s.`post_type`,r.`value` FROM `".$wpdb->prefix.'respuestas`'." AS r,`".$wpdb->prefix.'preguntas`'." AS p, `".$wpdb->prefix.'shortcode`'." AS s WHERE p.`id` = r.`id_pregunta` AND p.`shortcode_id` = s.`id` AND r.`id` =". $_GET['id'];
   
    $pregunta = $wpdb->get_results( $aux, OBJECT );
    $pregunta = get_object_vars($pregunta[0]);

    $aux2 =  "SELECT `ID`, `post_title` FROM `".$wpdb->prefix.'posts`'." WHERE `post_status` = 'publish' AND `post_type` = '".$pregunta['post_type']."'";
    $posts = $wpdb->get_results( $aux2, OBJECT );
    $index = 0;

    ?>
    <style type="text/css">
        #respuestas tr td [type=text] {
            width: 600px;
            margin-top: 50px;
            margin-bottom: 20px;
        }        
        #respuestas tr td [type=radio] {
            margin-top: 10px;
            margin-bottom: 10px;
        }       
    </style>
    <form action="" method="post"> 
        <input type="hidden" name="id" value="<?php echo $pregunta['id']; ?>">
        <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['id_pregunta']; ?>">
        <input type="hidden" name="type" value="value_respuesta">
          <div id="dashboard_right_now" class="postbox ">
                        <h2 class="hndle ui-sortable-handle">
                            <span>Agregar Respuestas</span>
                        </h2>
                        <div class="inside">
                            <div class="main">
                                <ul>
                                    <li class="post-count">

                                     

                                        <table class="table table-hover respuestas" id="worked">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: left;">
                                                        <input name="<?php  echo 'preguntas'.$index.'_'.$i; ?>" value="<?php echo $pregunta['pregunta']; ?>" class="form-control" type="text" <?php if($accion){echo "disabled";}?> >
                                                        <?php if($accion){?>
                                                            <input name="<?php  echo 'preguntas'.$index.'_'.$i; ?>" value="<?php echo $pregunta['pregunta']; ?>" class="form-control" type="hidden" > <br>

                                                        <?php  }?>
                                                        
                                                        
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="respuestas">
                                             
                                                    <tr>
                                                        <td>
                                                        
                                                            <input name="<?php  echo 'respuestas'.$index.'_'.$i; ?>" value="<?php echo $pregunta['respuesta']; ?>" class="form-control" type="text" <?php if($accion){echo "disabled";}?> ><br> 
                                                            <?php if($accion){?>
                                                                <input name="<?php  echo 'respuestas'.$index.'_'.$i; ?>" value="<?php echo $pregunta['respuesta']; ?>" class="form-control" type="hidden"><br>

                                                            <?php  }?>                                                         
                                                            <?php  

                                                                $i= 1;
                                                                foreach ($posts as $post) {
                                                                     $post = get_object_vars($post);
                                                                      if($i==1){
                                                                        if($accion)
                                                                        {
                                                                            $i ++;
                                                                            $band = 'checked="checked"';
                                                                        }
                                                                        elseif ($post['ID'] == $pregunta['value']) 
                                                                         {
                                                                            $i ++;
                                                                            $band = 'checked="checked"';
                                                                         } 

                                                                      }

                                                                     echo '<input type="radio" name="value_post" value="'.$post['ID'].'" '.$band.'>'.$post['post_title'].'<br>';
                                                                     if($band=='checked="checked"'){
                                                                        unset($band);
                                                                     }
                                                                }

                                                            ?>

                                                        </td>
                                                   </tr>                                                       
                                            </tbody>
                                        </table>
                                    </li>
                               </ul>
                               <br>
                               <br>
                               <br>
                             
                                <p id="wp-version-message">
                                    <button type="submit" id="preguntas" name="preguntas" class="button button-primary" style="margin-top: -10px;" onclick="submitAsking('respuesta_value',<?php echo $pregunta['id_pregunta']; ?>)">
                                        Guardar
                                    </button> 
                                </p>
                            </div>
                        </div>
                    </div>   



    </form>

                    <!--div id="preguntas_salvadas"></div-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script type="text/javascript">
     $(document).ready(function(){
                     
               $("#preguntas").click(function(event){                 
                    
                   // event.preventDefault();
                    var data = $("form").serialize();
             


                    console.log(data);
                        $.ajax({
                    type : "POST",
                    url  : "../wp-content/plugins/asking/save.php",
                    cache: false,
                    data : data,
                    
                    success :  function(data)
                    {
                        
                        document.getElementById("dashboard_right_now").style.display="none";
                        $("div#preguntas_salvadas").html(data);
                      
                      
                    },
                      complete: function() {

                      }

                    });
                });
       

     });
     </script>
                    <?php

}


function add(){
   $dir = site_url().'/wp-admin/admin.php?page=conasa-asking-add_2&type=';
   admin_url( 'admin.php?page=wpcf7&post='  );
   
   $id = $_GET['id'];
   $status = empty($id);
   if(!$status)
   {
       global $wpdb;
       $aux2 =  "SELECT * FROM `".$wpdb->prefix.'shortcode`'." WHERE `id` = ".$id;
       $form = $wpdb->get_results( $aux2, OBJECT );
       $form = get_object_vars($form[0]);
      
   } 


 ?>   
    <style type="text/css">
        #dashboard_right_now li a:before, #dashboard_right_now li span:before, .welcome-panel .welcome-icon:before {
            display: none;
        }
        .post_type_choice{
            margin-top: 50px;
        }
    </style>
    
<form id="usrform" method="post">   
    <input type="hidden" name="type" value="configuracion"> 
    <div id="normal-sortables" class="meta-box-sortables ui-sortable  post_type_choice">
        <div id="dashboard_right_now" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Eligir tipo de contenido</span>
                </h2>
            <div class="inside">
                <div class="main">
                     <ul>
                        <?php 
                             $args = array(
                                  'public'   => true,
                                   '_builtin' => false
                                );

                                $output = 'names'; // names or objects, note names is the default
                                $operator = 'and'; // 'and' or 'or'

                                $i= 1;

                                $post_types = get_post_types( $args, $output, $operator ); 
                                foreach ( $post_types  as $post_type ) {
                                        if($status)
                                        {
                                            $i ++;
                                            $band = 'checked="checked"';
                                        }
                                        elseif ($post['ID'] == $pregunta['value']) 
                                        {
                                            $i ++;
                                            $band = ' checked="checked" ';
                                        } 
                                        echo '<li>';
                                            
                                            echo '  <input type="radio"  name="type_of_post" value="'.$post_type.'"'.$band.'> '.$post_type;
                                        echo '</li>';
                                        
                                        if(!empty($band)){
                                            unset($band);
                                        }
                                }

                       ?>                      
                    </ul>
                </div>
            </div>
        </div>
    </div>        

    <div id="normal-sortables" class="meta-box-sortables ui-sortable  post_type_choice">
        <div id="dashboard_right_now" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Informacion del formulario </span>
                </h2>
            <div class="inside">
                <div class="main">
                     <ul>
                        
                        <li>
                            <label>Titulo</label><br><br>
                            <input type="text" name="titulo" <?php if(!$status){ echo "value='".$form['titulo']."'"; }else{echo 'placeholder="titulo"';} ?> >
                        </li>                        

                        <li>
                            <label>Descripcion </label><br><br>
                            <textarea rows="4" cols="50" name="comment" form="usrform" <?php if($status){ echo 'placeholder="Descripcion..."';}?> > <?php if(!$status){ 
                                echo $form['descripcion'];
                                }?></textarea>
                        </li>                        

                        <li>
                            <label>Preguntas con imagenes </label> <br><br>
                            <input type="radio" name="pregunta_imagenes" value="Si" <?php if(!$status){ 
                                if($form['pregunta_imagen']=='Si'){echo 'checked="checked"'; }
                                }?> >si
                            &emsp;
                            <input type="radio" name="pregunta_imagenes" value="No" 
                            <?php if(!$status)
                                  { 
                                    if($form['pregunta_imagen']=='No')
                                    {
                                        echo 'checked="checked"'; 
                                    }
                                   }
                                   else{echo 'checked="checked"';}
                                ?> >no 
                        </li>
                        <li>
                            <label>Respuestas con imagenes </label> <br><br>
                            <input type="radio" name="respuestas_imagenes" value="Si" <?php if(!$status){ 
                                if($form['respuesta_imagen']=='Si'){echo 'checked="checked"'; }
                                }?> >si
                            &emsp;
                            <input type="radio" name="respuestas_imagenes" value="No"  <?php if(!$status){ 
                                if($form['respuesta_imagen']=='No'){echo 'checked="checked"'; }
                                }else{echo 'checked="checked"';}
                                ?> >no 
                        </li>
                        <li></li>
                        <li style="text-align: right;">
                        <?php if($status){ ?>
                                <button type="submit" id="preguntas" name="preguntas" class="button button-primary" style="margin-top: -10px;" onclick="submitAsking('configuracion')">
                                    Guardar
                                </button>
                        <?php }else{ ?>
                                  <button type="submit" id="preguntas" name="preguntas" class="button button-primary" style="margin-top: -10px;" onclick="crud('editar',<?php echo  $form['id']; ?>)">
                                    Guardar
                                </button>   
                        <?php } ?>

                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>   
</form> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php
} 
function edit(){
    echo "<h1>hola vamos a editar</h1>";
    global $wpdb; 
    $type = $_GET['type'];
    

} 
function delete(){}

/*
    * Función que pinta la página de configuración del plugin
*/

function conasa_asking_page_settings(){

    global $wpdb;
    $shortcodes = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix.'shortcode', OBJECT );

    $dir = site_url().'/wp-admin/admin.php?page=conasa-asking-add_2&id=';
    $dir2 = site_url().'/wp-admin/admin.php?page=conasa-asking-add';

    ?>
    <h1>Asking</h1>
    <a class="button button-primary" href="<?php echo $dir2; ?>">Agregar Nuevo</a>
    <br>
    <br>





   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>     
    <form action="" method="POST" >
   <table class="wp-list-table widefat fixed striped posts" >
        <thead>
            <th>#</th>
            <th>ID</th>
            <th>TITULO</th>
            <th>SHORTCODE</th>
            <th>CONFIGURACION</th>
        </thead>
        <tbody>
            <?php 
                foreach ($shortcodes as $shortcode ) {
                    $shortcode = get_object_vars($shortcode);
                     $var = " onclick=\"crud('eliminar',".$shortcode['id'].")\"";
                    echo    "<tr>
                                <td><input type='checkbox' name='ids[]' value='".$shortcode['id']."'></td>
                                <td>".$shortcode['id']."</td>
                                <td> ".$shortcode['titulo']."</td>
                                <td> [Asking ID=". $shortcode['id']."]  </td>
                                <td>
                                    <a href='".$dir2.'&id='.$shortcode['id']."' >Editar &emsp;&emsp;</a>                                    
                                    <input  " .$var. " name='accion' class='boton-sin-efecto' type='submit' value='Eliminar'> 
                                    
                                    
                                    <a href='".$dir.$shortcode['id'].'&id='.$shortcode['id']."' >Agregar Preguntas &emsp; &emsp;</a>
                                    </td>
                            </tr> ";
                }
            ?>
        </tbody>
    </table>
        <input type="hidden" name="type" value="formulario">
        
    </form>

    
<?php

}

add_action('admin_head', 'my_custom_fonts');
add_action('admin_footer', 'custom_admin_js');
add_action( 'wp_enqueue_scripts', 'jquery_tabify' );
add_action( 'wp_enqueue_scripts', 'add_newstyle_stylesheet' );
add_shortcode('Asking', 'create_asking_short');
add_action('admin_menu','conasa_plugin_menu');
register_activation_hook( __FILE__, 'create_table'  );
register_deactivation_hook( __FILE__, 'uninstall_table'  );

