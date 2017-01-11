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
            return $e->getMessage();
        }
    }
}