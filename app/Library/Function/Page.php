<?php
  function handlePagination($totalNum,$currentPage,$limitPage){
    $str="";

    $path="";
//总页数
    $totalPage=(int)ceil($totalNum/$limitPage);

    $str .= "<div class='page_nav'><em>共{$totalPage}页&nbsp</em>";
//上一页 大于1出现,小于1消失
    if($currentPage>1){
      $prePageNum=$currentPage-1;
      $str .= "<a class='pageliststy next_page' href='{$path}?page={$prePageNum}'>上一页</a>";
    }

    $arr=[$currentPage];

    for($i=0;$i<4;$i++){

      $prePageNum=$currentPage-$i-1;

      $nextPageNum=$currentPage+$i+1;

      if($prePageNum>=1){
        array_unshift($arr,$prePageNum);
      }
      if($nextPageNum<=$totalPage){
        array_push($arr,$nextPageNum);
      }
    }
//控制第一个 最后一个 和...的出现
    if($arr[0]!=1){
      if($arr[0]>2){
        array_unshift($arr,"...");
      }
      array_unshift($arr,1);
    }

    if($arr[(count($arr)-1)]!=$totalPage){
      if($arr[(count($arr)-1)]<($totalPage-1)){
        array_push($arr,"...");
      }
      array_push($arr,$totalPage);
    }
  //遍历数组
    foreach($arr as $v){
      if($v==$currentPage){
         $str .="<a class='pageliststy cur_page' href='{$path}?page={$v}'>{$v}</a>";
      }else if($v=="..."){
        $str .="<em>...</em>";
      }else{
        $str .="<a class='pageliststy' href='{$path}?page={$v}'>{$v}</a>";
      }
    }

//下一页
    if($currentPage<$totalPage){
      $nextPageNum=$currentPage+1;
      $str .= "<a class='pageliststy next_page' href='{$path}?page={$nextPageNum}'>下一页</a>";
    }

    $str .="<input type=text class='page_inpt' placeholder='1'><em class='jump'>跳转</em>";

    $str .="</div>";

    return $str;
  }