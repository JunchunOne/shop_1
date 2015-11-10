<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/31
 * Time: 20:50
 */
/**1.错误信息的html拼接
 * @param $model
 * @return string
 */
function showError($model)
{
    $msg = $model->getError();
    //拼凑html语句
    $html = '<ul>';
    if (is_array($msg)) {
        foreach ($msg as $val) {
            $html .= "<li>$val</li>";
        }
    } else {
        $html .= "<li>$msg</li>";
    }
    $html .= '</ul>';
    return $html;
}
function du($num){
  return dump($num);
}

//把二维数组中的id分解一个维数组
//首先要判断是否有没有这个函数
if(!function_exists(array_column)){
    function array_column($rows,$key){
        //保存所有的id
        $ids=array();
        foreach($rows as $row){
            $ids[]= $row[$key];
        }
     return $ids;

    }
}

function arrSelect($name,$rows,$defaultValue,$fieldValue='id',$fieldName='name'){
    $html= "<select name='{$name}' class='{$name}'>
            <option value=''>--请选择--</option>";
    foreach($rows as $val){
        $selected='';

        if($val[$fieldValue]==$defaultValue){

            $selected="selected='selected'";
        }
      $html.="<option value='{$val[$fieldValue]}'{$selected}>{$val[$fieldName]}</option>";
    }
    $html.="</select>";

     echo $html;
}
