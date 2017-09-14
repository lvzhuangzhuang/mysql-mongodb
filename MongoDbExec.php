<?php
/** mongodb 操作类
 * Created by PhpStorm.
 * User: lv_zh
 * Date: 2017-09-13
 * Time: 下午 05:15
 */
class  MongoDbExec{
    public $conn;
    private $bulk;
    public function __construct($className,$uri="mongodb://127.0.0.1:27017")
    {
        $this->conn = $className::getConn($uri);

    }
    public function insertMany($data,$db="db",$table){
        $this->bulk = new MongoDB\Driver\BulkWrite;
        foreach ($data as $v)
        {
            $this->bulk->insert($v);
        }
        $this->conn->executeBulkWrite($db.'.'.$table, $this->bulk);
    }
}