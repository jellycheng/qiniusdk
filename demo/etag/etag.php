<?php
/**
 * 算出文件的etag值
 */
require_once dirname(__DIR__) . '/common.php';
use Qiniu\Etag;

list($etag, $err) = Etag::sum(__file__);
if ($err == null) {
    echo  "Etag: $etag";//Etag: luLlETg8Fqen9yylHWtqVo4RZznS
} else {
    var_dump($err);
}
