<?php
/**
 * 第三方资源抓取，把第三方的图片上传到七牛服务器作为自己的资源
 */

require_once dirname(__DIR__) . '/common.php';

// 鉴权类
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
$bmgr = new BucketManager($auth);
// 要上传的空间
$bucket = $qiniuConfig['bucket_name'];
//要抓取的图片
$thirdUrl = 'http://img18.fn-mart.com/pic/3958133adbde2c721d27/Bn82TTs2FTflBdUdjn/1xmyeaVaDaBGVx/CsmRslcjMUmACjRSAABd01SLEaU624_400x400.jpg';
$key = 'c_' . time() . '.jpg';//存在七牛的url

list($ret, $err) = $bmgr->fetch($thirdUrl, $bucket, $key);
echo "=====> fetch $thirdUrl to bucket: $bucket  key: $key\n";
if ($err !== null) {
    var_dump($err);
} else {
    echo 'Success' . PHP_EOL;
}
