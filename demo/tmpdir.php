<?php

echo sys_get_temp_dir() . PHP_EOL;

/**
sys_get_temp_dir() . '/.qiniu_phpsdk_hostscache.json';　缓存内容如下：
{"http:iaVqon8NHLdORF70QNNazvT-tbhLu3fNLsWTUAxz:test-bucket":{
            "upHosts":["http:\/\/up.qiniu.com","http:\/\/upload.qiniu.com",
                        "-H up.qiniu.com http:\/\/183.136.139.16"
            ],
            "ioHost":["http:\/\/iovip.qbox.me"],
            "deadline":1478430989}
            }
 其中http:iaVqon8NHLdORF70QNNazvT-tbhLu3fNLBXTUAxz:test-bucket格式是协议:ak值:bucket名


http://uc.qbox.me/v1/query?ak=ak值&&bucket=bucket名
http://uc.qbox.me/v1/query?ak=iaVqon8NHLdORFXXQNNazvT-tbhLu3fNLBXTUAxz&&bucket=test-bucket
返回：
{"ttl":86400,
"http":{"io":["http://iovip.qbox.me"],"up":["http://up.qiniu.com","http://upload.qiniu.com","-H up.qiniu.com http://183.136.139.16"]},
"https":{"io":["https://iovip.qbox.me"],"up":["https://up.qbox.me"]}
}

 */