<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">表单</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>基本信息</span></div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>账号</label>
                    <input name="username" placeholder="请输入管理员账号" type="text" class="dfinput" /><i>名称不能超过32个字符</i></li>
                <li>
                    <label>密码</label>
                    <input name="password" placeholder="请输入初始密码" type="text" class="dfinput" /><i></i></li>
                <li>
                    <label>确认密码</label>
                    <input name="confirmPwd" placeholder="请确认初始密码" type="text" class="dfinput" />
                </li>
                <li>
                  <label>用户角色</label>
                  <select name="role" class="dfinput">
                    
                    <?php if(is_array($roles)): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><option value="<?php echo ($role["role_id"]); ?>"><?php echo ($role["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                  <i></i>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认创建" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
//jQuery代码
</script>

</html>