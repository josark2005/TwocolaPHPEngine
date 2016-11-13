<?php
/*
** TCE框架引擎报错系统
** Version:0.1
*/
namespace TCE;
class TException extends \Exception{
  public function __construct($message, $code = 0) {
    parent::__construct($message, $code);
  }
  public function errorMessage($debug){
    if($debug===false){
      $errorMsg = "<strong>{$this->getMessage()}</strong>";
    }else{
      $trace = array_reverse($this->getTrace());
      $errorMsg = "<table style='border:1px solid #dd514c'><tbody>
      <th bgcolor='#dd514c' colspan='3' style='color:#FFFFFF'>{$this->getMessage()}</th>
      <tr>
      <th bgcolor='#f37b1d'><strong>#</strong></th>
      <th bgcolor='#f37b1d'><strong>Function</strong></th>
      <th bgcolor='#f37b1d'><strong>Location</strong></th>
      </tr>";
      for ($i=0; $i < count($trace); $i++) {
        $args = "";
        for ($t=0; $t < count($trace[$i]['args']); $t++) {
          if( $t==0 && count($trace[$i]['args'])==1 ){
            $args .= $trace[$i]['args'][$t];
          }elseif( $t==count($trace[$i]['args'])-1 ){
            $args .= $trace[$i]['args'][$t];
          }else{
            $args .= $trace[$i]['args'][$t].",";
          }
        }
        $args = (empty($args)) ? "" : "\"".$args."\"";
        $p = explode("\\",$trace[$i]['file']);
        $file = end($p);
        $class = (isset($trace[$i]['class'])) ? $trace[$i]['class']."->" : "";
        $errorMsg .= "<tr><td bgcolor='#eeeeec'><strong>{$i}</strong></td>
        <td bgcolor='#eeeeec'>{$class}{$trace[$i]['function']}(<font color='#333000'>{$args}</font>)</td>
        <td bgcolor='#eeeeec'>...\\{$file}:{$trace[$i]['line']}</td>
        </tr>";
      }
      $errorMsg .= "</tbody></table>";
    }
    return $errorMsg;
  }
}
?>
