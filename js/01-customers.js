
    var ventana; // variable que almacenará subventana abierta
    /**
     * Función que abrirá ventana emergente (popUp) con buscador
     */   
    function openSubwindow() {
        $("#search_customer").click(function(){
            var options = "width=500px, height=500px, top=300px, left=200px, resizable=no, scrollbars=no, location=no, directories=no";
            ventana = window.open("index.php?emergent=06-popUpsearch", "Búsqueda", options); 
        })
    }

    // Se lanza función para que esté siempre espectante.
    openSubwindow();

    /**
     * Función que cerrará la subventana
     */
    function closeSubwindow() {       
        if(ventana != "") {
            window.close();
        }       
    }


