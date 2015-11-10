<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<table border="1px" width="400px">
    <a href="<?php echo U('add')?>">添加</a>
    <tr>
    <th>序列号</th>
    <th>名字</th>
    <th>年龄</th>
    <th>操作</th>
</tr>
    <?php foreach($rows as $value):?>
    <tr>
        <th><?php echo $value['id']?></th>
        <th><?php echo $value['name']?></th>
        <th><?php echo $value['age']?></th>
        <th><a href="<?php echo U('dele',array('id'=>$value['id']))?>">删除</a></th>
    </tr>
    <?php endforeach;?>
</table>

</body>
</html>