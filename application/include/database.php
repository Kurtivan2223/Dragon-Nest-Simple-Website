<?php
    class Database
    {
        public static $connection;

        public static function db_connect()
        {
            $user = get_config('user');
            $pass = get_config('pass');
            $serverName = get_config('hostname');

            self::$connection = new PDO(
                "sqlsrv:Server=$serverName",
                $user, 
                $pass);
        }
    }