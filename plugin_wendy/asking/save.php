
<?php

	
	require_once('../../../wp-config.php');
	global $wpdb;

	$dir = site_url().'/wp-admin/admin.php?page=conasa-asking-settings';
	$post_type = $_POST['post_type'];
	$type = $_POST['type'];
	if($_POST['accion']=='eliminar'){
		$type = $_POST['accion'];
	}
	
	

	switch ($type) {
		case 'preguntas':

					$lastid = $_POST['id'];
					$preguntas = $_POST['answer_1'];
					$i = 0;
					foreach ((array)$preguntas as $pregunta) {

						$pregunta_new =  $wpdb->insert($wpdb->prefix.'preguntas',array( 'pregunta' => $pregunta, 'shortcode_id' => $lastid ), array( 	'%s', 	'%s' 	) );
					}
				
					$_SESSION['asking_shortcode'] = $lastid;
 				

			break;
		case 'respuesta':

					$lastid = $_POST['id'];
					$preguntas = $_POST['answer_1'];
					$i = 0;
					foreach ((array)$preguntas as $pregunta) {

						$pregunta_new =  $wpdb->insert($wpdb->prefix.'respuestas',array( 'respuesta' => $pregunta, 'id_pregunta' => $lastid ), array( 	'%s', 	'%s' 	) );
					}
			break;
		case 'resultado':
				$i = 0;
				foreach ($_POST as $key => $value) {
					if(strpos($key, 'pregunta_') !== false){
						$matriz[$i] = $value;
						$i++;
					}
				}

				$matriz = array_count_values($matriz);
				$max = max($matriz);
				$elem = array_search($max,$matriz);
				$result = get_post($elem);
				$result =  get_object_vars($result);
				

					$to = 'adortega90@gmail.com';
					$subject = 'The subject';
					$body = 'The email body content';
					//$headers = array('Content-Type: text/html; charset=UTF-8');
					$headers[] = 'From: Me Myself <aortega@besign.com.ve>';
					$headers[] = 'Cc: John Q Codex <aortega@besign.com.ve>';
					$headers[] = 'Cc: aortega@besign.com.ve'; // note you can just use a simple email address
					wp_mail( $to, $subject, $body, $headers );

				echo '<center>
						<h3>Lo ideal para ti es</h3>
						
						<div class="col-lg-6 col-md-6 col-sm-12" style="border: solid 1px;padding-bottom: 10px;">
							<h5> '.$result["post_title"].' </h5>
							
							<a class="btn btn-lg animSpeedLazy animLoop02 animDelay04 pulse btn-carrot-orange animated" href="'.$result["guid"].'" >
	                                                Ver Mas
	                        </a>
	                    </div>    
					</center >';			
				break;	
		case 'value_respuesta':
				$wpdb->update( $wpdb->prefix . 'respuestas', 
				array( 'value' => intval($_POST['value_post']) ), 
				array( 'id' => intval($_POST['id'])) 
				
				);		

				$wpdb->update( $wpdb->prefix . 'preguntas', 
				array( 'pregunta' => (string)$_POST['preguntas0_'] ), 
				array( 'id' => intval($_POST['id_pregunta'])) 
				
				);
				$wpdb->update( $wpdb->prefix . 'respuestas', 
				array( 'respuesta' => (string)$_POST['respuestas0_'] ), 
				array( 'id' => intval($_POST['id'])) 
				
				);

				break;

		case 'configuracion':
			
			if(empty($_POST['accion']))
			{
				$id = $wpdb->insert($wpdb->prefix.'shortcode',array( 
															'post_type' => $_POST['type_of_post'], 
															'titulo' => $_POST['titulo'], 
															'descripcion' => $_POST['comment'],  
															'pregunta_imagen' => $_POST['pregunta_imagenes'], 
															'respuesta_imagen' => $_POST['respuestas_imagenes']	), array('%s', '%s', '%s', '%s', '%s') );				
			}
			else
			{
				
				$wpdb->update( $wpdb->prefix . 'shortcode', array( 
															'post_type' => (string)$_POST['type_of_post'], 
															'titulo' => (string)$_POST['titulo'], 
															'descripcion' => (string)$_POST['comment'],  
															'pregunta_imagen' => (string)$_POST['pregunta_imagenes'], 
															'respuesta_imagen' => (string)$_POST['respuestas_imagenes']	), 
															array( 'id' => intval($_POST['id_a']))

															) ;
			}




			break;
		case 'eliminar':

				switch ($_POST['type']) {
					case 'respuesta':
						$wpdb->delete($wpdb->prefix.'respuestas', array( 'id' => $_POST['id_a'] ), array( '%d' ) );
						break;
					case 'preguntas':
						$wpdb->delete($wpdb->prefix.'preguntas', array( 'id' => $_POST['id_a'] ), array( '%d' ) );
					
						break;
					case 'formulario':
							$wpdb->delete($wpdb->prefix.'shortcode', array( 'id' => $_POST['id_a'] ), array( '%d' ) );
						break;
					default:
						echo "error";
						break;
				}
			break;
		default:
			echo "<h1> default </h1>";
			break;
	}

	
	
?>