<?php

class NmbsDB
{
    private static $gebruikersInstantie = null;

    private $dbh;

    private function __construct($server, $username, $password, $database)
    {
        try {
            $this->dbh = new PDO("mysql:host=$server; dbname=$database", $username, $password);
            //Bij error: exception opwerpen
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->exec("set names utf8");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstantie($server, $username, $password, $database)
    {
        if (is_null(self::$gebruikersInstantie)) {
            self::$gebruikersInstantie = new NmbsDB($server, $username, $password, $database);
        }
        return self::$gebruikersInstantie;
    }

    public function sluitDB()
    {
        $dbh = null;
    }

    public function getTrainStops()
    {

        try {
            $sql = "SELECT DISTINCT stop_id, stop_name,stop_latitude, stop_longtitude,stop_code
                    FROM stops";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }
}

?>