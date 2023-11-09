$(document).ready(function(){

    var subwindowInvoice;

    /**
     * Función que abrirá subventana (popUp) con buscador de clientes
     */   
    $(".search_icon_customer").click(function(){
        var options = "width=500px, height=500px, top=100px, left=200px, resizable=no, scrollbars=no, location=no, directories=no";
        subwindowInvoice = window.open("index.php?pages=04-invoicePopUpSearch", "Búsqueda", options); 
    })

    /**
     * Función que al introducir número de cliente mostrará sus datos en factura
     */
    $("#id_customer_item").change(function(){
                            
            // Se limpian campos de cliente previamente mostrados (si los hubiera), así como el token oculto previamente almacenado
        cleanInvoiceFields();        
            
            // Se lanza función para obtener datos de cliente 
        getRegisterCustomerAjax(); 

        if($("#request_ajax").val() == "false") {  
            $("#id_customer_item").val("");
        }
    })

    /** 
     * Función para comprobar campos vacíos de 01-newInvoice y no permitir el envío de la factura al backend, al mismo tiempo que comprobará si se están mostrando datos de una factura existente, las cuales no se pueden modificar ni eliminar
    */
    $("#btn_invoice_product_submit").click(function(){
        var idCustomer = $("#customer_number_inv").text();
        var idProduct = $(".id_product_item_c1").val();      
        var concept = $(".product_name_item_c1").val();   
        var amount = $(".amount_item_c1").val();   
        var price = $(".price_item_inv1").val(); 
        var idProductReadOnly = $(".id_product_item_c1").attr("readonly"); 

        if(idCustomer == "" || idProduct == "" || concept == "" || amount == "" || price == "" || concept == 0 || amount == 0 || price == 0) {
            $(".require_fields").css("display", "block");
            return false;
        }
        else if(idProductReadOnly == "readonly") {
            return false;
        }
        else {
            $(".require_fields").css("display", "none");
        }   
    })

    //$("#btn_invoice_pdf").click(function(){               //todo ELIMINAR FUNCIÓN

      //  var invoice = document.getElementById("invoice");
       // var invoice = $("#invoice").text();

     //   console.log(invoice);
      /*

        var doc = new jsPDF();

        doc.text(20, 20, 'Hola mundo');
        doc.text(20, 30, 'Vamos a generar un pdf desde el lado del cliente');

        // Add new page
        doc.addPage();
        doc.text(20, 20, 'Visita programacion.net');

        // Save the PDF
        doc.save('Factura.pdf');        */

     //   var doc = new jsPDF();
   //     var elementHTML = $('#invoice').html();
        /*var specialElementHandlers = {
        '#elementH': function (element, renderer) {
        return true;
        }
        };*/
     //   doc.fromHTML(elementHTML, 15, 15, {
     //   'width': 170
        //'elementHandlers': specialElementHandlers
     //   });

        // Save the PDF
     //   doc.save('Factura.pdf');
        /*
        html2pdf()
        .set({
            margin: 0,
            filename: 'documento.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 3, // A mayor escala, mejores gráficos, pero más peso
                letterRendering: true,
            },
            jsPDF: {
                unit: "in",
                format: "a3",
                orientation: 'portrait' // landscape o portrait
            }
        })
        .from(invoice)
        .save()
        .catch(err => console.log(err));*/ 
  //  })      
    
})

/**
 * Función que limpiará todos los campos mostrados de Cliente
 */
function cleanInvoiceFields() {
    $("#customer_number_inv").text("");
    $("#customer_name_inv").text("");
    $("#customer_nif_inv").text("");
    $("#customer_address_inv").text("");
    $("#customer_postal_code_inv").text("");
    $("#customer_town_inv").text("");
    $("#customer_province_inv").text("");
    $("#request_ajax").val("false");        // token oculto donde se almacena si existe el registro buscado de forma manual (en este customer)
    $("#token_customer").val("");   //todo
}

    /**
     * Función que conectará con fichero php "ajax/ajax_search_subwindow"
     */
function getRegisterCustomerAjax() {

    var token_customer = $("#token_customer").val();        // Se obtiene valor a buscar en la base de datos
    var idCustomer = $("#id_customer_item").val();          // Se obtiene id de cliente a buscar de input "Cliente a facturar" de 01.newInvoice
                                                                         
    var dataForm = new FormData();
    //                      name      value               
    dataForm.append("tokenCustomer", token_customer);      // Para obtener datos solicitados de la subventana buscado customers en 01.newInvoice
    dataForm.append("idCustomer", idCustomer);             // Para obtener datos solicitados desde input "Cliente a facturar" en 01.newInvoice                                                   
   
    $.ajax({
        url: "./ajax/ajax_search_subwindow.php",
        method: "POST",
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(request){      

                    if(request) {                           customer_number_inv
                                            
                        $("#customer_number_inv_hidden").val(request[0].id);
                        $("#customer_number_inv").text(request[0].id);
                        $("#customer_name_inv").text(request[0].name_customer);
                        $("#customer_nif_inv").text(request[0].nif_cif);
                        $("#customer_address_inv").text(request[0].address_customer);
                        $("#customer_postal_code_inv").text(request[0].postal_code);
                        $("#customer_town_inv").text(request[0].town);
                        $("#customer_province_inv").text(request[0].province);
                        //$("#customer_country_inv").text(request[0].country); 
                        $("#request_ajax").val("true");                                     
                    }
                    else if(request == null) {  
                        cleanInvoiceFields();
                    }
        }
    })
} 

/**
 * Función que obtendrá datos de subventana hija
 * Se lanzará directamente embebida en código html ("06-popUpsearch.template.php")
 * @return string respuesta
*/
function getSubwindowInvoiceValues(respuesta) {  
    
    window.opener.$("#token_customer").val(respuesta);
    window.opener.getRegisterCustomerAjax();
    closeSubwindow();
}

function prueba() {
    document.addEventListener("DOMContentLoaded", () => {
        // Escuchamos el click del botón
        const $boton = document.querySelector("#btnCrearPdf");
        $boton.addEventListener("click", () => {
            const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
            html2pdf()
                .set({
                    margin: 1,
                    filename: 'documento.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 3, // A mayor escala, mejores gráficos, pero más peso
                        letterRendering: true,
                    },
                    jsPDF: {
                        unit: "in",
                        format: "a3",
                        orientation: 'portrait' // landscape o portrait
                    }
                })
                .from($elementoParaConvertir)
                .save()
                .catch(err => console.log(err));
        });
    });
}

