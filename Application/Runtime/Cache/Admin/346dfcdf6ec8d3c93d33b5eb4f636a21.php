<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>

    <!-- 加载UE编辑器必要的JS代码库 -->
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
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
        <form action="" method="post" enctype="multipart/form-data">
            <ul class="forminfo">
                <li>
                    <label>商品名称</label>
                    <input name="name" placeholder="请输入商品名称" type="text" class="dfinput" /><i>名称不能超过30个字符</i></li>

                <li>
                    <label>商品类型</label>
                    <select name="type" class="dfinput">
                        <option value="0">--请选择--</option>
                        
                        <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type["type_id"]); ?>"><?php echo ($type["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <i></i>
                </li>
                <li>
                    <label>商品价格</label>
                    <input name="price" placeholder="请输入商品价格" type="text" class="dfinput" /><i></i></li>
                <li>
                    <label>商品数量</label>
                    <input name="amount" placeholder="请输入商品数量" type="text" class="dfinput" />
                </li>
                <li>
                    <label>商品重量</label>
                    <input name="weight" placeholder="请输入商品重量" type="text" class="dfinput" />
                </li>

                <li>
                    <label>商品图标</label>
                    <input name="logo" type="file"/>
                </li>

                <li><label>是否显示</label><cite><input name="show" type="radio" value="1" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="show" type="radio" value="0" />否</cite></li>

                <li>
                    <label>商品描述</label>
                </li>
                <li>
                    <textarea id="ueditor" style="width:900px;height:300px" name="introduction" placeholder="请输入商品描述" cols="" rows=""></textarea>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">

  //实例化编辑器
  //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
  var ue = UE.getEditor('ueditor');

  $(function(){
    //当用户选择某个商品分类时,查询该分类相关的属性
    $("[name=type]").change(function(){
      //向服务器获取该类型具备的属性
      var type = $(this).val();
      var obj = $(this); //obj代表下拉选框
      //发起get请求,向服务器发送商品分类id
      $.get("<?php echo U('Goods/getAttr');?>",'type='+type,function(msg){
        // console.table(msg);
        //属性数据已经到浏览器了,根据属性的特性,提供不同的表单域
        //清空旧属性
        $(".attr").remove();

        //遍历属性,每个属性都要提供一组li标签
        for(var i=0;i<msg.length;i++){
          //把属性放在商品分类的下面
          //需要一组商品属性
          var attr = $("<li class='attr'></li>").append($("<label>"+msg[i].attr_name+"</label>"));
          //根据属性的性质,给出对应的表单域
          if(msg[i].attr_write == '0'){
            //录入形式是手工录入,提供可写的文本框
            attr.append($('<input name="attr['+msg[i].attr_id+'][]" type="text" class="dfinput" />'));
          }

          if(msg[i].attr_sel =='0' && msg[i].attr_write =='1'){
            //属性值是固定的,数据库中预定了,禁用的文本框
            attr.append($('<input name="attr['+msg[i].attr_id+'][]" type="text" disabled="disabled" value="'+msg[i].attr_vals+'" class="dfinput" />'));
          }

          if(msg[i].attr_sel == '1' &&  msg[i].attr_write =='1'){
            //属性值是可选的,数据库中预定了,复选框
            //把可选的属性值,分隔成数组
            var vals = msg[i].attr_vals.split(',');
            // console.table(vals);
            for(var j=0;j<vals.length;j++){
              //每个属性值都要提供一个复选框
              attr.append("&emsp;"+vals[j]+"&emsp;");
              attr.append($('<input name="attr['+msg[i].attr_id+'][]" type="checkbox" value="'+vals[j]+'"/>'))
            }
          }

          //文本框也添加完毕后,把整个li追加到表单中
          attr.insertAfter(obj.parent());
        }

      },'json');
    });
  })

</script>
</html>