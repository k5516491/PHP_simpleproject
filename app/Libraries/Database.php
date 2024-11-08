<?php
class Database
{
    private $dbh;
    private $user = 'root';
    private $pass = '';
    private $stmt;
    private $error;
    public function __construct()
    {
        echo"DATABASE __construct from app/libraies" ;
        $dsn = 'mysql:host=localhost'. ';dbname=u7_20241023;';
        $options = array(
            PDO::ATTR_PERSISTENT => true, //持續連接
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch(PDOException $e)
        {
            $this->error = $e->getMessage();
            echo $this ->error;
        }

    }
    public function query($sql)
    {
        $this -> stmt = $this -> dbh->prepare($sql);
    }
    public function bind ( $param, $value , $type = null)
    {
        if(is_null($type)){
            switch ($param){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                    default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this -> stmt->bindParam($param, $value, $type);
    }
    public function execute()
    {
        return $this -> stmt->execute();
    }
    public function resultSet()
    {
        $this->execute();
        return $this -> stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function single()
    {  
        $this->execute();

        return $this -> stmt->fetch(PDO::FETCH_OBJ);
    }
    public function rowCount()
    {
        return $this -> stmt->rowCount();
    }
}