<?php

class Conexion
{
   private $conection = null;


   public function getConexion()
   {

        //define('DBHOST', 'localhost');
        //define('DBUSER', 'root');
        //define('DBPASS', '@rzobisp@d0');
        //define('DBNAME', 'syscatedral');

    	define('DBHOST', 'arzovvm2020dbmysql.mysql.database.azure.com');//DB_HOST:  generalmente suele ser "127.0.0.1"
        define('DBUSER', 'uservmdbmysql@arzovvm2020dbmysql');//Usuario de tu base de datos
        define('DBPASS', '01*V1NfJMSaV');//Contraseña del usuario de la base de datos
        define('DBNAME', 'syscatedral');//Nombre de la base de datos
       

        try {
            $this -> conection = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS);
            $this -> conection ->exec("set names utf8");
            return $this -> conection;
        }catch(Exception $e)
        {   //$e="Imposible conectarse a la base de datos!";
            //die('Erreur : '.$e->getMessage("Imposible conectarse a la base de datos!"));
            echo "<h2 style='text-align:center'>¡Ups! An error occurred:</h2>";
          
        }

    }

    public function closeDataBase()
    {
        if($this-> conection <> null)
        {
           $this-> conection = null;
            
        }
    }

  
}
   
?>