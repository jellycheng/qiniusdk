<?php
/**
 * 业务方直接通过网页上传文件到七牛
 */

$qiniuUpToken = '';
require_once dirname(__DIR__) . '/common.php';
use Qiniu\Auth;
$accessKey = $qiniuConfig['ak'];
$secretKey = $qiniuConfig['sk'];

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);
// 要上传的空间bucket名
$bucket = $qiniuConfig['bucket_name'];
$qiniuUpToken = $auth->uploadToken($bucket);

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<form method="post" action="http://up.qiniu.com" enctype="multipart/form-data">
    <input name="token" type="hidden" value="<?php echo $qiniuUpToken;?>">
    <input name="file" type="file" id="id_file" /><br><br>
   设置url访问path： <input id="id_key" name="key" type="text" /><br><br>
    <input type="submit" value="上传到七牛"/>
</form>

<pre>
    上传成功会返回json字符串，如下：
    {
        hash: "Fi9MgyJIjfgeQTttXgTn5DZrZEK9",
        key: "Fi9MgyJIjfgeQTttXgTn5DZrZEK9"
    }

    原图访问地址： http://ogazeaa9c.bkt.clouddn.com/key值
        如：http://ogazeaa9c.bkt.clouddn.com/2345截图20151231104525.png
        截图： http://ogazeaa9c.bkt.clouddn.com/2345截图20151231104525.png?imageView2/1/w/200/h/200
            http://ogazeaa9c.bkt.clouddn.com/2345截图20151231104525.png?imageView2/1/w/10/h/10
</pre>

</body>
</html>
<script>
    window.onload = function() {
        $file = document.getElementById('id_file');
        $file.onchange = function(){
            $key = $file.value.split(/(\\|\/)/g).pop();
            document.getElementById('id_key').value = $key;

        };

    }
</script>