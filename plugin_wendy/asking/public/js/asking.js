function submitAsking(functiones,id=''){
  
      console.log('pasar');       
      console.log("holis");
      //event.preventDefault();
      var data = $("form").serialize();
      console.log(data);
      $.ajax({
      type : "POST",
      url  : "../wp-content/plugins/asking/save.php",
      cache: false,
      data : data,
      
      success :  function(data)
      {
        
        switch (functiones) {
            case 'configuracion':
                   window.location.href = "../wp-admin/admin.php?page=conasa-asking-settings";
                   $("div#preguntas_salvadas").html(data);
                break;
            case 'respuesta_value':
                  window.location.href = "../wp-admin/admin.php?page=conasa-asking-add_2&type_data=respuesta&id=" + id;
                //$("div#preguntas_salvadas").html(data);
              break;
            
            default:

                window.location.href = window.location.href;
                $("div#preguntas_salvadas").html(data);
                break;
        } 
        
      },
        complete: function() {

        }

      });
  
}
function loadimage()
{

  var $ = jQuery;
    if ($('.set_custom_images').length > 0) {
        if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $(document).on('click', '.set_custom_images', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.prev();
                wp.media.editor.send.attachment = function(props, attachment) {
                    id.val(attachment.id);
                };
                wp.media.editor.open(button);
                return false;
            });
        }
    }
}
function loadimage_input(id,elem_value) {
  
  var elem = '#pregunta_imagenes_' + id;
 // var elem_value =  $(elem).attr("value");
  var elem_load  ="#load_image_" + id;
  
  if(elem_value=='Si'){
    
    $(elem_load).addClass("show-load");
    $(elem_load).removeClass("hiden-load");
  }
  else
  {
  
    $(elem_load).addClass("hiden-load");
    $(elem_load).removeClass("show-load");
  }

}
function crud(functiones,id){
     
      console.log('pasar');       
      console.log("holis");
      //event.preventDefault();
      var data = $("form").serialize() + "&accion=" + functiones + "&id_a=" + id;
      console.log(data);
      $.ajax({
      type : "POST",
      url  : "../wp-content/plugins/asking/save.php",
      cache: false,
      data : data,
      
      success :  function(data)
      {
        
        switch (functiones) {
            case 'configuracion':
                   window.location.href = "../wp-admin/admin.php?page=conasa-asking-settings";
                break;
            case 'editar':
                   window.location.href = "../wp-admin/admin.php?page=conasa-asking-settings";
                break;

            default:
                window.location.href = window.location.href;
                break;
        }  
        
      },
        complete: function() {

        }

      });
}
