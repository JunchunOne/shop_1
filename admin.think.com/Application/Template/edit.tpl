<extend name="public/common"/>
<block name="content">
    <div class="main-div">
        <form method="post" action="{:U()}">
            <table cellspacing="1" cellpadding="3" width="100%">
                <?php foreach($fields as $val):
                if($val['key']=='PRI'){
                 continue;
              }

              if(strpos($val['comment'],'@')===false){
                 $content=$val['comment'];
               $type='text';
              }else{
                 preg_match("/@([a-z]*)\|/", $val['comment']."|", $retul);
              $content=substr($val['comment'],0,strpos($val['comment'],'@'));
              $type=$retul[1];
              }

                        ?>
                <?php if($val['field']=='status'):
                $radio=substr($val['comment'],strpos($val['comment'],'|')+1);
                parse_str($radio,$arr);

                ?>
                <tr>
                    <td class="label"><?php echo $content?></td>
                    <td>
                    <?php foreach($arr as $key=>$vals):
                  echo "<input type='$type' name='".$val['field']."' class='status' value='$key'/> $vals";
                    ?>

                    <?php endforeach;?>
                    </td>
                </tr>
                <?php else:?>
                <tr>
                    <td class="label"><?php echo $content?></td>
                    <td>
                        <input type="<?php echo $type?>" name="<?php echo $val['field']?>" maxlength="60" value="{$<?php echo $val['field']?>}"/>
                    </td>

                </tr>
                <?php endif;?>
                <?php endforeach;?>
                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="submit" class="button ajax_post" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript" src="__JS__/public.js"></script>
    <script type="text/javascript" src="__JS__/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="__LAYER__/layer.js"></script>
    <script type="text/javascript" src="__JS__/common.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.status').val([{$status|default =1}]);

        });
    </script>
</block>


