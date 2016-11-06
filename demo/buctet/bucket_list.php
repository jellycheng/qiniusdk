<?php
/**
 * 获取所有bucket名
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
$buckets = $bucketMgr->buckets();
var_export($buckets);
/**
array (
0 =>array (
    0 => 'test-bucket',
    1 => 'testpri-bucket',
),
1 => NULL,
)

 */