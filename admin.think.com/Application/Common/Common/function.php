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