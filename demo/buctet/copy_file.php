<?php
/**
 * 在指定的bucket中复制文件
 * 可将文件从文件$key 复制到文件$key2。 可以在不同bucket复制
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

$key='t1/abc.jpg';//bucket中已经存在的key
$key2 = 't1/abc/xyz2_'.time().'.jpg';//新名key， 前提是新key在服务器中不存在
$err = $bucketMgr->copy($bucket, $key, $bucket, $key2);
echo "\n====> copy $key to $key2 : \n";
if ($err !== null) {
    var_dump($err);
} else {
    echo "Success!";
}