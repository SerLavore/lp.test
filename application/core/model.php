<?php

require_once("interface/imodel.php");

class Model implements IModel
{

    public function get_data(array $arr = null)
    {

    }

    public function updateData($table, array $fields, array $val, $increment = false, $where = null)
    {
        $fields_str = null;

        if($increment) {
            for($i = 0; $i < count($fields); $i++) {
                $fields_str .= $fields[$i] . " = ". $fields[$i] ." + ?,";
            }
        }
        else{
            for($i = 0; $i < count($fields); $i++) {
                $fields_str .= $fields[$i] . " = ?,";
            }
        }

        $fields_str = trim($fields_str);
        $fields_str = substr($fields_str, 0 , - 1);

        if($where)
        {
           return self::query("UPDATE ". $table . " SET " . $fields_str . " WHERE " . $where . " = ?", false, $val);
        }
        else
        {
           return self::query("UPDATE ". $table . " SET " . $fields_str, true, $val);
        }

    }

    public function query($inq, $fetchAll = true, array $arr = null)
    {
        $pdo = self::connect();

            try
            {
                $query = $pdo->prepare($inq);
                if(!$query->execute($arr))
                {
                    throw new PDOException("can`t execute");
                }
                if($fetchAll)
                   return $query->fetchAll();
                else return $query->fetch();
            }
            catch(PDOException $e)
            {
                $e->getMessage();
                return self::close();
            }
    }

    private function connect()
    {
        try{

            $config = new Config("db_config");

            $dsn = "mysql:host=".$config->config{"host"}.";dbname=".$config->config{"db_name"}.";";

            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            $connect = new PDO($dsn, $config->config{"db_user"}, $config->config{"db_password"}, $opt);
            return $connect;
        }
        catch(PDOException $e){
            echo('Can`t connect ' . $e->getMessage());
            return self::close();
        }
    }

    private function close()
    {
        return $connect = null;
    }
}