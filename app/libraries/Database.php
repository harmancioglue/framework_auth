<?php

/**
 * Singleton is implemented
 */
class Database
{
    private static $instance = null;

    private $db;

    private $host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;

    private $error;

    private $statement;

    private function __construct()
    {
        $this->connect();
    }

    public static function getDbInstance()
    {
        if (is_null(self::$instance)){
            self::$instance = new Database();
        }

        return self::$instance;
    }

    private function connect()
    {
        /** dsn can be customized for other drivers such as MsSql */
        $dsn = 'mysql:host='.$this->host .';dbname='.DB_NAME;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
           $this->db = new PDO($dsn,$this->db_user,$this->db_pass,$options);
        }
        catch (PDOException $ex)
        {
            $this->error = $ex->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->statement = $this->db->prepare($sql);
    }

    public function execute()
    {
       return $this->statement->execute();
    }

    public function getResultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getResult()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value, $type=null)
    {
        if (is_null($type)){
            switch (true)
            {
                case is_int($value) : $type = PDO::PARAM_INT; break;
                case is_bool($value) : $type = PDO::PARAM_BOOL; break;
                case is_null($value) : $type = PDO::PARAM_NULL; break;
                default:$type = PDO::PARAM_STR; break;
            }
        }

        $this->statement->bindValue($param,$value,$type);
    }


    public function getRowCount()
    {
        return $this->statement->rowCount();
    }
}