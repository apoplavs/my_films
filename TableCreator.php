<?php
/**
 * Created by PhpStorm.
 * User: andriy
 * Date: 17.07.17
 * Time: 13:36
 */
class TableCreator
{
    private $bdd;

    function __construct()
    {
        require_once('config/database.php');
        try
        {
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die('Error : ' . $e->getMessage());
        }
        $this->bdd = $bdd;
    }

    function get_table($query) {
       $result_statement = $this->bdd->query($query);
       $result = $result_statement->fetchAll(PDO::FETCH_ASSOC);
       foreach ($result as $res)
       {
           print_r($res);
           echo ('</br>');
       }

//        return ($table);
    }
}
?>