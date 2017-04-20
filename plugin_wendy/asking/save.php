
<?php

	
	require_once('../../../wp-config.php');
	global $wpdb;

	$dir = site_url().'/wp-admin/admin.php?page=conasa-asking-settings';
	$post_type = $_POST['post_type'];
	$type = $_POST['type'];
	if($_POST['accion']=='eliminar')
	{
		$type = $_POST['accion'];
	}
	
	

	switch ($type) {
		case 'preguntas':

					$lastid = $_POST['id'];
					$preguntas = $_POST['answer_1'];
					$imagenes = $_POST['image_1'];

					$i = 0;
					$j = 1;
					foreach ((array)$preguntas as $pregunta) {

						$pregunta_new =  $wpdb->insert($wpdb->prefix.'preguntas',array( 'pregunta' => $pregunta, 
																						'shortcode_id' => $lastid, 
																						'pregunta_imagen' => $_POST['pregunta_imagenes_'.$j], 
																						'respuesta_imagen' => $_POST['respuesta_imagenes_'.$j], 
																						'text_extra' => $_POST['texto_'.$j],
																						'image' => $imagenes[$i]), array( 	'%s', '%s', '%s','%s', 	'%s',  '%d' 	) );
						$i = $i +1;
						$j = $j +1;

					}
					
			break;
		case 'respuesta':

					$lastid = $_POST['id'];
					$preguntas = $_POST['answer_1'];
					$imagenes = $_POST['image_1'];
					$i = 0;
					foreach ((array)$preguntas as $pregunta) {

						$pregunta_new =  $wpdb->insert($wpdb->prefix.'respuestas',array( 'respuesta' => $pregunta, 'id_pregunta' => $lastid, 'image' => $imagenes[$i]), array( 	'%s', 	'%s',  '%d' 	) );
						$i = $i +1;
					}
			break;
		case 'resultado':
					
					$email  = $_POST['email'];
					$nombre = $_POST['nombre'];
					$id     = $_POST['id'];
					unset($_POST['type']);
					unset($_POST['email']);
					unset($_POST['nombre']);
					unset($_POST['id']);
					$respuestas = $_POST;
					$cant_preg  = 0;
					$acum       = 0;
					$i 			= 0;
				    $aux =  "SELECT * FROM `".$wpdb->prefix.'preguntas`'." WHERE `shortcode_id` = ".$id;
				    $preguntas = $wpdb->get_results( $aux, OBJECT ); 

				    $aux =  "SELECT * FROM `".$wpdb->prefix.'shortcode`'." WHERE `id` = ".$id;
				    $post_answer = $wpdb->get_results( $aux, OBJECT ); 
				    $post_answer  = get_object_vars($post_answer[0]);

					foreach ($preguntas as $pregunta) 
					{
						$pregunta  = get_object_vars($pregunta);
						$answer[$i]['pregunta'] = $pregunta['pregunta'];
						
						if($respuestas['pregunta_'.$pregunta['id']]==5)
						{
							$answer[$i]['respuesta'] = 'Correcto';
						}
						else
						{
							$answer[$i]['respuesta'] = 'incorrecto';
						}

						if(!empty($respuestas['comment_'.$pregunta['id']]))
						{
							$answer[$i]['text_extra'] = $respuestas['comment_'.$pregunta['id']];
						}

						$acum = $respuestas['pregunta_'.$pregunta['id']] + $acum;
						$cant_preg++;	
						$i++;			

					}
					
					$max_score =$cant_preg *5;
					if($acum >= (($max_score)/2))
					{
						$post = get_post($post_answer['post_type'],ARRAY_A) ;
					}
					else
					{
							$nopost = 
									'<center>
										<h3 class="tc-white" >No tienes resultados recomendados </h3>
									</center >';
					}

					$to = $email;
					//$to = 'adortega90@gmail.com';
					$subject  = 'Resultados del Test';
					if(!empty($nopost))
					{
						//$body = do_shortcode($post['post_content']);	
						$body =apply_filters('the_content',$post['post_content']);	
					}
					else
					{
						$body = $nopost;
					}					
					$headers = array('Content-Type: text/html; charset=UTF-8');
					//$headers[] = 'From: disenaloenlineabusiness.com <hola@disenaloenlinea.com>';
					$headers[] = 'From: disenaloenlineabusiness.com <aortega@besign.com.ve>';
					wp_mail( $to, $subject, $body, $headers );
					
					if(empty($nopost))
					{
						echo '
						<center>
							<h3 class="tc-white" >Lo ideal para ti es</h3>
								 
								<div class="col-lg-6 col-md-6 col-sm-12" style="border: solid 1px #7f7f7f;padding-bottom: 10px;">
									<h5 class="tc-white" >'.(string)$post['post_title'] .'</h5>
									
									<a class="btn btn-lg color-text-asking animSpeedLazy animLoop02 animDelay04 pulse btn-carrot-orange animated" href="'. (string)$post['guid'] .'" >
			                                                Ver Mas
			                        </a>
			                    </div>    
						</center >';		
					}
					else
					{
						echo $nopost;
					}	

					$id = $wpdb->insert($wpdb->prefix.'usuarios',array( 
															'email' => (string)$email, 
															'name'  => (string)$nombre));	

					$res =  '<h2> Usuario:  '.$nombre.'   Email:  '.$email.'</h2><br>';
					foreach ($answer as $ans) 
					{
						$res = $res.'<h3>Pregunta:  '.$ans["pregunta"].'</h3>
								 <h4>Respueta:  '.$ans["respuesta"].'</h4>' ;
								 if(!empty($ans["text_extra"]))
								 {
								 	$res = $res. '<h4> Texto Complementario:  '.$ans["text_extra"].'</h4><br>';
								 }
								

						
					}
					//$to = 'hola@disenaloenlinea.com';
					$to = 'aortega@besign.com.ve';
					$subject  = 'Resultados del '.$nombre;
					$body = $res;
					$headers = array('Content-Type: text/html; charset=UTF-8');
					//$headers[] = 'From: disenaloenlineabusiness.com <hola@disenaloenlinea.com>';
					$headers[] = 'From: disenaloenlineabusiness.com <aortega@besign.com.ve';
					wp_mail( $to, $subject, $body, $headers );
				break;	
		case 'value_respuesta':

				$wpdb->update( $wpdb->prefix . 'respuestas', 
				array( 'value' => intval($_POST['value_post']) ), 
				array( 'id' => intval($_POST['id'])) 
				
				);		

				$wpdb->update( $wpdb->prefix . 'preguntas', 
								array( 'pregunta' => (string)$_POST['preguntas_'] ), 
								array( 'id' => intval($_POST['id_pregunta'])) 
				
							  );
				$wpdb->update( $wpdb->prefix . 'respuestas', 
								array( 'respuesta' => (string)$_POST['respuestas_'] ), 
								array( 'id' => intval($_POST['id'])) 
				
							 );
				if(!empty($_POST['image_r']))
				{
					$wpdb->update( $wpdb->prefix . 'respuestas', 
									array( 'image' => intval($_POST['image_r']) ), 
									array( 'id' => intval($_POST['id']))
								 ); 
				}
				if(!empty($_POST['image_p']))
				{
					$wpdb->update( $wpdb->prefix . 'preguntas', 
									array( 'image' => intval($_POST['image_p']) ), 
									array( 'id'    => intval($_POST['id_pregunta']) )
								 ); 	
				}
				break;

		case 'configuracion':


			
			if(empty($_POST['accion']))
			{
				$id = $wpdb->insert($wpdb->prefix.'shortcode',array( 
															'post_type' => (string)$_POST['type_of_post'], 
															'titulo' => (string)$_POST['titulo'], 
															'descripcion' => (string)$_POST['comment'],  
															'descripcion_lateral' => (string)$_POST['comment_lateral']));		
				
														
			}
			else
			{
				
				
				$wpdb->update( $wpdb->prefix . 'shortcode', array( 
															'post_type' => (string)$_POST['type_of_post'], 
															'titulo' => (string)$_POST['titulo'], 
															'descripcion' => (string)$_POST['comment'],  
															'descripcion_lateral' => (string)$_POST['comment_lateral'], 
															array( 'id' => intval($_POST['id_a'])))) ;

				
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