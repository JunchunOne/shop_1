<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form action="<?php echo U('save')?>" method="post">
   名字:<input type="text" name="name" value=""><br/>
    年龄:<input type="text" name="age"><br/>
    <input type="submit" value="提交"><br/>
</form>
</body>
</html>