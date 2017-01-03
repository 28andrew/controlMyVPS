<?php
/* HTML
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a>
    </li>
    <li class="active">Here</li>
</ol>
*/
function breadcrumb_main($level,$icon="none",$only=false,$link=false){
  echo "<ol class=\"breadcrumb\">";
  if($link){
    echo "<li><a href=\"$link\">";
  }else{
    echo "<li>";
  }
  if ($icon != "none"){
    echo "<i class=\"fa fa-$icon\"></i>";
  }
  echo " $level";
  if ($link){
    echo "</a></li>";
  }
  if ($only){
    echo "</ol>";
  }
}

function breadcrumb($level,$link=false){
  if($link){
    echo "<li><a href=\"$link\">";
  }else{
    echo "<li>";
  }
  echo " $level";
  if ($link){
    echo "</a></li>";
  }
}
function breadcrumb_last($level,$link=false){
  if($link){
    echo "<li class=\"active\"><a href=\"$link\">";
  }else{
    echo "<li class=\"active\">";
  }
  echo " $level";
  if ($link){
    echo "</a></li></ol>";
  }
}
?>
