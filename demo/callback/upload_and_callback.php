<?php
/**
 * 上传文件&设置回调地址
 */
require_once dirname(__DIR__) . '/common.php';

// 鉴权类
use Qiniu\Auth;
// 上传类
use Qiniu\Storage\UploadManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);

// 要上传的空间
$bucket = $qiniuConfig['bucket_name'];
// 可参考文档: http://developer.qiniu.com/docs/v6/api/reference/security/put-policy.html
$policy = array(
    'callbackUrl' => 'http://zentao.qianguopai.com/qiniu_notify.php',
    //'callbackFetchKey'=>0,
    'callbackBody' => 'filename=$(fname)&filesize=$(fsize)&hash=$(etag)&userid=123456&phone=13712345678'
);
//filename=20161110222651%2Ft1%2Fabc.jpg&filesize=21349&hash=FrCL5445_2no3fGhXQQ3GeUtA4ey&userid=123456&phone=13712345678 这是回调内容
// 生成上传 Token
$token = $auth->uploadToken($bucket, null, 3600, $policy);

// 要上传文件的本地路径
$filePath = DEMO_ROOT . 'static/img/abc.jpg';
// 上传到七牛后保存的文件名,即访问地址（http://og54iil9t.bkt.clouddn.com/t1/abc.jpg）
$key = date('YmdHis').'/t1/abc.jpg'; //文件地址已经存在则不能再上传(除非换不同的url path地址)
//$key = null;
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();

// 调用 UploadManager 的 putFile 方法进行文件的上传。
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
echo "\n====> putFile result: \n";
if ($err !== null) {
    echo "error: " . PHP_EOL;
    var_dump($err);
} else {
    var_dump($ret);
}
/**
====> putFile result:
array(2) {
["name"]=>string(44) "cjs_20161110224459_20161110224503/t1/abc.jpg"
["success"]=>string(4) "true"
}

 */