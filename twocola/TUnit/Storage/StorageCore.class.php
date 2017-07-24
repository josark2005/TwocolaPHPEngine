<?php
// +----------------------------------------------------------------------
// | Twocola PHP Engine [ DO IT　EASY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 Twocola Studio All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Jokin <327928971@qq.com>
// +----------------------------------------------------------------------
/*
** TCE引擎基本存储核心
** Ver 1.2
*/
namespace TUnit\Storage;
class StorageCore{
	/**
	 * 判断文件是否存在
	 * @param  string $filename
	 * @return boolean
	**/
	static public function FileExist($filename){
		return is_file($filename);
	}
	/**
	 * 读入文件
	 * @param  string $filename
	 * @return boolean
	**/
	static public function Read($filename){
		if( !self::FileExist($filename) ) return false ;
		$content = file_get_contents($filename) ;
		return $content;
	}
	/**
	 * 创建并写入文件
	 * @param  string $filename
	 * @param  string $content
	 * @return boolean
	**/
	static public function CreateSave($filename,$content){
		if( is_file($filename) ) return false ;	//文件已存在
		$dir = dirname($filename);
		if( !is_dir($dir) ) {
			mkdir($dir,0777,true);
		}
		if(false === file_put_contents($filename,$content)) return false ;
		return true;
	}
	/**
	 * 覆盖存储文件
	 * @param  string $filename
	 * @param  string $content
	 * @return boolean
	**/
	static public function Put($filename,$content){
		return file_put_contents($filename,$content);
	}
	/**
	 * 在文件头部存储
	 * @param  string $filename
	 * @param  string $content
	 * @return boolean
	**/
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
	/**
	 * 在文件尾部存储
	 * @param  string $filename
	 * @param  string $content
	 * @return boolean
	**/
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
	/**
	 * 删除文件
	 * @param  string $filename
	 * @return boolean
	**/
	static public function DelFile($filename){
		return is_file($filename) ? unlink($filename) : false ;
	}

	/**
	 * 判断文件夹是否存在
	 * @param  string $name
	 * @return boolean
	**/
	static public function FolderExist($name){
		return is_dir($name);
	}

	/**
	 * 判断文件夹是否为空
	 * @param  string $name
	 * @return boolean
	**/
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
	/**
	 * 创建文件夹
	 * @param  string $name
	 * @return boolean
	**/
	static public function CreateFolder($name){
		return mkdir($name,0777,true);
	}
	/**
	 * 创建空文件
	 * @param  string $filename
	 * @return bool
	**/
	static public function CreateEmptyFile($filename){
		self::CreateSave($filename,"");
	}
	/**
	* 删除目录及目录下所有文件或删除指定文件
	* @param string $path   待删除目录路径
	* @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
	* @return bool 返回删除状态
	**/
	static public function DelDir($path, $delDir = true) {
    $handle = opendir($path);
    if ($handle) {
      while (false !== ( $item = readdir($handle) )) {
        if ($item != "." && $item != "..")
        is_dir("$path/$item") ? self::DelDir("$path/$item", $delDir) : unlink("$path/$item");
      }
      closedir($handle);
      if ($delDir)
        return rmdir($path);
    }else {
      if (file_exists($path)) {
        return unlink($path);
      } else {
        return FALSE;
      }
    }
	}

}
?>
