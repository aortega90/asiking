<?php
/**
* Plugin Name: Asking
* Plugin URI: http://mypluginuri.com/
* Description: Questionario con resulatado de productos
* Version: 1.0
* Author: Besign
* Author Besign
* License: A Asking
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
        .bottom-space{
            height: 40px;
        }
        .hiden-load{
            display:none;
        }
        .show-load{
            display: inline-block;
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
    $datos  = $titulo;
    //print_r($datos);
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
                label > input{ /* HIDE RADIO */
                  visibility: hidden; /* Makes input not-clickable */
                  position: absolute; /* Remove input from document flow */
                }
                label > input + img{ /* IMAGE STYLES */
                  cursor:pointer;
                  border:2px solid transparent;
                }
                label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
                  border:2px solid #f00;
                }                

                label > input + div{ /* IMAGE STYLES */
                  cursor:pointer;
                  border:2px solid transparent;
                }
                label > input:checked + div{ /* (RADIO CHECKED) IMAGE STYLES */
                  border:2px solid #f00;
                }
                h1,h2,h3,h4,h5,h6,p,div,label,input{
                    color:#7e7b7d;
                }
                .btn-lg{
                        border: 1px solid #7e7b7d;
                            text-align: center;
                }
                .bgc-halaya-ube, #background-color-titulo{
                    background-color:#fff;
                }

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
                    '.$datos["descripcion_lateral"].'
                </h1>

                <img src="'.$dirpublic.'/img/LOGOTIPODELNEGATIVO.png" class="center-block" style="width: 100px;" />
            </div>
            <div class="col-sm-8">
                  <div id="productos-para-ti"></div>
                  <form action="" method="post" class="form">
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
                                        <div class="row">
                                          <div class="col-sm-2"></div>
                                                <div class="col-sm-8">
                                                    ';
                                                    
                                                    if($pregunta['pregunta_imagen']=='Si'){
                                                        $url_pregunta = get_post($pregunta['image'],ARRAY_A) ;
                                                        if(empty($url_pregunta)){
                                                            $url_pregunta = $dirpublic.'/img/No-image-found.jpg';
                                                        }
                                                        else
                                                        {
                                                             $url_pregunta = (string)$url_pregunta['guid'];
                                                        }
                                                        echo "<center><img src='".$url_pregunta."' ></center>";
                                                    }
                                                    

                                                        echo '<h4><div class="row"><center><div class="col-sm-12">'.$pregunta['pregunta'].'</div></center></div></h4>';
                                                       
                                                       if($pregunta['text_extra']=='No'){
                                                                        $class_next = 'press-next';
                                                        }
                                                        echo '<div class="row"> ';
                                                        
                                                                foreach ($respuestas as $respuesta) {
                                                                
                                                                            $respuesta = get_object_vars($respuesta);

                                                                             if($pregunta['respuesta_imagen']=='Si'){
                                                                                $url_respuesta = get_post($respuesta['image'],ARRAY_A) ;
                                                                                if(empty($url_respuesta)){
                                                                                    $url_respuesta = $dirpublic.'/img/No-image-found.jpg';
                                                                                }
                                                                                else
                                                                                {
                                                                                     $url_respuesta = (string)$url_respuesta['guid'];
                                                                                }
                                                                                echo '<div class="col-md-6 col-xs-12"> 
                                                                                     
                                                                                        <label>
                                                                                            <input type="radio" name="pregunta_'.$pregunta['id'].'" value="'.$respuesta['value'].'" />
                                                                                            <img src="'.$url_respuesta.'" class="img-responsive btn-lg '.$class_next.'">
                                                                                        </label>



                                                                                     </div>';
                                                                            }
                                                                            else{
                                                                                echo '<div class="col-md-6 col-xs-12"> 

                                                                                            
                                                                                        <label>
                                                                                            <input type="radio" name="pregunta_'.$pregunta['id'].'" value="'.$pregunta['value'].'" />
                                                                                            <div class="btn-lg '.$class_next.'">'.$respuesta['respuesta'].'</div>
                                                                                        </label>

                                                                                     </div>';

                                                                            }
                                                                          
                                                                }  
                                                        echo '</div>';
                                                                   if($pregunta['text_extra']=='Si'){
                                                                        echo   '<div class="form-group col-md-12 text-area-style"> <textarea class="form-control"  name="comment" form="usrform"></textarea></div>';
                                                                        echo '<center>  <button name="pregunta_'.$pregunta['id'].'" class="press-next btn-lg" >Siguiente </button><center><br> ';
                                                                   }
                                                                   unset($class_next);

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
          pregunta_imagen enum('Si','No')  DEFAULT NULL,
          respuesta_imagen enum('Si','No') DEFAULT NULL,          
          text_extra enum('Si','No') DEFAULT NULL,       
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
          post_type varchar(50) NOT NULL,
          titulo varchar(150) NOT NULL,
          descripcion varchar(300) NOT NULL,
          descripcion_lateral varchar(300) NOT NULL,

          PRIMARY KEY ( id )

        ) ;";    

    $table_name = $wpdb->prefix . "usuarios";    
    $sql4 = " CREATE TABLE $table_name(
          id int(11)  NOT NULL AUTO_INCREMENT,
          name  varchar(100) NOT NULL,
          email varchar(100) NOT NULL,
          PRIMARY KEY ( id )

        ) ;";
    

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    dbDelta($sql3);
    dbDelta($sql);
    dbDelta($sql2);
    dbDelta($sql4);
   

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

    $table_name = $wpdb->prefix . "usuarios"; 
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


    add_action( 'load'.$edit,  'edit'  );
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
            $image      =  "SELECT s.`pregunta_imagen` FROM `".$wpdb->prefix.'shortcode`'." as s WHERE `id` = ".$id_shorcode; 
            $aux_ ='pregunta_imagen';
        }
        else
        {
            $dir = site_url().'/wp-admin/admin.php?page=conasa-asking-add_3&id=';   
            $shortcodes =  "SELECT * FROM `".$wpdb->prefix.'respuestas`'." WHERE `id_pregunta` = ".$id_shorcode;
            $image      =  "SELECT  p.`respuesta_imagen` FROM `".$wpdb->prefix.'preguntas`'." as p WHERE p.`id` = ".$id_shorcode;
            
            $aux_ ='respuesta_imagen';
        }    

        $shortcodes = $wpdb->get_results( $shortcodes, OBJECT );
        $image      = $wpdb->get_results( $image, OBJECT );
        $image      = get_object_vars($image[0]);
        $image      = $image[$aux_];
        echo $image.'<br>';

    ?>

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
            echo '<input type="hidden" name="type" id="type" value="preguntas">';
        }
        else
        {
            echo '<input type="hidden" name="type" id="type" value="respuesta">';
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
                                        <table class="table table-hover" id="worked" style="width: 1000px;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <button type="button" <?php if($image == 'Si'){echo 'value="Yes"';  }?> 
                                                        id="botton-less" class="btn btn-blue add-row-question"><?php if(empty($pregunta))
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
                                                        <br><label><?php if(empty($pregunta))
                                                        {
                                                            echo 'Pregunta';
                                                        }
                                                        else
                                                        {
                                                            echo 'Respuesta';
                                                        }?></label> <br><br>
                                                    <input name="answer_1[]" placeholder="Escriba una <?php if(empty($pregunta)){echo 'Pregunta';}else{echo 'Respuesta';}?>" class="form-control" type="text">&emsp;<br>
                                                        <?php if(empty($pregunta))
                                                        {?>
                                                                <label>Pregunta con imagenes </label> <br><br>
                                                                    <input type="radio" id="pregunta_imagenes_1" name="pregunta_imagenes_1" value="Si" onclick="loadimage_input(1,'Si')" checked="checked">Si&emsp;
                                                                    <input type="radio" id="pregunta_imagenes_1" name="pregunta_imagenes_1" onclick="loadimage_input(1,'No')" value="No" >No<br>

                                                                <label>Respuestas con imagenes </label> <br><br>
                                                                        <input type="radio"  name="respuesta_imagenes_1" value="Si" checked="checked" >Si&emsp;
                                                                        <input type="radio"  name="respuesta_imagenes_1" value="No" >No<br>

                                                                <label>Texto complementario en la respuesta </label> <br><br>
                                                                        <input type="radio" name="texto_1" value="Si" checked="checked" >Si&emsp;
                                                                        <input type="radio" name="texto_1" value="No" >No<br><br>
                                                        <?php } ?>



                                                       

                                                        <?php if($image == 'Si'){ ?>
                                                            <div id="load_image_1" class="">
                                                                <input type="number" value="" class="regular-text process_custom_images" id="process_custom_images" name="image_1[]" max="" min="1" step="1">
                                                                <button class="set_custom_images button" onclick="loadimage()">Imagen</button>
                                                            </div>

                                                        <?php }?>
                                                        <div class="bottom-space"></div>
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
             var countanswer   = 1;   
             var elem =  $("#botton-less").attr("value");
             var type =  $("#type").attr("value");
             
            $('.new-question .add-question').click(function () {
                    countanswer++;
                var template = '<div class="new-question-set"></div>';
                $('#worked tbody').append(template);
            });
            
            
            // Control de respuestas
             $('#worked .add-row-question').click(function () {
                    countanswer++;
                    var yes ='"Si"';
                    var not = '"No"';
                
                if(type =='preguntas')
                {
                   
                   var template = '<tr><td><label>Pregunta</label><br><input name="answer_1[]" class="form-control" placeholder="Escriba una pregunta" type="text">&emsp;'
                        template = template + '<br><label>Pregunta con imagenes </label> <br><br><input type="radio" id="pregunta_imagenes_'+countanswer+'" name="pregunta_imagenes_'+countanswer+'" value="Si" checked="checked" onclick="loadimage_input('+countanswer+',`Si`)" >Si&emsp; <input type="radio" id="pregunta_imagenes_'+countanswer+'" name="pregunta_imagenes_'+countanswer+'" value="No"  onclick="loadimage_input('+countanswer+',`No`)" >No<br><label>Respuestas con imagenes </label> <br><br><input type="radio" name="respuesta_imagenes_'+countanswer+'" value="Si" checked="checked" >Si&emsp;<input type="radio" name="respuesta_imagenes_'+countanswer+'" value="No" >No<br><label>Texto complementario en la respuesta </label> <br><br><input type="radio" name="texto_'+countanswer+'" value="Si" checked="checked">Si&emsp;<input type="radio" name="texto_'+countanswer+'" value="No" >No<br><br>';
                }
                else{
                    var template = '<tr><td><label>Respuesta</label><br><input name="answer_1[]" class="form-control" placeholder="Escriba una respuesta" type="text">&emsp;'
                }
                if(elem == 'Yes')
                {
                    template = template + '<div id="load_image_'+countanswer+'" class="" ><input type="number" value="" class="regular-text process_custom_images" id="process_custom_images" name="image_1[]" max="" min="1" step="1"><button class="set_custom_images button" onclick="loadimage()">Imagen</button></div>';
                } 
                   template = template + '<br><button type="button" class="btn btn-danger delete-row-question">  BORRAR  </button><div class="bottom-space"></div></td></tr>';
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
    $aux  = "SELECT r.`id`,r.`id_pregunta`,p.`pregunta`,r.`respuesta`, s.`post_type`,r.`value`, p.`pregunta_imagen`, p.`respuesta_imagen`, p.`text_extra` ,r.`image` AS `r_image`,  p.`image` AS `p_image`  FROM `".$wpdb->prefix.'respuestas`'." AS r,`".$wpdb->prefix.'preguntas`'." AS p, `".$wpdb->prefix.'shortcode`'." AS s WHERE p.`id` = r.`id_pregunta` AND p.`shortcode_id` = s.`id` AND r.`id` =". $_GET['id'];  
    $pregunta = $wpdb->get_results( $aux, OBJECT );
    $pregunta = get_object_vars($pregunta[0]);
    //print_r($pregunta);
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
                            <span><?php  if($accion){echo 'Agregar Respuestas';}else{echo 'Editar Contenido';}?></span>
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
                                                           
                                                                if($accion)
                                                                {
                                                                    echo '<input type="radio" name="value_post" value="5" checked="checked" >Correcta<br>';
                                                                    echo '<input type="radio" name="value_post" value="0" >Incorrecta<br>';
                                                                }
                                                                else
                                                                {
                                                                    if(empty($pregunta['value']))
                                                                    {
                                                                        if($pregunta['value']==5)
                                                                        {
                                                                            echo '<input type="radio" name="value_post" value="5" checked="checked" >Correcta<br>';
                                                                            echo '<input type="radio" name="value_post" value="0" >Incorrecta<br>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<input type="radio" name="value_post" value="5"  >Correcta<br>';
                                                                            echo '<input type="radio" name="value_post" value="0" checked="checked" >Incorrecta<br>';    
                                                                        }                                                                    
                                                                    
                                                                        
                                                                 }

                                                                        if($pregunta['pregunta_imagen']=='Si')
                                                                        {
                                                                            echo '<label>Pregunta con imagenes </label> <br><br>';
                                                                            echo '<input type="radio" id="pregunta_imagenes_1" name="pregunta_imagenes_1" value="Si" checked="checked" onclick="loadimage_input(1,`Si`)">Si&emsp;';
                                                                            echo '<input type="radio" id="pregunta_imagenes_1" name="pregunta_imagenes_1" value="No" onclick="loadimage_input(1,`No`)">No<br>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<label>Pregunta con imagenes </label> <br><br>';
                                                                            echo '<input type="radio" id="pregunta_imagenes_1" name="pregunta_imagenes_1" value="Si" onclick="loadimage_input(1,`Si`)">Si&emsp;';
                                                                            echo '<input type="radio" id="pregunta_imagenes_1" name="pregunta_imagenes_1" value="No" checked="checked" onclick="loadimage_input(1,`No`)" >No<br>';  
                                                                            $class =  'hiden-load';
                                                                        } 

                                                                        if($pregunta['respuesta_imagen']=='Si')
                                                                        {
                                                                            echo '<label>Respuestas con imagenes</label> <br><br>';
                                                                            echo '<input type="radio"  name="respuesta_imagenes_1"  value="Si" checked="checked" onclick="loadimage_input(2,`Si`)">Si&emsp;';
                                                                            echo '<input type="radio"  name="respuesta_imagenes_1"  value="No" onclick="loadimage_input(2,`No`)" >No<br>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<label>Respuestas con imagenes</label> <br><br>';
                                                                            echo '<input type="radio"  name="respuesta_imagenes_1" value="Si" checked="checked" onclick="loadimage_input(2,`Si`)" >Si&emsp;';
                                                                            echo '<input type="radio"  name="respuesta_imagenes_1" value="No" onclick="loadimage_input(2,`No`)" >No<br>';   
                                                                            $class =  'hiden-load'; 
                                                                        }                                                                         

                                                                        if($pregunta['text_extra']=='Si')
                                                                        {
                                                                            echo '<label>Texto complementario en la respuesta </label> <br><br>';
                                                                            echo '<input type="radio" name="texto_1" value="Si" checked="checked">Si&emsp;';
                                                                            echo '<input type="radio" name="texto_1" value="No" >No<br>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<label>Texto complementario en la respuesta </label> <br><br>';
                                                                            echo '<input type="radio" name="texto_1" value="Si" checked="checked" >Si&emsp;';
                                                                            echo '<input type="radio" name="texto_1" value="No" >No<br><br>';    
                                                                        } 


                                                                }    
                                                           

                                                            ?>

                                                        </td>
                                                   </tr> 
                                                   <tr>
                                                       <td>
                                                           <?php if(!$accion)
                                                    
                                                           {?>          <div id="load_image_1" class="<?php echo $class ?>">
                                                                            <strong><p>Imagen de preguntas</p></strong><br>
                                                                             <input type="number"  class="regular-text process_custom_images" id="process_custom_images" name="image_p" max="" min="1" step="1" value="<?php echo intval($pregunta['p_image']); ?>" >
                                                                            <button class="set_custom_images button" onclick="loadimage()">Imagen</button>
                                                                         </div>
                                                                            
                                                                         <div id="load_image_2" class="<?php echo $class ?>">
                                                                             <strong><p>Imagen de respuesa</p></strong><br>
                                                                             <input type="number"  class="regular-text process_custom_images" id="process_custom_images" name="image_r" max="" min="1" step="1" value="<?php echo intval($pregunta['r_image']) ; ?>" >
                                                                             <button class="set_custom_images button" onclick="loadimage()">Imagen</button>
                                                                         </div>
                                                                         


                                                               <?php 

                                                            }?>

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
<div id="preguntas_salvadas"></div>
    <input type="hidden" name="type" value="configuracion"> 
    <div id="normal-sortables" class="meta-box-sortables ui-sortable  post_type_choice">
        <div id="dashboard_right_now" class="postbox ">
                <h2 class="hndle ui-sortable-handle">
                    <span>Id de la respuesta correcta </span>
                </h2>
            <div class="inside">
                <div class="main">
                     <ul>
                        <?php 
                              echo '<li>';
                                    echo '  <input type="text"  name="type_of_post" placeholder="Example: 13"> ';
                              echo '</li>';
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
                        <li style="height: 100px;"></li>
                        <li>
                            <label>Descripcion </label><br><br>
                            <textarea rows="4" cols="50" name="comment" form="usrform" <?php if($status){ echo 'placeholder="Descripcion..."';}?> > <?php if(!$status){ 
                                echo $form['descripcion'];
                                }?></textarea>
                        </li>                         

                        <li>
                            <label>Descripcion lateral del tema </label><br><br>
                            <textarea rows="4" cols="50" name="comment_lateral" form="usrform" <?php if($status){ echo 'placeholder="Descripcion..."';}?> > <?php if(!$status){ 
                                echo $form['descripcion_lateral'];
                                }?></textarea>
                        </li>                        
                        <li></li>
                   
                        <li>
                       
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

