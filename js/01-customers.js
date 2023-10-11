var searchWindow;

function openWindow() {
    var options = "width=500px, height=500px, top=300px, left=200px, resizable=no, scrollbars=no, location=no, directories=no";
    searchWindow = window.open("views/06-search.template.php", "relojDigital", options); 
}

    /**
     * 
     */
    var ventana;
    function searchCustomer () {
        $("#search_customer").click(function(){
            var options = "width=500px, height=500px, top=300px, left=200px, resizable=no, scrollbars=no, location=no, directories=no";
            ventana = window.open("index.php?emergent=06-search", "Búsqueda", options); 
            console.log("probando");




        })
    }
    searchCustomer();