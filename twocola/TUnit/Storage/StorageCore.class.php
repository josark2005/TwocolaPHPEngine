<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ More Teamwork ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola STudio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------
/*
** TCE引擎基本存储核心
** Ver 1.1
*/
namespace TUnit\Storage;
class StorageCore{
	//文件是否存在，存在true，否则false
	static public function FileExist($filename){
		return is_file($filename);
	}
	//读入文件，成功返回文件内容，否则false
	static public function Read($filename){
		if( !self::FileExist($filename) ) return false ;
		$content = file_get_contents($filename) ;
		return $content;
	}
	//创建并存储文件（内容写入空文件或不存在的文件）
	static public function CreateSave($filename,$content){
		if( is_file($filename) ) return false ;	//文件已存在
		$dir = dirname($filename);
		if( !is_dir($dir) ) {
			mkdir($dir,0777,true);
		}
		if(false === file_put_contents($filename,$content)) return false ;
		return true;
	}
	//覆盖存储文件
	static public function Put($filename,$content){
		return file_put_contents($filename,$content);
	}
	//存储文件（头）
	static private function SaveEnd($filename,$content){
		$position="a";
		if(self::FileExist($filename)){
			$handle = fopen($filename,$position);
			if(!$handle){
				return false;
			}
			$result = fwrite($handle,$content);
			fclose($handle);
			return $result;
		}else{
			return false;
		}
	}
	//存储文件（尾）
	static private function SaveHead($filename,$content){
		$position="h";
		if(self::FileExist($filename)){
			$handle = fopen($filename,$position);
			if(!$handle){
				return false;
			}
			$result = fwrite($handle,$content);
			fclose($handle);
			return $result;
		}else{
			return false;
		}
	}
	//删除文件，文件不存在则返回false
	static public function DelFile($filename){
		return is_file($filename) ? unlink($filename) : false ;
	}

	//文件夹是否存在
	static public function FolderExist($name){
		return is_dir($name);
	}

	//文件夹是否为空，文件夹不存在则返回false
	static public function FolderEmpty($name){
		$name = $name;
		if(self::FolderExist($name)){
			$handle = opendir($name);
			$i = 0;
			while(readdir($handle)){
				$i++;
			}
			closedir($handle);
			if($i>2){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	//创建文件夹
	static public function CreateFolder($name){
		return mkdir($name,0777,true);
	}
	//创建空文件，文件已存在则返回false
	static public function CreateEmptyFile($filename){
		self::CreateSave($filename,"");
	}
}
?>
