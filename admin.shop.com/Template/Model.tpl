namespace Admin\Model;


use Think\Model;

class <?php echo $name ?>Model extends BaseModel
{
//自动验证模板，验证不能为空的字段
protected $_validate = array(
    <?php
        foreach($fields as $field){
            if($field['field']=='id' || $field['null']=='YES'){
                        continue;
                  }
                 echo "array('{$field['field']}','require','{$field['comment']}不能够为空'),\r\n";
            }
    ?>
    );
}