<?php
namespace app\logic;
use OSS\Core\OssException;
use OSS\OssClient;

class Image
{   
    //上传图片
    public function uploadImage($file,$param)
    {


        if (is_array($file)) {

            return $this->imageMultUpload($file,$param);

        }


        $status = $this->getUploadSetting();
        if ($status) {

            return $this->aliOssUpload($file,$param);

        }else{

           return $this->ImageLocalUpload($file,$param);
        
        }
    }

    //
    public function getUploadSetting()
    {
        return 0;
    }

    //多图上传
    public function imageMultUpload($file,$param)
    {
        $status = $this->getUploadSetting();
        
        $imageUrl = [];
        
        if ($status) {

            foreach ($file as $key => $value) {

                $imageUrl[$key] = $this->aliOssUpload($value,$param);
            }

            return $imageUrl;

        }else{

            foreach ($file as $key => $value) {

                $imageUrl[$key] = $this->ImageLocalUpload($value,$param);
            }

            return $imageUrl;

        }
    }


    //图片本地上传
    public function ImageLocalUpload($file,$param)
    {
        return \think\facade\Filesystem::disk('public')->putFile('topic', $file);
    }


    //上传至阿里云
    public function aliOssUpload($file,$param)
    {

        $accessKeyId = 'LTAIc9QzMqt4UneS';
        $accessKeySecret = 'BTxcFrnQw0Q3phgH5lhHkdetEdXANy';
        $endpoint = 'http://oss-cn-beijing.aliyuncs.com/';
        $bucket = 'swechat-img';
        $object = $file->getOriginalName();
        $content = $file->getPathName();

        try{
            
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $result = $ossClient->uploadFile($bucket, $object, $content);
            return isset($result['info']['url']) ? $result['info']['url']:'';
            // return 
        } catch(OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }


    }

    //处理编辑器图片
    public function editorImage($data)
    {
        if (is_array($data)) {

            $result = [];
            foreach ($data as $key => $value) {
                $result[$key] = getUrlPath($value);
            }
            return $result;
        }else{
            return [getUrlPath($data)];
        }
    }

}