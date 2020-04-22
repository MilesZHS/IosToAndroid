<?php
require 'php-sdk-7.2.10/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
class Upload{
    public function __construct()
    {
    }

    public function upload($filePath='',$extension = ''){
        if ($filePath == ''){
            return new Error('文件不存在');
        }
        //用于签名的公钥和私钥
        $accessKey = 'X6KlJ0aACNyzYNeiuZcVAYIIjVO8yS8T-f8_CWLX';
        $secretKey = 'oKtIafO9xkY0iMZ9ofR50Gwr4JyqJydzyRESwtvj';

//初始化鉴权对象
        $auth = new Auth($accessKey,$secretKey);
        $bucket = 'turtle-qdu';

        //自定义上传回复凭证
	    $expires = 3600;
	    $returnBody = '{"key":"$(key)","hash":"$(etag)","width":$(imageInfo.width),"height":"$(imageInfo.height)"}';
	    $policy = array(
	    	'returnBody'    =>  $returnBody
	    );
//生成上传token
//        $token = $auth->uploadToken($bucket,null,$expires,$policy,true);
	    $token = $auth->uploadToken($bucket);
//        echo $token;

//文件路径
//        $filePath = $data['filePath'];

//上传七牛云后保存的文件名
	    if ($extension == ''){
	    	$key = time();
	    }else{
		    $key = time().'___'.$extension;
	    }
        $key1 = $key;

//构建UploadManager对象
        $uploadMgr = new UploadManager();

        list($ret,$err) = $uploadMgr->putFile($token,$key,$filePath);
//        return $key1;
        if ($err !== null){
//        	var_dump($err);
            return $err;
        }else {
//        	var_dump($ret);
            return $ret;
        }
    }
}


