<?php
/**
 * 把文本内容上传到服务器
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
// 上传到七牛后保存的文件名,即访问地址（http://og54iil9t.bkt.clouddn.com/t1/abc.jpg）
//$key = 't1/abc.jpg'; //文件地址已经存在则不能再上传除非换不同的url path地址
$string = <<<EOT
 how are you?
fine ,sq
EOT;
// 初始化 UploadManager 对象并进行文件的上传。
$uploadMgr = new UploadManager();
list($ret, $err) = $uploadMgr->put($token, null, $string);
echo "\n====> putFile result: \n";
if ($err !== null) {
    var_export($err);
} else {
    var_dump($ret);
}
/**
array(2) {
["hash"]=>string(28) "FkM7oG62ev9-lH4stkdkD1p4xJGK"
["key"]=>string(28) "FkM7oG62ev9-lH4stkdkD1p4xJGK"  返回的访问key即url的path
}

格式：http://七牛的图片域名/key值
http://og54iil9t.bkt.clouddn.com/FkM7oG62ev9-lH4stkdkD1p4xJGK
 */