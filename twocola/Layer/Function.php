<?php
/*M函数（连接数据库）*/
function M($table_name){
  $db = new Database(APP_DB_HOST,APP_DB_PORT,APP_DB_NAME,APP_DB_USERNAME,APP_DB_PASSWORD);
  return $db->table(APP_DB_PREFIX.$table_name);
}
/*U函数(生成链接)*/
function U($paths){
  // return $path.$paths;
  $pattern = "/(.+)\?(.+)$/U";
  $preg = preg_match($pattern,$paths,$match);
  if($preg!=0){
    //带有GET
    return PATH.$match[1].SYSTEM_SUFFIX."?".$match[2];
  }else{
    return PATH.$paths.SYSTEM_SUFFIX;
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
function cookie($name,$value=null,$expire=0,$path="/"){
  if($value==null || empty($value)){
    setcookie($name,null,time()-1,$path); //删除
  }else{
    setcookie($name,$value,$expire,$path);
  }
}
/* Vender */
function vender($file){
  if(file_exists(EZ_PATH."/Vender/{$file}")){
    include EZ_PATH."/Vender/{$file}";
    return true;
  }else{
    return false;
  }
}
/* Org */
function org($file){
  if(file_exists(EZ_PATH."/Org/{$file}")){
    include EZ_PATH."/Org/{$file}";
    return true;
  }else{
    return false;
  }
}
/* SendEmail */
function sendEmail($email="simple@domain.com",$title="none",$subject="none",$content="none"){
  vender("PHPMailer/PHPMailerAutoload.php");
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->CharSet = EMAIL_CHARSET;
  $mail->Host = EMAIL_HOST;
  $mail->SMTPAuth = true;
  $mail->Username = EMAIL_ADDRESS;
  $mail->Password = EMAIL_PASSWORD;
  $mail->SMTPSecure = 'tls';
  $mail->Port = 25;
  $mail->setFrom('noreply@twocola.com', 'noreply');
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body    = $content;
  if(!$mail->send()) {
      return false;
  } else {
      return true;
  }
}
?>
