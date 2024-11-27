<?php

// Функции


// Вспомогательные
function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function dd($data)
{
    dump($data);
    die();
}

// Аборт ребенка нахуй
function abort($code = 404, $msg = "")
{
    http_response_code($code);
    require VIEWS . "/.errors/{$code}.tpl.php";
    die();
}
