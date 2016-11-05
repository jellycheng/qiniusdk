<?php
/**
 * 判断指定的bucket中是否存在key（即url ）
 */
require_once dirname(__DIR__) . '/common.php';

// 鉴权类
use Qiniu\Auth;
// bucket管理
use Qiniu\Storage\BucketManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];
// 要上传的空间
$bucket = $qiniuConfig['bucket_name'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
//初始化BucketManager
$bucketMgr = new BucketManager($auth);
// FkM7oG62ev9-lH4stkdkD1p4xJGK , t1/abc.jpg
//$key = 'FkM7oG62ev9-lH4stkdkD1p4xJGK';
$key='t1/abc.jpg';
//获取文件的状态信息
list($ret, $err) = $bucketMgr->stat($bucket, $key);
echo "\n====> $key stat : \n";
if ($err !== null) {
    var_export($err);
} else {
    var_export($ret);
}
/**
====> FkM7oG62ev9-lH4stkdkD1p4xJGK stat :
array (
    'fsize' => 23,
    'hash' => 'FkM7oG62ev9-lH4stkdkD1p4xJGK',
    'mimeType' => 'application/octet-stream',
    'putTime' => 14783458674951012,
)

====> t1/abc.jpg stat :
array (
'fsize' => 21349,
'hash' => 'FrCL5445_2no3fGhXQQ3GeUtA4ey',
'mimeType' => 'image/jpeg',
'putTime' => 14783445873689261,
)

 */