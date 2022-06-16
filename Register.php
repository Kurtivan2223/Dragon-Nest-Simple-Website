<?php
    require_once './application/loader.php';

    user::post_handler();

    require_once base_path . 'template/' . get_config('template') . '/tpl/main.html';
?>
