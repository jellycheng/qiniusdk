<?php
/**
 * 获取上传文件时需要的token
 */
require_once dirname(__DIR__) . '/common.php';

// 引入鉴权类
use Qiniu\Auth;
// 需要填写你的 Access Key 和 Secret Key
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
// 要上传的空间bucket名
$bucket = $qiniuConfig['bucket_name'];
$upToken = $auth->uploadToken($bucket);
echo $upToken . PHP_EOL;
/**
iaVqon8NHLdORF70QNNazvT-tbhLu3fNLBXTUAxz:ecr0PA-C1jjiJC_bNZY4lm-GNSE=:eyJzY29wZSI6InRlc3QtYnVja2V0IiwiZGVhZGxpbmUiOjE0NzgzNTE1NDMsInVwSG9zdHMiOlsiaHR0cDpcL1wvd
XAucWluaXUuY29tIiwiaHR0cDpcL1wvdXBsb2FkLnFpbml1LmNvbSIsIi1IIHVwLnFpbml1LmNvbSBodHRwOlwvXC8xODMuMTM2LjEzOS4xNiJdfQ==

 */