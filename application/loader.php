<?php
    ob_start();
    header('X-Powered-Framework:DragonNest-FrameWork');
    header('X-Powered-CMS:DragonNest-CMS');

    session_start();

    define('base_path', str_replace('application/loader.php', '', str_replace("\\", '/', __FILE__)));
    define('app_path', str_replace('application/loader.php', '', str_replace("\\", '/', __FILE__)) . 'application/');

    require_once app_path . 'config/config.php';
    require_once app_path . 'include/functions.php';
    require_once app_path . 'include/database.php';
    require_once app_path . 'include/user.php';
    require_once app_path . 'include/data.php';

    database::db_connect();