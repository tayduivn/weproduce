<?php defined('IN_DESTOON') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="<?php echo DT_CHARSET;?>"/>
<title>Information <?php echo $DT['seo_delimiter'];?><?php echo $DT['sitename'];?></title>
<meta name="robots" content="noindex,nofollow"/>
<meta name="generator" content="DESTOON B2B - www.destoon.com"/>
<style type="text/css">
*{font-size:14px;color:#000000;}
body{font-family:'Microsoft YaHei',Verdana,Arial,Helvetica,sans-serif;background:#FFFFFF;margin:0;height:100%;}
a:link,a:visited,a:active {color:#007AFF;text-decoration:none;}
input{color:#000000;}
.msg{width:400px;border:#E0E0E0 6px solid;border-radius:10px;margin:150px auto 0 auto;}
.head{background:#F0F0F0;border-bottom:#E8E8E8 1px solid;border-radius:3px 3px 0 0;letter-spacing:1px;line-height:36px;height:36px;overflow:hidden;font-weight:bold;text-align:center;user-select:none;}
.main{padding:16px 20px;line-height:200%;word-break:break-all;}
.foot{padding:10px 3px;margin:0 16px;border-top:#EFF1F3 1px solid;background:url('<?php echo DT_SKIN;?>image/message-arrow.png') no-repeat right center;font-size:12px;color:#007AFF;}
.progress {width:300px;height:6px;line-height:6px;font-size:1px;background:#E7E7E7;text-align:left;}
.progress div {height:6px;line-height:6px;font-size:1px;background:#007AFF;}
.f_gray{color:#666666;}
</style>
</head>
<?php if($dtime == -1) { ?>
<body style="background:#FFFFFF;margin:200px auto;">
<center><img src="<?php echo DT_SKIN;?>image/loading...gif" alt="login"/></center>
<?php echo $dmessage;?>
<meta http-equiv="refresh" content="0;URL=<?php echo $dforward;?>"/>
<?php } else { ?>
<body onkeydown="if(event.keyCode==13) window.history.back();">
<div class="msg">
<div class="head">Information</div>
<div class="main"><?php echo $dmessage;?></div>
<?php if($dforward == 'goback') { ?>
<a href="javascript:window.history.back();"><div class="foot">Click to go back</div></a>
<?php } else { ?>
<a href="<?php echo $dforward;?>"><div class="foot">If your broswer does not go back automatically, Click here</div></a>
<meta http-equiv="refresh" content="<?php echo $dtime;?>;URL=<?php echo $dforward;?>">
<?php } ?>
</div>
<?php } ?>
</body>
</html>