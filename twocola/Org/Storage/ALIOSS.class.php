<?php
/*
*ALIOSS Storage 类
*Auther:JK惟易
*请在实例化本类前先实例化Normal Storgae类
*/
/*
$config = array(
    'id'     => '',
    'key'    => '',
    'bucket' => '',
    'endpoint' => 'oss-cn-hangzhou.aliyuncs.com'
);
*/
class StorageALIOSS extends StorageNormal{
	public $Storage;
	public function __construct($sto){
		$this->Storage = Alibaba::Storage($sto);
	}
	//文件是否存在
	public function OSSFileExist($filename){
		return $this->Storage->fileExists($filename);
	}
	//读取文件
	public function OSSRead($filename){
		return  $this->Storage->get($filename);
	}
	//*读取文件直本地服务器（若设置del为false本地服务器中已存在同名文件则失败）
	public function OSSReadSave($filename,$path,$del=true){
		if(!$this->FileExist($path)||$del==true){
			return  $this->Storage->get($filename,$path);
		}else{
			return false;
		}
	}
	//创建空文件
	public function OSSCreateEmptyFile($filename,$exp){
		if($exp){
			return  $this->Storage->saveText($filename," ",$exp);
		}else{
			return  $this->Storage->saveText($filename," ");
		}
	}
	//创建并存储文本
	public function OSSCreateTextSave($filename,$content,$exp){
		if($exp){
			return  $this->Storage->saveText($filename,$content,$exp);
		}else{
			return  $this->Storage->saveText($filename,$content);
		}
	}
	//向OSS上传本地文件
	public function OSSSaveFile($filename,$file){
		return $this->Storage->saveFile($filename,$file);
	}
	//删除文件
	public function OSSDelFile($filename){
		return $this->Storage->delete($filename);
	}
	//*获取文件元信息
	public function OSSGetMeta($filename){
		return $this->Storage->getMeta($filename);
	}
	//列出指定目录和文件(列出只能前缀的文件)
	public function OSSListFile($path,$num){
		return $this->Storage->listObject($path,$num);
	}
}
?>
