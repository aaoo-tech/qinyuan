<?php
require_once __DIR__ . '/vendor/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
$accessKeyId = "LTAIsUy4pheZeUOf";
$accessKeySecret = "jwaQKGAl4OyQjv8ZV0NB5YGLTi6fK1";
$endpoint = "oss-cn-shenzhen.aliyuncs.com";
$bucketName = "aiya-pic";
$object = "jiapu/test_logo_1.png";
try {
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
    var_dump($ossClient);
} catch (OssException $e) {
    print $e->getMessage();
}
echo '1';
$_res = $ossClient->uploadFile($bucketName, $object, __DIR__ ."/test_logo.png");
var_dump($_res);