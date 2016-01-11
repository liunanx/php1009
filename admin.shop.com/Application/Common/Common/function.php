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
