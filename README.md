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

###图片处理 --数据处理
   http://developer.qiniu.com/code/v6/api/kodo-api/image/index.html
- 图片基本处理 (imageView2)
- 图片高级处理 (imageMogr2)
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
