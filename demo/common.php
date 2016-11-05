<?php
header("Content-type: text/html; charset=utf-8");
//时区设置
date_default_timezone_set('Asia/Shanghai');
define('DEMO_ROOT', __DIR__ . '/');
$vendorFile = dirname(__DIR__)  .  '/vendor/autoload.php';
if(file_exists($vendorFile)) {
    require $vendorFile;
} else {
    spl_autoload_register(function ($class) {
        $ns = 'Qiniu';
        $base_dir = dirname(__DIR__) . '/src/Qiniu';
        $prefix_len = strlen($ns);
        if (substr($class, 0, $prefix_len) !== $ns) {
            return false;
        }
        $class = substr($class, $prefix_len);
        $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        //echo $file . PHP_EOL;
        if (is_readable($file)) {
            require $file;
        }

    });
    require_once  dirname(__DIR__) . '/src/Qiniu/functions.php';
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

$configFile = DEMO_ROOT . '.env';
$envData = array();
if(file_exists($configFile)) {
    $envData = parse_ini_file($configFile);
    if(!$envData) {
        $envData = parse_ini_string(file_get_contents($configFile));
    }
}
$qiniuConfig = include DEMO_ROOT . 'config/qiniu.php';
$qiniuConfig['ak']=$envData['qiniu_ak'];
$qiniuConfig['sk']=$envData['qiniu_sk'];
