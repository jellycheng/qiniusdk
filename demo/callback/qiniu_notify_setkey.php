<?php
/**
 * 七牛通知业务方的内容
 * 收到的是post请求
 */
$notifyBody = 'input: ' . file_get_contents('php://input');//input: filename=20161110221905%2Ft1%2Fabc.jpg&filesize=21349
$notifyBody .= '||get: ' . var_export($_GET, true);
$notifyBody .= '||post: ' . var_export($_POST, true);
$notifyBody .= '||server: ' . var_export($_SERVER, true);

//input: filename=20161110222651%2Ft1%2Fabc.jpg&filesize=21349&hash=FrCL5445_2no3fGhXQQ3GeUtA4ey&userid=123456&phone=13712345678

// 业务服务器处理通知信息， 这里直接打印在log中
error_log($notifyBody . PHP_EOL, 3, '/tmp/qiniu.log');

$name = 'cjs2_' . date('YmdHis') . '_' . (isset($_POST['filename'])?$_POST['filename']:'');
$res = [
    'key'=>$name,
    'payload'=>[
        'success'=>'true',
        'name'=>$name, //设置好url地址返回七牛
    ]
];
echo json_encode($res);

/**
post: array (
'filename' => 'filename',
'filesize' => '26834',
'hash' => 'FlA4NjQleDOta9IYhbFft5w7iYrK',
'userid' => '123456',
'phone' => '13712345678',
)
 */