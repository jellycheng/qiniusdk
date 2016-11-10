<?php
/**
 * 上传到七牛
 */
require_once dirname(__DIR__) . '/common.php';
use Qiniu\Auth;
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
// 要上传的空间bucket名
$bucket = $qiniuConfig['bucket_name'];
$qiniuUpToken = $auth->uploadToken($bucket);

$filename= $_FILES["file"]["name"];
$tmpfilename= $_FILES["file"]["tmp_name"];
// 调用 UploadManager 的 putFile 方法进行文件的上传。
$uploadMgr = new \Qiniu\Storage\UploadManager();
list($ret, $err) = $uploadMgr->putFile($qiniuUpToken, $filename, $tmpfilename);
echo "\n====> upFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
/**
====> upFile result:
array(2) {
["hash"]=>string(28) "Fsk2TLzs9rLU3aHwfi6zpalzwAiv"
["key"]=>string(7) "pay.jpg"
}
 */
