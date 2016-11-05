### qiniusdk
七牛phpsdk，上传文件和访问文件，文件有图片，word，pdf等


###目录结构说明
HTTP 目录主要包含了一些对 http 进行封装的类。
Storage 目录主要包含两大块：Bucket中文件的管理和文件的上传。
Processing 目录主要包含文件的处理，文件处理又包含两个方面：同步处理和异步处理。


###签权
上传鉴权，下载签权， 还是回调的签权 均使用类Qiniu\Auth
