<?php
class conexion{
    

    function getConnection(){
        $host =$_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $port = $_ENV['DB_PORT'];
        
        try {
             return $conn = new PDO("sqlsrv:Server={$host},{$port};Database={$dbname}",$user,$password);
             
        }
        catch (PDOException $e) {
            print("Error connecting to SQL Server:".  $e->getMessage());
            return $e->getMessage();
        }
    
    }


}
    
    

?>
