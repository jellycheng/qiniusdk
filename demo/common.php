<?php
header("Content-type: text/html; charset=utf-8");
//时区设置
date_default_timezone_set('Asia/Shanghai');
$vendorFile = dirname(__DIR__)  .  '/vendor/autoload.php';
if(file_exists($vendorFile)) {
    require $vendorFile;
} else {
    require_once  __DIR__ . '/src/Qiniu/functions.php';
    spl_autoload_register(function ($class) {
        $ns = 'Qiniu';
        $base_dir = dirname(__DIR__) . '/src';
        $prefix_len = strlen($ns);
        if (substr($class, 0, $prefix_len) !== $ns) {
            return false;
        }
        $class = substr($class, $prefix_len);
        $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (is_readable($file)) {
            require $file;
        }

    });
}

/**
function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/src/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('classLoader');
*/
