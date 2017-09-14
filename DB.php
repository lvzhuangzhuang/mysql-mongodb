<?php
/**
* DB 基础单例类
*/
class MysqlDB
{
    private static $_conn = '';

    private function __construct()
    {
	}

	public static function getConn($db,$host="127.0.0.1",$user="root",$pwd="123",$port=3306)
	{
		if(self::$_conn)
			return self::$_conn;
		else
		{
			self::$_conn = new Mysqli($host,$user,$pwd,$db,$port);
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
			return self::$_conn;
		}

	}
}

class MongoConn{
    private static $_conn = '';
    private function __construct()
    {

    }

    public static function getConn($uri)
    {
        if(self::$_conn)
            return self::$_conn;
        else
        {
            self::$_conn = new MongoDB\Driver\Manager($uri);
            return self::$_conn;
        }

    }
}