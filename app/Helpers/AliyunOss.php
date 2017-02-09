<?php
namespace App\Helpers;

require_once __DIR__ . '/oss/vendor/autoload.php';
require_once __DIR__ . '/Config.php';

use OSS\OssClient;
use OSS\Core\OssException;

/**
 * 阿里云 oss
 *
 * @return data
 */

class AliyunOss
{
    const endpoint = Config::OSS_ENDPOINT;
    const accessKeyId = Config::OSS_ACCESS_ID;
    const accessKeySecret = Config::OSS_ACCESS_KEY;
    const bucket = Config::OSS_TEST_BUCKET;

    public static function ossUploadFile($_params) {
        $object = "jiapu/".$_params['filename'];
        try {
            $ossClient = new OssClient(self::accessKeyId, self::accessKeySecret, self::endpoint);
            $_result = $ossClient->uploadFile(self::bucket, $object, $_params['filepath']);
            return $_result;
        } catch (OssException $e) {
            return false;
        }
    }

    /**
     * get_object_to_local_file
     *
     * 获取object
     * 将object下载到指定的文件
     *
     * @param OssClient $ossClient OSSClient实例
     * @param string $bucket 存储空间名称
     * @return null
     */
    public static function ossGetObjectToLocalFile($_params)
    {
        $object = "jiapu/".$_params['filename'];
        $localfile = "storage/uploads/".$_params['filename'];
        $options = array(
            OssClient::OSS_FILE_DOWNLOAD => $localfile,
        );
        try{
            $ossClient = new OssClient(self::accessKeyId, self::accessKeySecret, self::endpoint);
            $ossClient->getObject(self::bucket, $object, $options);
            return true;
        } catch(OssException $e) {
            return false;
        }
    }
}