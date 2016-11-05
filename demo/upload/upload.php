<?php
/**
 * 上传文件
 */
require_once dirname(__DIR__) . '/common.php';

// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);

// 要上传的空间
$bucket = $qiniuConfig['bucket_name'];

// 生成上传 Token
$token = $auth->uploadToken($bucket);

// 要上传文件的本地路径
$filePath = DEMO_ROOT . 'static/img/abc.jpg';
// 上传到七牛后保存的文件名,即访问地址（http://og54iil9t.bkt.clouddn.com/t1/abc.jpg）
$key = 't1/abc.jpg'; //文件地址已经存在则不能再上传除非换不同的url path地址

//$filePath = DEMO_ROOT . 'static/img/xyz.jpg';
//$key = 't1/abc.jpg';

// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();

// 调用 UploadManager 的 putFile 方法进行文件的上传。
list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
echo "\n====> putFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
/**
array(2) {
["hash"]=>string(28) "FrCL5445_2no3fGhXQQ3GeUtA4ey"
["key"]=>string(10) "t1/abc.jpg"
}
格式：http://七牛的图片域名/t1/abc.jpg
http://og54iil9t.bkt.clouddn.com/t1/abc.jpg
 */