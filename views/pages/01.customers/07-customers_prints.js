/* BLOQUE PARA IMPRIMIR CONTENIDO DE PANTALLA 
---------------------------------------------*/

$(document).ready(function(){
   
    $("#print").click(function(){
        /*let printForm = $("#printCustomer");
        let original = $("body");

        $("body").text(printForm);
        window.print();
        $("body").text(original);*/
        printCustomer($("#printCustomer").html());

        
    })









})

function printCustomer(containerPrint) {
    let contenidoOriginal= document.body.innerHTML;
    document.body.innerHTML = containerPrint;
    window.print(); 
    document.body.innerHTML = contenidoOriginal; 

}