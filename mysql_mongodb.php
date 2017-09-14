<?php

require_once("./DB.php");
require_once("./MYSQL.php");
require_once("./MongoDbExec.php");
$database = "gaode";
$db =  new MysqlModel("MysqlDB",$database);
$mongo  =  new MongoDbExec("MongoConn");

$tables = $db->getTables("show tables");
//循环表
$total = count($tables);
foreach ($tables as $i => $table)
{
    printf("当前进度: [%-100s] %d%% ".PHP_EOL, str_repeat('#',$i/$total*50), $i/$total*100);
    $datas = [];
    $res = $db->getAll("select * from $table");
    //循环数据
    foreach ($res as $val)
    {
        $data = [];
        foreach ($db->getField("desc $table ") as $field)
        {
            $data[$field] = $val[$field];
        }
        if(count($datas) > 10)
        {
            $mongo->insertMany($datas,$database,$table);
            $datas = [];
        }
        else
             $datas[] = $data;
    }
    $mongo->insertMany($datas,$database,$table);

    echo PHP_EOL;
}
printf("当前进度: [%-100s] %d%% ".PHP_EOL, str_repeat('#',$i/$total*50), 100);










