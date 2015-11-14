namespace Admin\Model;


use Think\Model;

class <?php echo $Controller ?>Model extends BaseModel
{

    protected $_validate = array(
   <?php foreach($fields as $val):
   if($val['key']=='PRI'){
   continue;
   }
    $content=strpos($val['comment'],'@')===false?$val['comment']:substr($val['comment'],0,strpos($val['comment'],'@'));
   ?>
<?php if($val['null']=='NO'):?>
    array("<?php echo $val['field']?>", 'require', '<?php echo $content?>不能为空！'),
<?php endif;?>
<?php endforeach;?>
    );

    protected $patchValidate = true;

}