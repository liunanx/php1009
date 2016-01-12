<extend name="Common/edit"/>

<block name="form">
    <div id="tabbody-div">
        <form action="{:U()}" method="post">
            <table width="90%" id="general-table" align="center">
                <?php foreach($fields as $field): ?>
                    <tr>
                        <td class="label"><?php echo $field['comment']?></td>
                        <td>
                            <?php
                                if(!isset($field['form_type'])){
                                    if($field['field']!='sort'){
                                        echo "<input type='text' name='{$field['field']}' value='{\${$field['field']}}' size='30' />";
                                    }else{
                                        echo "<input type='text' name='sort' value='{\$sort\|default=20}' size='30' />";
                                    }
                                }elseif($field['form_type']=='textarea'){
                                    echo "<textarea  name='{$field['field']}' cols='60' rows='4'>{\${$field['field']}}</textarea>";
                                }elseif($field['form_type']=='radio'){
                                    foreach($field['option_values'] as $k=>$v){
                                        echo "<input type='radio' name='{$field['field']}' value='{$k}' class='status'/> {$v}";
                                    }
                                }elseif($field['form_type']=='file'){
                                    echo "<input type='file' name='{$field['field']}'>";
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="button-div">
                <input type="hidden" value="{$id}" name="id"/>
                <input class="ajax-post button" type="submit" value=" 确定 "/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</block>
