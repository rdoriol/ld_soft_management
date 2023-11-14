<?php
    require_once './models/connection.model.php';

    use PHPUnit\Framework\TestCase;

    /**
     * Clase de test que implementará pruebas unitarias de la clase Connection
     */
    class ConnectionTest extends TestCase {

         public function testMdlConnect() {
        
            $result = Connection::mdlConnect();            

            $this->assertNotNull($result);
        }
    }