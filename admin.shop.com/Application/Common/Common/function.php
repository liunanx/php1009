<?php

/**
 * 获取model中的错误信息
 * @param $model 模型对象
 * @return string 错误信息
 *
 */


function show_model_error($model){
    //获取模型中的错误信息
    $errors = $model->getError();
    $errorMsg = '<ul>';
    if(is_array($errors)){
        //如果是数组的话遍历数组将每个错误信息拼装起来
        foreach($errors as $error){
            $errorMsg .= "<li>{$error}</li>";
        }
    }else{
        $errorMsg .= "<li>{$errors}</li>";
    }
    $errorMsg .= '</ul>';
    return $errorMsg;
}




/**
 * 返回数组中指定的一列
 * @param $rows     二维数组
 * @param $field    字段
 * @return array   一维数组
 */
if(!function_exists('array_column')){   //做系统兼容性出来.
    function array_column($rows,$field){
        $value =array();
        foreach($rows as $row){ //循环出每个小数组,并且出去field字段对应的值.
            $value[] = $row[$field];
        }
        return $value;
    }
}


/**
 * 生成一个select下拉框的函数
 * @param $name  字段名
 * @param $rows  分配到页面的数据
 * @param string $defaultField  默认选中的值
 * @param string $valueField  选中id
 * @param string $textField  选中的内容name
 * @return string
 */
function arr2select($name,$rows,$defaultValue='',$valueField='id',$textField='name'){
    $select_html = "<select class='{$name}' name='{$name}'>";
    $select_html .= '<option value="">--请选择--</option>';

    foreach($rows as $row){
        $selected ='';
        if($row[$valueField]==$defaultValue){
            $selected = 'selected';
        }
        $select_html .= "<option value='{$row[$valueField]}' {$selected}>{$row[$textField]}</option>";
    }

    $select_html.='</select>';

    echo $select_html;

}
