<?php
/**
 * 删除$bucket 中的文件 $key
 */
require_once dirname(__DIR__) . '/common.php';

// 鉴权类
use Qiniu\Auth;
// bucket管理
use Qiniu\Storage\BucketManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];
// bucket name
$bucket = $qiniuConfig['bucket_name'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
//初始化BucketManager
$bucketMgr = new BucketManager($auth);
$key = 't1/abc/xyz2_1478393529.jpg';//bucket中已经存在的key
$err = $bucketMgr->delete($bucket, $key);
echo "\n====> delete $key : \n";
if ($err !== null) {
    var_dump($err);
} else {
    echo "Success!";
}