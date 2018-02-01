<?php
namespace Core;
use \App\Config;
use PDO;
/*Base Model*/
abstract
class Model
{
    // /*get the PDO database connection


private $db; 
     function __construct()
    {

            // $db =new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            //Throw an Exception when an error oci_new_cursor
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        
    }

    protected function insert($qry,$data)
    {
        
        $stmt = $this->db->prepare($qry);
        $stmt->execute($data);
        
        return 'true';
    }

    protected function count($qry)
    {
        
        $stmt = $this->db->prepare($qry);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }
    protected function fetch($qry)
    {
        // echo $qry;
        $stmt = $this->db->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function delete($qry)
    {
        
        $stmt = $this->db->prepare($qry);
        $result = $stmt->execute();
        return $result;
        
    }

    protected function update($qry)
    {
        
        $stmt = $this->db->prepare($qry);
        $stmt->execute();
       
        return 'true';
    }

    protected function lastInsertId($qry,$data)
    {

        // echo $qry;

          $stmt = $this->db->prepare($qry);
        $stmt->execute($data);
        $lastId = $this->db->lastInsertId();
        return $lastId;
    }



}
?>
