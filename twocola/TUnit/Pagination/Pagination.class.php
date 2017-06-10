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

// +----------------------------------
// |      本组件暂不推荐使用
// +----------------------------------
/*
** 分页模块
** Version 0.1 Beta
*/
/*
** 分页模块
** 1、必须传递当前页
** 2、必须传递总页数
** 3、共7个按钮：首页、上一页、x、x、x、下一页、尾页
** 4、返回数组依次为7个按钮状态（是否显示，显示文字）
*/
namespace TUnit\Pagination;
class Pagination {
  public $page; //当前页
  public $cpage;  //总页数
  public $n_index;  //首页
  public $n_last;  //上一页
  public $n_x1;  //x1
  public $n_x2;  //x2
  public $n_x3;  //x3
  public $n_next;  //下一页
  public $n_end;  //尾页
  public function __construct($page,$cpage,$n_index="首页",$n_last="上一页",$n_x1="@",$n_x2="@",$n_x3="@",$n_next="下一页",$n_end="尾页"){
    $this->page($page);
    $this->cpage($cpage);
    $this->n_index($n_index);
    $this->n_last($n_last);
    $this->n_x1($n_x1);
    $this->n_x2($n_x2);
    $this->n_x3($n_x3);
    $this->n_next($n_next);
    $this->n_end($n_end);
    return $this->pagination();
  }
  /* 设置当前页 */
  public function page($page){
    $this->page = $page;
    return $this;
  }
  /* 设置总页数 */
  public function cpage($cpage){
    $this->cpage = $cpage;
    return $this;
  }
  /* 设置首页名称 */
  public function n_index($name){
    $this->n_index = $name;
    return $this;
  }
  /* 设置上一页名称 */
  public function n_last($name){
    $this->n_last = $name;
    return $this;
  }
  /* 设置x1名称 */
  public function n_x1($name){
    $this->n_x1 = $name;
    return $this;
  }
  /* 设置x2名称 */
  public function n_x2($name){
    $this->n_x2 = $name;
    return $this;
  }
  /* 设置x3名称 */
  public function n_x3($name){
    $this->n_x3 = $name;
    return $this;
  }
  /* 设置下一页名称 */
  public function n_next($name){
    $this->n_next = $name;
    return $this;
  }
  /* 设置尾页名称 */
  public function n_end($name){
    $this->n_end = $name;
    return $this;
  }
  /* 分页算法 */
  public function pagination(){
    $this->page = ($this->page<1) ? 1 : $this->page ;
    /* 首页按钮 */
    if($this->page<=2 && $this->cpage>3 || $this->cpage<=3){
      $btn_index = array(
        "show" => "n",
        "active" => "none",
        "text" => $this->n_index,
        "page" => "1",
      );
    }else{
      $btn_index = array(
        "show" => "y",
        "active" => "none",
        "text" => $this->n_index,
        "page" => "1",
      );
    }
    /* 上一页按钮 */
    if($this->page<=2 && $this->cpage>3 || $this->cpage<=3){
      $btn_last = array(
        "show" => "n",
        "active" => "none",
        "text" => $this->n_last,
        "page" => $this->page-1,
      );
    }else{
      $btn_last = array(
        "show" => "y",
        "active" => "none",
        "text" => $this->n_last,
        "page" => $this->page-1,
      );
    }
    /* 下一页按钮 */
    if($this->page >= $this->cpage){
      $btn_next = array(
        "show" => "n",
        "active" => "none",
        "text" => $this->n_next,
        "page" => $this->page+1,
      );
    }elseif($this->cpage<=3){
      $btn_next = array(
        "show" => "n",
        "active" => "none",
        "text" => $this->n_next,
        "page" => $this->page+1,
      );
    }else{
      $btn_next = array(
        "show" => "y",
        "active" => "none",
        "text" => $this->n_next,
        "page" => $this->page+1,
      );
    }
    /* 尾页按钮 */
    if($this->page+1 >= $this->cpage){
      $btn_end = array(
        "show" => "n",
        "active" => "none",
        "text" => $this->n_end,
        "page" => $this->cpage,
      );
    }elseif($this->cpage<=4){
      $btn_end = array(
        "show" => "n",
        "active" => "none",
        "text" => $this->n_end,
        "page" => $this->cpage,
      );
    }else{
      $btn_end = array(
        "show" => "y",
        "active" => "none",
        "text" => $this->n_end,
        "page" => $this->cpage,
      );
    }
    /* x1按钮 */
    if($this->page==1){
      $btn_x1 = array(
        "show" => "y",
        "active" => "active",
        "text" => str_replace("@","1",$this->n_x1),
        "page" => "1",
      );
    }elseif($this->page==$this->cpage&&$this->cpage>=3){
      $btn_x1 = array(
        "show" => "y",
        "active" => "none",
        "text" => str_replace("@",$this->page-2,$this->n_x1),
        "page" => $this->page-2,
      );
    }else{
      $btn_x1 = array(
        "show" => "y",
        "active" => "none",
        "text" => str_replace("@",$this->page-1,$this->n_x1),
        "page" => $this->page-1,
      );
    }
    /* ./x1按钮 */
    /* x2按钮 */
    if($this->page==1){
      $btn_x2 = array(
        "show" => "y",
        "active" => "none",
        "text" => str_replace("@","2",$this->n_x1),
        "page" => "2",
      );
    }elseif($this->page==$this->cpage&&$this->cpage>=3 || $this->cpage<=1){
      $btn_x2 = array(
        "show" => "y",
        "active" => "none",
        "text" => str_replace("@",$this->page-1,$this->n_x1),
        "page" => $this->page-1,
      );
    }else{
      $btn_x2 = array(
        "show" => "y",
        "active" => "active",
        "text" => str_replace("@",$this->page,$this->n_x1),
        "page" => $this->page,
      );
    }
    /* ./x2按钮 */
    /* x3按钮 */
    if($this->page==1){
      $btn_x3 = array(
        "show" => "y",
        "active" => "none",
        "text" => str_replace("@","3",$this->n_x1),
        "page" => "3",
      );
    }elseif($this->page==$this->cpage){
      $btn_x3 = array(
        "show" => "y",
        "active" => "active",
        "text" => str_replace("@",$this->page,$this->n_x1),
        "page" => $this->page,
      );
    }elseif($this->cpage<=2){
      $btn_x3 = array(
        "show" => "n",
        "active" => "none",
        "text" => str_replace("@",$this->page,$this->n_x1),
        "page" => $this->page,
      );
    }else{
      $btn_x3 = array(
        "show" => "y",
        "active" => "none",
        "text" => str_replace("@",$this->page+1,$this->n_x1),
        "page" => $this->page+1,
      );
    }
    /* ./x3按钮 */
    /* 特殊情况 */
    if($this->cpage<3){
      $btn_x3 = array(
        "show" => "n",
        "active" => "none",
        "text" => str_replace("@",$this->page+1,$this->n_x1),
        "page" => $this->page+1,
      );
    }
    if($this->cpage<2){
      $btn_x2 = array(
        "show" => "n",
        "active" => "none",
        "text" => str_replace("@",$this->page+1,$this->n_x1),
        "page" => $this->page+1,
      );
    }
    /* ./特殊情况 */
    /* 结合输出 */
    $btn = array(
      "index" => $btn_index,
      "prev" => $btn_last,
      "b1" => $btn_x1,
      "b2" => $btn_x2,
      "b3" => $btn_x3,
      "next" => $btn_next,
      "end" => $btn_end,
    );
    return $btn;
    /* ./结合输出 */
  }
/* ./END */
}
?>
