<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 22:07
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index(){
        if(IS_POST){
        header('Content-Type: text/html;charset=utf-8');
            //接收传递过来的表名
            $table_name = I('post.table_name');
            //将表名转换格式，每个字母开头大写
            $name = parse_name($table_name,1);
            //生成标题名，通过表信息查询注解
            $sql = "select  TABLE_COMMENT from information_schema.`TABLES`  where TABLE_SCHEMA = '".C('DB_NAME')."' and TABLE_NAME = '{$table_name}'";
            $model = M();
            $rows = $model->query($sql);
            $meta_title = $rows[0]['table_comment'];
            //定义代码生成代码的模板路径
            define('TPL_PATH') or define('TPL_PATH',ROOT_PATH.'Template/');


            require TPL_PATH.'Controller.tpl';
            //从ob缓存中获取内容并清除ob缓存
            $controllerContent = "<?php\r\n".ob_get_clean();
            $controllerPath = APP_PATH.'Admin/Controller/'.$name.'Controller.class.php';
            //生成文件
            file_put_contents($controllerPath,$controllerContent);


            //打开ob缓存，获取模型内容放入Model中
            ob_start();
            //查询表中的字段信息，fields中包含了当前表字段的信息
            $sql = "show full columns from ".$table_name;
            $fields = $model->query($sql);
            foreach($fields as $k=>&$field){
                if($field['field']=='id'){
                    unset($fields[$k]);
                }
                $comment = $field['comment'];
                if(strpos($comment,'@')!=false){
                    $str = $field['comment'];
                    //正则表达式，找出表字段注释中符合条件的部分
                    $regex = "/(.*)@([a-z]*)\|?(.*)/";
                    preg_match($regex,$str,$results);
                    //将获得的结果放入field中生成新的字段
                    $field['comment'] = $results[1];
                    $field['form_type'] = $results[2];
                    if(!empty($results[3])){
                        parse_str($results[3],$option_values);
                        $field['option_values'] = $option_values;
                    }
                }
            }
            unset($field);
//            dump($fields);
//            exit;

            require TPL_PATH.'Model.tpl';
            $modelContent = "<?php\r\n".ob_get_clean();
            $modelPath = APP_PATH.'Admin/Model/'.$name.'Model.class.php';
            //生成文件
            file_put_contents($modelPath,$modelContent);


            //打开ob缓存
            ob_start();
            require TPL_PATH.'edit.tpl';
            $editContent = ob_get_clean();
            $editDir = APP_PATH.'Admin/View/'.$name;

            //查看是否存在视图文件夹,没有则创建并赋予权限
            if(!is_dir($editDir)){
                mkdir($name,0777,true);
            }
            $editPath = $editDir.'/edit.html';
            //生成文件
            file_put_contents($editPath,$editContent);

        }else{
            //分配数据到页面
            $this->assign('meta_title','代码生成');
            //展示视图页面
            $this->display('index');
        }
    }
}