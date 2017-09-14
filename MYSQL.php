<?php
/** mysql 操作类
 * Created by PhpStorm.
 * User: lv_zh
 * Date: 2017-09-13
 * Time: 下午 05:15
 */
class  MysqlModel
{
    public $conn;
    public function __construct($className,$db)
    {
        $this->conn = $className::getConn($db);
    }
    public function getField($sql)
    {
        if ($result = $this->conn->query($sql))
        {
            $fields = [];
            while($row = $result->fetch_array())
            {
                $fields[] = $row['Field'];
            }
            return $fields;
        }
    }
    public function getTables($sql)
    {
        if ($result = $this->conn->query($sql))
        {
            $tables = [];
            while($row = $result->fetch_array())
            {
//                return $row;
                $tables[] = $row[0];
            }
            return $tables;
        }
    }
    public function  getAll($sql)
    {
        if ($result = $this->conn->query($sql))
        {
            $rows = [];
            while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }
            return $rows;
        }
    }
}