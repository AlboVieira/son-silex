<?php
/**
 * Created by PhpStorm.
 * User: albov
 * Date: 14/02/2016
 * Time: 19:33
 */

namespace Code\Sistema\Mapper;


use Code\Sistema\Entity\Cliente;
use Code\Sistema\Entity\Interfaces\EntityInterface;
use PDO;

class AbstractMapper
{

    /** @var  PDO */
    protected $conn;
    protected $sql;
    protected $table;

    /**
     * AbstractMapper constructor.
     * @param $conn
     */
    public function __construct()
    {
        if(!$this->conn){
            $db = "son-silex";
            $servername = "localhost";
            $username = "root";
            $password = "";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn = $conn;
            }
            catch(\PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();die;
            }
        }
    }

    public function persist(array $fields, array $values){

        $fieldsStr = implode(',',$fields);
        $valuesStr = implode(',',$values);
        $sql = "INSERT INTO {$this->table}
                    ({$fieldsStr})
                    VALUES
                    ({$valuesStr})";
        $this->sql = $sql;
    }

    public function merge(array $fieldValues,array $id){

        $chaveId = array_keys($id);
        $chaveId = reset($chaveId);
        $valueId = reset($id);

        $values = '';
        $count = 1;
        foreach($fieldValues as $key=>$item){
            if(count($fieldValues) == $count){
                $values .= " {$key} = $item ";
                continue;
            }
            ++$count;
            $values .= " {$key} = $item ,";
        };
        $sql = "UPDATE produto
                    SET
                    {$values}
                    WHERE {$chaveId} = {$valueId};
                    ";
        $this->sql = $sql;
    }

    public function flush(){
        /** @var \PDOStatement $stmt */
        $stmt = $this->conn->prepare($this->sql);
        return $stmt->execute();
    }

    public function findAll(){
        $consulta = $this->conn->query("SELECT * FROM {$this->table}");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findBy(array $fields){

        $where = $this->addWhere($fields);
        $consulta = $this->conn->query("SELECT * FROM {$this->table} $where");
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function addWhere(array $fields){
        $where = 'WHERE ';
        $isFirst = true;
        foreach($fields as $chave=>$valor){
            if(!$isFirst)
                $where .= ' AND ';

            $where .= " {$chave} = '{$valor}' ";
            $isFirst = false;
        }
        return $where;
    }

}