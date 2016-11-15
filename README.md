### qiniusdk
七牛phpsdk，上传文件和访问文件，文件有图片，word，pdf等


###目录结构说明
HTTP 目录主要包含了一些对 http 进行封装的类。
Storage 目录主要包含两大块：Bucket中文件的管理和文件的上传。
Processing 目录主要包含文件的处理，文件处理又包含两个方面：同步处理和异步处理。


###签权
上传鉴权，下载签权， 还是回调的签权 均使用类Qiniu\Auth


###跨域
Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size
Access-Control-Allow-Methods: OPTIONS, HEAD, POST
Access-Control-Allow-Origin: *

###图片处理Api --数据处理
   http://developer.qiniu.com/code/v6/api/kodo-api/image/index.html
   http://developer.qiniu.com/code/v6/api/kodo-api/image/imageview2.html
- 图片基本处理 (imageView2)
    此接口支持处理的原图片格式有psd、jpeg、png、gif、webp、tiff、bmp
    支持图片互相转换的格式有：jpg，gif，png，webp
    原图转为webp格式：
        http://ogazeaa9c.bkt.clouddn.com/pay.jpg?imageView2/2/format/webp
    webp转jpg：
        http://ogazeaa9c.bkt.clouddn.com/pay.webp?imageView2/2/format/jpg

    获取图片信息：
	http://ogazeaa9c.bkt.clouddn.com/pay.webp?imageView2/2/format/jpg|imageInfo
	响应： {"format":"jpeg","width":657,"height":462,"colorModel":"ycbcr"}
	http://ogazeaa9c.bkt.clouddn.com/pay.webp?imageInfo
	响应： {"format":"webp","width":657,"height":462,"colorModel":"ycbcr"}
    获取图片exif信息（数码相机的照片），如果信息不存在返回错误json：
	http://ogazeaa9c.bkt.clouddn.com/pay.webp?exif  返回 {"error":"no exif data"}
``````
exif正确格式返回：
 {
     "DateTime" : {
        "type" : 2,
        "val" : "2011:11:19 17:09:23"
     },
     "ExposureBiasValue" : {
        "type" : 10,
        "val" : "0.33 EV"
     },
     "ExposureTime" : {
        "type" : 5,
        "val" : "1/50 sec."
     },
     "Model" : {
        "type" : 2,
        "val" : "Canon EOS 600D"
     },
     "ISOSpeedRatings" : {
        "type" : 3,
        "val" : "3200"
     },
     "ResolutionUnit" : {
        "type" : 3,
        "val" : " 英寸"
     },

     ...后续内容已省略...
  }
``````
	获取图片的平均颜色值： http://ogazeaa9c.bkt.clouddn.com/che.jpg?imageAve  返回 {"RGB":"0x716c67"}
- 图片高级处理 (imageMogr2)
    支持处理的原图片格式有 psd、jpeg、png、gif、webp、tiff、bmp
    图片格式转换,支持jpg、gif、png、webp
- 图片基本信息 (imageInfo)
- 图片EXIF信息 (exif)
- 图片水印处理 (watermark)
    - 图片水印 watermark/1/
    - 文字水印 watermark/2/
    - 打多个水印 watermark/3/
    - 水印： http://developer.qiniu.com/code/v6/api/kodo-api/image/watermark.html
- 图片平均色调 (imageAve)

###other
http://www.plupload.com/

``````
通过get方式，参数ak和bucket名获取bucket主机信息：
    http://uc.qbox.me/v1/query?ak=ak值bucket=test-bucket
响应内容如下：
{"ttl":86400,
  "http":{"io":["http://iovip.qbox.me"],
	        "up":["http://up.qiniu.com","http://upload.qiniu.com","-H up.qiniu.com http://183.136.139.16"]
	},
  "https":{"io":["https://iovip.qbox.me"],"up":["https://up.qbox.me"]}
}
``````
###定义图片样式
解决url?参数过多，复杂等问题
访问格式：http://domain/文件key-样式名
样式名 webp 值为 imageView2/2/format/webp
访问http://ogazeaa9c.bkt.clouddn.com/pay.jpg-webp 等价于
    http://ogazeaa9c.bkt.clouddn.com/pay.jpg?imageView2/2/format/webp
    

