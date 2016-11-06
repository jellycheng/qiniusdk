<?php
/**
 * 在指定的bucket中重命名文件
 * 给资源进行重命名，本质为move操作
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

$key='t1/abc/xyz2_1478393310.jpg';//bucket中已经存在的key
$key2 = 't1/abc/xyz2_xyz2_1478393310_'.time().'.jpg';//新名key， 前提是新key在服务器中不存在
$err = $bucketMgr->rename($bucket, $key, $key2);
echo "\n====> rename $key to $key2 : \n";
if ($err !== null) {
    var_dump($err);
} else {
    echo "Success!";
}