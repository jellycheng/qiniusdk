<?php
require_once __DIR__ . '/common.php';

use Qiniu\Auth;

// 用于签名的公钥和私钥. http://developer.qiniu.com/docs/v6/api/overview/security.html#aksk
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 初始化签权对象。
$auth = new Auth($accessKey, $secretKey);
