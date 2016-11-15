<?php
/**
 * 上传文件 - 不指定上传key（即不定义访问url）
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

// 生成上传 Token
$token = $auth->uploadToken($bucket);

// 要上传文件的本地路径
$filePath = DEMO_ROOT . 'static/img/abc.jpg';
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();

// 调用 UploadManager 的 putFile 方法进行文件的上传。  不定义$key直接上传，唯一不好的是同文件上传（文件内容未修改的情况下），返回同一个key,即不覆盖
list($ret, $err) = $uploadMgr->putFile($token, null, $filePath);
echo "\n====> putFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
/**
====> putFile result:
array(2) {
["hash"]=>
string(28) "FrCL5445_2no3fGhXQQ3GeUtA4ey"
["key"]=>
string(28) "FrCL5445_2no3fGhXQQ3GeUtA4ey"
}
原图格式：http://七牛的图片域名/t1/abc.jpg
    http://ogazeaa9c.bkt.clouddn.com/FrCL5445_2no3fGhXQQ3GeUtA4ey
缩略图： http://ogazeaa9c.bkt.clouddn.com/FrCL5445_2no3fGhXQQ3GeUtA4ey?imageView2/1/h/100
 缩略图指定宽高： http://ogazeaa9c.bkt.clouddn.com/FrCL5445_2no3fGhXQQ3GeUtA4ey?imageView2/1/h/100/w/300
 http://图片域名/path/to?imageView2/缩略图模式0-5/缩略图参数名如w/参数值如100/h/200
 访问同时加水印：管道方式
http://ogazeaa9c.bkt.clouddn.com/FrCL5445_2no3fGhXQQ3GeUtA4ey?imageView2/1/h/100/w/300|watermark/1/image/aHR0cDovL3d3dy5iMS5xaW5pdWRuLmNvbS9pbWFnZXMvbG9nby0yLnBuZw==
 */