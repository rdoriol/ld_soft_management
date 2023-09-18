<?php
    /**
     * Clase que implementará métodos para realizar CRUD recibiendo datos de la Vista y enviándolos al Modelo.
     */
    class CustomerController {

        /**
         * Método que recibirá datos del formulario Ficha Clientes y los enviará a la base de datos mediante método del Modelo.
         * @param 
         */
        static public function ctrCreateCustomer() {

            try {
                if(isset($_POST["customer_submit"])) {
                    if(!empty($_POST["customer_name"])) {
                        $table = "customers";
                        $token = "prueba";
                        $data = array("token"=> $token,
                                    "customer_name" => $_POST["customer_name"],
                                    "customer_nifcif" => $_POST["customer_name"],
                                    "customer_type" => $_POST["customer_type"],
                                    "customer_address" => $_POST["customer_address"],
                                    "customer_postal_code" => $_POST["customer_postal_code"],
                                    "customer_town" => $_POST["customer_town"],
                                    "customer_province" => $_POST["customer_province"],
                                    "customer_country" => $_POST["customer_country"],
                                    "customer_phone" => $_POST["customer_phone"],
                                    "customer_email" => $_POST["customer_email"],
                                    "customer_contact_person" => $_POST["customer_contact_person"]);

                        $create = CustomerModel::mdlCreateCustomer($table, $data);
                        return $create;
                    }
                    else {
                        echo "<div class='text-center alert-danger rounded'><p>No grabado. <br> Campo/s vacíos</p></dv>";
                    }
                }
            }
            catch(PDOException $ex) {
                echo "Error ctrCreateCustomer(). Error: " . $ex->getMessage();
            }
        }




    }












   // No se cierra etiqueta php por seguridad informática.