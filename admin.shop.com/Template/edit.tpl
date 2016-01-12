<extend name="Common/edit"/>

<block name="form">
    <div id="tabbody-div">
        <form action="{:U()}" method="post">
            <table width="90%" id="general-table" align="center">
                <?php
                    foreach($fields as $field){

                    }
                ?>
            </table>
            <div class="button-div">
                <input type="hidden" value="{$id}" name="id"/>
                <input class="ajax-post button" type="submit" value=" 确定 "/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</block>
