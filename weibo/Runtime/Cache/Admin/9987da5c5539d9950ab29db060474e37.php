<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加权限</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/app/weibo/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        <style type="text/css">
            {literal}
            li{list-style: none;}
            {/literal}
        </style>
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：权限管理-》添加权限信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/app/index.php/Admin/Goods/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/app/weibo/index.php/Admin/Role/distribute/role_id/1" method="post" enctype="multipart/form-data">
            <div>正在为角色：<span style="font-size:25px;font-weight:bold;"><?php echo ($role_name); ?></span>分配权限</div>

            <ul>
            <?php if(is_array($pauth_info)): foreach($pauth_info as $key=>$v): ?><li><?php echo ($v["auth_name"]); ?><input type="checkbox" name="authname[]" value="<?php echo ($v["auth_id"]); ?>" <?php if(in_array(($v['auth_id']), is_array($auth_ids_arr)?$auth_ids_arr:explode(',',$auth_ids_arr))): ?>checked='checked'<?php endif; ?> />
            <ul>
            <?php if(is_array($sauth_info)): foreach($sauth_info as $key=>$w): if($w['auth_pid'] == $v['auth_id']): ?><li><?php echo ($w["auth_name"]); ?><input type="checkbox" name="authname[]" value="<?php echo ($w["auth_id"]); ?>" <?php if(in_array(($w['auth_id']), is_array($auth_ids_arr)?$auth_ids_arr:explode(',',$auth_ids_arr))): ?>checked='checked'<?php endif; ?> />
            <ul>
            <?php if(is_array($tauth_info)): foreach($tauth_info as $key=>$y): if($y['auth_pid'] == $w['auth_id']): ?><li><?php echo ($y["auth_name"]); ?><input type="checkbox" name="authname[]" value="<?php echo ($y["auth_id"]); ?>" <?php if(in_array(($y['auth_id']), is_array($auth_ids_arr)?$auth_ids_arr:explode(',',$auth_ids_arr))): ?>checked='checked'<?php endif; ?> /></li><?php endif; endforeach; endif; ?>
                

            </ul>

            </li><?php endif; endforeach; endif; ?>
            </ul>


            </li><?php endforeach; endif; ?>
            </ul>
            <input type="submit" value="分配权限" />
              
            </form>
        </div>
    </body>
</html>