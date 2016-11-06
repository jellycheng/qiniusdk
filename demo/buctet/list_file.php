<?php
/**
 * 在指定的bucket中获取文件列表
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

// 要列取文件的公共前缀
$prefix = '';
// 上次列举返回的位置标记，作为本次列举的起点信息。
$marker = 'eyJjIjowLCJrIjoiY18xNDc4MzU1MjE3LmpwZyJ9';  //eyJjIjowLCJrIjoiY18xNDc4MzU1MjE3LmpwZyJ9
// 本次列举的条目数
$limit = 3;

// 列举文件
list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
if ($err !== null) {
    echo "\n====> list file error : \n";
    var_export($err);
} else {
    echo "Marker: $marker\n";
    echo "\nList Iterms====>\n";
    var_export($iterms);
}
/**
Marker: eyJjIjowLCJrIjoiY18xNDc4MzU1MjE3LmpwZyJ9
List Iterms====>
array (
0 =>array (
    'key' => 'FkM7oG62ev9-lH4stkdkD1p4xJGK',
    'hash' => 'FkM7oG62ev9-lH4stkdkD1p4xJGK',
    'fsize' => 23,
    'mimeType' => 'application/octet-stream',
    'putTime' => 14783458674951012,
),
1 =>array (
    'key' => 'c_1478355067.jpg',
    'hash' => 'FqUmSSIJGEPTd_wmJ5q0yhTvmhGi',
    'fsize' => 24040,
    'mimeType' => 'image/jpeg',
    'putTime' => 14783550658987690,
),
2 =>array (
    'key' => 'c_1478355217.jpg',
    'hash' => 'FqUmSSIJGEPTd_wmJ5q0yhTvmhGi',
    'fsize' => 24040,
    'mimeType' => 'image/jpeg',
    'putTime' => 14783552159194902,
    ),
)

 */