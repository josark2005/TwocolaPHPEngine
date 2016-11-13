<?php
/*
**Normal Storage 类
**Auther:JK惟易
*/
class StorageNormal{
	public $Prefix = "";	//设置前缀
	//文件是否存在，存在true，否则false
	public function FileExist($filename){
		return file_exists($this->Prefix.$filename);
	}
	//读入文件，成功返回文件内容，否则false
	public function Read($filename){
		$filename = $this->Prefix.$filename;
		//判断文件是否存在
		if(!$this->FileExist($filename)){
			return false;
		}else{
			$handle = fopen($filename,"r");
			if(!$handle){
				return false;
			}
			$content = fread($handle,filesize($filename));
			fclose($handle);
			return $content;
		}
	}
	//创建空文件，文件已存在则返回false
	public function CreateEmptyFile($filename){
		$filename = $this->Prefix.$filename;
		if($this->FileExist($filename)){
			return false;	//文件已存在
		}else{
			$handle = fopen($filename,"w");
			if(!$handle){
				return false;	//创建失败
			}else{
				fclose($handle);
				return true;	//创建成功
			}
		}
	}
	//创建并存储文件（内容写入空文件或不存在的文件）
	public function CreateSave($filename,$content){
		$filename = $this->Prefix.$filename;
		$handle = fopen($filename,"w");
		if(!$handle){
			return false;
		}
		$result = fwrite($handle,$content);
		fclose($handle);
		return $result;
	}
	//存储文件（内容写入已存在的文件）position的值为h(head)时写入文件头，为a(add)时写入文件尾，默认写入文件尾
	public function Save($filename,$content,$position="a"){
		$filename = $this->Prefix.$filename;
		if($position=="h"){
			$position="r+";
		}else{
			$position="a";
		}
		if($this->FileExist($filename)){
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
	public function DelFile($filename){
		$filename = $this->Prefix.$filename;
		if($this->FileExist($filename)){
			return unlink($filename);
		}else{
			return false;
		}
	}
	//文件夹是否存在
	public function FolderExist($name){
		return is_dir($this->Prefix.$name);
	}
	//文件夹是否为空，文件夹不存在则返回false
	public function FolderEmpty($name){
		$name = $this->Prefix.$name;
		if($this->FolderExist($name)){
			$handle = opendir($name);
			$i = 0;
			while(readdir($handle)){
				$i++;
			}
			if($i>2){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
		closedir($handle);
	}
	//创建文件夹
	public function CreateFolder($name){
		return mkdir($this->Prefix.$name);
	}
	//删除文件夹，empty为true时只删除空文件夹，非空文件夹将返回false
	public function DelFolder($name,$empty=true){
		$name = $this->Prefix.$name;
		if($empty==true){
			//只删除空文件夹
			if($this->FolderExist($name) && $this->FolderEmpty($name)){
				rmdir($name);
			}else{
				return false;
			}
		}else{
			$handle = opendir($name);
			while($n = readdir($handle)){
				if($n!="." && $n!=".."){
					$tname = $name.DIRECTORY_SEPARATOR.$n;
					//判断是文件还是文件夹
					if($this->FolderExist($tname)){
						//是文件夹
						$this->DelFolder($tname,false);
					}else{
						//不是文件夹
						unlink($tname);
					}
				}
			}
			closedir($handle);
			if(rmdir($name)){
				return true;
			}else{
				return false;
			}
		}
	}
}
?>
