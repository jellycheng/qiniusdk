<?php
/**
 * 七牛通知业务方的内容  -- 验证安全及合法性
 * 收到的是post请求
 */
$notifyBody = 'input: ' . file_get_contents('php://input');//input: filename=20161110221905%2Ft1%2Fabc.jpg&filesize=21349
$notifyBody .= '||get: ' . var_export($_GET, true);
$notifyBody .= '||post: ' . var_export($_POST, true);
$notifyBody .= '||server: ' . var_export($_SERVER, true);


// 业务服务器处理通知信息， 这里直接打印在log中
//error_log($notifyBody . PHP_EOL, 3, '/tmp/qiniu.log');

//-- 验证安全及合法性
require_once dirname(__DIR__) . '/common.php';

// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new \Qiniu\Auth($accessKey, $secretKey);

//获取回调的body信息
//$callbackBody = file_get_contents('php://input');
$callbackBody = 'filename=20161110224503%2Ft1%2Fabc.jpg&filesize=21349&hash=FrCL5445_2no3fGhXQQ3GeUtA4ey&userid=123456&phone=13712345678';
//回调的contentType
$contentType = isset($_SERVER['HTTP_CONTENT_TYPE'])?$_SERVER['HTTP_CONTENT_TYPE']:'application/x-www-form-urlencoded';
//回调的签名信息，可以验证该回调是否来自七牛
//$authorization = $_SERVER['HTTP_AUTHORIZATION'];
$authorization = 'QBox bc2Zn_8gNEwr0xGLYES7AbPdtJ0_YWgxnTBbtBOW:8EhfSwi2XsLX9X0rRh5u9wjxK-8=';
//七牛回调的url，具体可以参考：http://developer.qiniu.com/docs/v6/api/reference/security/put-policy.html
$url = 'http://zentao.qianguopai.com/qiniu_notify.php';
$isQiniuCallback = $auth->verifyCallback($contentType, $authorization, $url, $callbackBody);
if($isQiniuCallback) {
    echo 'ok通知合法';
} else {
    echo '通知来源不合法';
}
echo PHP_EOL;

$res = [
        'success'=>'true',
        'name'=>'cjs_' . date('YmdHis') . '_' . (isset($_POST['filename'])?$_POST['filename']:''), //设置好url地址返回七牛
];
echo json_encode($res);

