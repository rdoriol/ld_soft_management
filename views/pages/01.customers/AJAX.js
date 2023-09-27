/**
 * 
 */
$(document).ready(function(){

    $("#customer_name").change(function() {

        var customerNameForm = $(this).val();
                                                console.log("Valor obtenido del form: " + customerNameForm);  // todo ELIMINAR
            // Se genera formulario para comunicarse con fichero php (name y su valor)
        var dataForm = new FormData(); 
                            // name             valor
        dataForm.append("customerNameForm", customerNameForm);
        
        $.ajax({
           url: "ajax/ajax_customers.php",
           method: "POST",
           data: dataForm,
           cache: false,
           contentType: false,
           processData: false,
           dataType: "json",
           success: function(request) {
                                        console.log("Valor obtenido de base de datos: " + request); // todo ELIMINAR
                        if(request == "true") {
                            $("#customer_name").addClass("alert-danger");
                            $("#customer_name").css("border", "2px solid red");
                            
                           
                        }
                        else {
                            $("#customer_name").removeClass("alert-danger");
                            $("#customer_name").css("border", "2px solid green");
                            $("#customer_name").css("display", "block");
                           
                        }
          
            }
        })
    
    
    
    })
})