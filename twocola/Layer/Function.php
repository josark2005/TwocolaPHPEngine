<?php
/*C函数 读取配置 */
function C($var="none",$content=""){
  $conf = TCE\IncReader::IO();
  if(empty($content)){
    if(!$conf->ConfigExists($var)){
      //读取常量
      return (defined($var)) ? constant($var) : false;
    }else{
      return $conf->ReadPointedConfig($var);  //返回配置
    }
  }else{
    $conf->EditConfig($var,$content); //修改配置
  }
}
/*M函数（连接数据库）*/
function M($table_name){
  $db = new \Database(C("APP_DB_HOST"),C("APP_DB_PORT"),C("APP_DB_NAME"),C("APP_DB_USERNAME"),C("APP_DB_PASSWORD"));
  return $db->table(C("APP_DB_PREFIX").$table_name);
}
/*U函数(生成链接)*/
function U($paths){
  $pattern = "/(.+)\?(.+)$/U";
  $preg = preg_match($pattern,$paths,$match);
  if($preg!=0){
    $path = $match[1];
    $get = "?".$match[2];
  }else{
    $path = $paths;
    $get = "";
  }
  $count = substr_count($path,"/");
  if($count<=1){
    $path = PI_MODULE."/".$path;
  }
  if(PATH=="/"){
    return PATH.$path.C("SYSTEM_SUFFIX").$get;
  }else{
    return PATH."/".$path.C("SYSTEM_SUFFIX").$get;
  }
}
/*E函数（生成报错）*/
function E($err){
  if(APP_DEBUG === true){
    exit("<!DOCTYPE html><html lang='zh-cn'><head><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><meta charset='utf-8'><title>系统发生错误</title></head><body><h1>系统发生错误</h1><p>{$err}</p><small>TCE框架-Beta</small></body></html>");
  }else{
    exit("<!DOCTYPE html><html lang='zh-cn'><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'><title>系统发生错误</title></head><body><h1>系统发生错误</h1><p>您正在访问的页面出现了系统级问题，请稍候再试。</p><small>TCE框架-Beta</small></body></html>");
  }
}
/* Cookie */
function cookie($name='',$value='',$expire=0,$path="/"){
  if($value==null || empty($value)){
    setcookie($name,null,time()-1,$path); //删除
  }else{
    setcookie($name,$value,$expire,$path);
  }
}
/* Vender */
function vender($file){
  if(file_exists(TCE_PATH."/Vender/{$file}")){
    include TCE_PATH."/Vender/{$file}";
    return true;
  }else{
    return false;
  }
}
/* Org */
function org($file){
  if(file_exists(TCE_PATH."/Org/{$file}")){
    include TCE_PATH."/Org/{$file}";
    return true;
  }else{
    return false;
  }
}
/* 获取预置模板 */
function getPresetTpl($name){
  if(file_exists(TCE_PATH."/Tpl/".$name.".tpl")){
    return file_get_contents(TCE_PATH."/Tpl/".$name.".tpl");
  }else{
    return false;
  }
}
/* SendEmail */
function sendEmail($email="simple@domain.com",$title="none",$subject="none",$content="none"){
  vender("PHPMailer/PHPMailerAutoload.php");
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->CharSet = C("EMAIL_CHARSET");
  $mail->Host = C("EMAIL_HOST");
  $mail->SMTPAuth = true;
  $mail->Username = C("EMAIL_ADDRESS");
  $mail->Password = C("EMAIL_PASSWORD");
  $mail->SMTPSecure = 'tls';
  $mail->Port = C("EMAIL_PORT");
  $mail->setFrom('noreply@twocola.com', '两杯可乐网');
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body    = $content;
  if(!$mail->send()){
    return false;
  }else{
    return true;
  }
}
?>
