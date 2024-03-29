<?php
defined('DT_ADMIN') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellspacing="0" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 信息类型</td>
<td>
<?php foreach($TYPE as $k=>$v) {?>
<input type="radio" name="post[typeid]" value="<?php echo $k;?>" <?php if($k==$typeid) echo 'checked';?> id="typeid_<?php echo $k;?>"/> <label for="typeid_<?php echo $k;?>" id="t_<?php echo $k;?>"><?php echo $v;?></label>&nbsp;
<?php } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 信息标题</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '级别', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 行业分类</td>
<td><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '选择分类', $catid, $moduleid);?> <a href="javascript:schcate(<?php echo $moduleid;?>);" class="t">搜索分类</a> <span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
	<td class="tl"><span class="f_hid">*</span> 文件</td>
	<td>
		<table cellspacing="1" bgcolor="#E7E7EB" class="ctb">
			<tr bgcolor="#F5F5F5" align="center">
				<td width="176px">File Title</td>
				<td width="216px">File Path</td>
				<td width="227px"><button type="button" onclick="newFileInput()">Add New</button></td>
			</tr>
			<tbody id="files_input">
				<?php for($i = 0; $i < count(array_keys($filepath)); $i++){?>
					<?php $key = array_keys($filepath)[$i];?>
					<tr>
						<td><input type="text" id="fname<?php echo $i;?>" size="20" name="post[filepath][fname<?php echo $i;?>" value="<?php echo $key;?>"></td>
						<td colspan="2"><input name="post[filepath][file<?php echo $i;?>]" type="text" size="40" id="file<?php echo $i;?>" value="<?php echo $filepath[$key];?>"/>&nbsp;&nbsp;<span onclick="mDfile(<?php echo $moduleid?>, Dd('file<?php echo $i?>').value, 'file<?php echo $i;?>');" class="jt">[上传]</span>&nbsp;&nbsp;<span onclick="if(Dd('file<?php echo $i?>').value) window.open(Dd('file<?php echo $i?>').value);" class="jt">[预览]</span>&nbsp;&nbsp;<span onclick="mdelfile(<?php echo $i;?>)" class="jt">[删除]</span> <span class="f_red" id="dfiles"></span></td>
						<?php unset($k);?>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<script>
			function newFileInput(){
				var fnames = [];
				var files = [];
				var i = 0;
				while( i < Dd('files_input').children.length ){
					fnames[i] = Dd('fname'+i).value;
					files[i] = Dd('file'+i).value;
					console.log(i);
					i++;
				}
				var tr = '<tr>';
				tr+= '<td><input name="post[filepath][fname'+i+']" type="text" size="20" id="fname'+i+'"/></td>';
				tr+= '<td colspan="2"><input name="post[filepath][file'+i+']" type="text" size="40" id="file'+i+'"/>&nbsp;&nbsp;<span onclick="mDfile(<?php echo $moduleid?>, Dd(`file'+i+'`).value, `file'+i+'`);" class="jt">[上传]</span>&nbsp;&nbsp;<span onclick="if(Dd(`file'+i+'`).value) window.open(Dd(`file'+i+'`).value);" class="jt">[预览]</span>&nbsp;&nbsp;<span onclick="mdelfile('+i+')" class="jt">[删除]</span> <span class="f_red" id="dfiles"></span></td>';
				tr+= '</tr>';
				Dd('files_input').innerHTML += tr;
				for( i = 0; i < fnames.length; i++ ){
					Dd('fname'+i).value = fnames[i];
					Dd('file'+i).value = files[i];
				}
			}
			function mDfile(m, o, f){
				Dfile(m, o, f);
			}
			function mdelfile(i){
				Dd('fname'+i).parentNode.parentNode.parentNode.removeChild(Dd('fname'+i).parentNode.parentNode);
			}
			function checkFiles(){
				for( var i = 0; i < Dd('files_input').children.length; i++ ){
					if( !Dd('fname'+i).value || !Dd('file'+i).value ){
						Dmsg('Please enter the name of the file or upload a valid file','files');
						var id = !Dd('file'+i).value ? 'file'+i : 'fname'+i;
						Dd(id).focus();
						return false;
					}
				}
				return true;
			}
		</script>
	</td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 1;
</script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/property.js"></script>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr>
<td class="tl"><span class="f_hid">*</span> 详细说明</td>
<?php require_once DT_ROOT.'/module/buy/global.func.php';?>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '100%', 350);?><br/><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
	<td class="tl"><span class="f_red">*</span> 商品图片</td>
	<td>
		<div id="thumbs_inputs">
			<?php 
			foreach($thumbs as $k=>$v){ 
			?>
			<input type="hidden" name="post[thumbs][]" id="thumb<?php echo $k;?>" value="<?php echo $thumbs[$k];?>">
			<?php }?>
		</div>
		<script>
			var paras;
			function newParas(l){
				var para = [];
				for(var i=0;i<l;i++){ para[i]=false;}
				return para;
			}
			function newThumb(i){
				paras[i] = true;
				Dd('thumbs_inputs').innerHTML += "<input type='hidden' name='post[thumbs][]' id='thumb"+i+"'/>";
				Dd('thumbs_preview').innerHTML += "<td width='120' id='preview"+i+"'><img src='<?php echo DT_SKIN;?>image/waitpic.gif' width='100' height='100' id='showthumb"+i+"' title='preivew' onclick='if(this.src.indexOf(`waitpic.gif`) == -1){_preivew(Dd(`showthumb"+i+"`).src,1);}else{mDalbum("+i+",<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>,Dd(`thumb"+i+"`).value,true);}' onload='thumb()'/></td>";
				Dd('thumbs_controller').innerHTML += "<td id='control"+i+"'><span onclick='mDalbum("+i+",<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>,Dd(`thumb"+i+"`).value,true);' class='jt'><img src='<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif' width='12' height='12' title='上传'/></span>&nbsp;&nbsp;<img src='<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif' width='12' height='12' title='选择' onclick='mselAlbum("+i+");'/>&nbsp;&nbsp;<span onclick='mdelAlbum("+i+", `wait`);' class='jt'><img src='<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif' width='12' height='12' title='删除'/></span></td>";
			}
			function delThumb(i){
				paras[i] = false;
				Dd('preview'+i).parentNode.removeChild(Dd('preview'+i));
				Dd('control'+i).parentNode.removeChild(Dd('control'+i));
				Dd('thumb'+i).parentNode.removeChild(Dd('thumb'+i));
			}
			function thumb(){
				for( var i = 0; i < paras.length ; i++ ){
					if( paras[i] ) break;
				}
				if( i == paras.length ) newThumb(i);
				else if( paras.length > 1 && ((i + 1) != paras.length) ) delThumb(i);
			}
			function mDalbum(f, m, w, h, o, s){
				paras[f] = false;
				Dalbum(f,m,w,h,o,s);
			}
			function mdelAlbum(f,s){
				paras[f] = true;
				delAlbum(f,s);
			}
			function mselAlbum(f){
				paras[f] = false;
				selAlbum(f);
			}
			document.addEventListener("DOMContentLoaded", function() {
				var l = <?php echo count($thumbs) ? count($thumbs): 1;?>;
				paras = newParas(l);
				newThumb(l);
			});
		</script>
		<table class="ctb">
			<tr align="center" height="120" class="c_p" id="thumbs_preview">
				<?php 
				foreach($thumbs as $k=>$v){
				?>
				<td width="120" id='preview<?php echo($k);?>'><img src="<?php echo $thumbs[$k] ? $thumbs[$k] : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb<?php echo $k;?>" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb<?php echo $k;?>').src, 1);}else{mDalbum(<?php echo $k;?>,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb<?php echo $k;?>').value, true);}" onload="thumb()"/></td>
				<?php }?>
			</tr>
			<tr align="center" class="c_p" id="thumbs_controller">
				<?php 
				foreach($thumbs as $k=>$v){
				?>
				<td id='control<?php echo $k;?>'><span onclick="mDalbum(<?php echo $k;?>,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb<?php echo $k;?>').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="mselAlbum(<?php echo $k;?>);"/>&nbsp;&nbsp;<span onclick="mdelAlbum(<?php echo $k;?>, 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
				<?php }?>
			</tr>
		</table>
		<span id="dthumb" class="f_red"></span>
	</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 过期时间</td>
<td><?php echo dcalendar('post[totime]', $totime, '-', 1);?>&nbsp;
<select onchange="Dd('posttotime').value=this.value;">
<option value="">快捷选择</option>
<option value="">长期有效</option>
<option value="<?php echo timetodate($DT_TIME+86400*3, 3);?> 23:59:59">3天</option>
<option value="<?php echo timetodate($DT_TIME+86400*7, 3);?> 23:59:59">一周</option>
<option value="<?php echo timetodate($DT_TIME+86400*15, 3);?> 23:59:59">半月</option>
<option value="<?php echo timetodate($DT_TIME+86400*30, 3);?> 23:59:59">一月</option>
<option value="<?php echo timetodate($DT_TIME+86400*182, 3);?> 23:59:59">半年</option>
<option value="<?php echo timetodate($DT_TIME+86400*365, 3);?> 23:59:59">一年</option>
</select>&nbsp;
<span id="dposttotime" class="f_red"></span> 不选表示长期有效</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 主要参数</td>
<td class="nv">
<table cellspacing="1" bgcolor="#E7E7EB" class="ctb">
<tr align="center">
<th>参数名称</th>
<th>参数值</th>
</tr>
<tr bgcolor="#FFFFFF">
<td><input name="post[n1]" type="text" size="20" value="<?php echo $n1;?>" id="n1"/></td>
<td><input name="post[v1]" type="text" size="20" value="<?php echo $v1;?>" id="v1"/></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><input name="post[n2]" type="text" size="20" value="<?php echo $n2;?>" id="n2"/></td>
<td><input name="post[v2]" type="text" size="20" value="<?php echo $v2;?>" id="v2"/></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><input name="post[n3]" type="text" size="20" value="<?php echo $n3;?>" id="n3"/></td>
<td><input name="post[v3]" type="text" size="20" value="<?php echo $v3;?>" id="v3"/></td>
</tr>
<tr bgcolor="#FFFFFF">
<td class="f_gray">例如：规格</td>
<td class="f_gray">例如：10cm*20cm</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 交易条件</td>
<td>
	<table cellspacing="1" bgcolor="#E7E7EB" class="ctb">
	<tr bgcolor="#FFFFFF">
	<td width="70">需求数量</td>
	<td><input name="post[amount]" type="text" size="20" value="<?php echo $amount;?>"/></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td>价格要求</td>
	<td><input name="post[price]" type="text" size="20" value="<?php echo $price;?>"/></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td>包装要求</td>
	<td><input name="post[pack]" type="text" size="20" value="<?php echo $pack;?>"/></td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员信息</td>
<td>
<input type="radio" name="ismember" value="1" <?php if($username) echo 'checked';?> onclick="Dh('d_guest');Ds('d_member');Dd('username').value='<?php echo $username;?>';" id="ismember_1"/><label for="ismember_1"> 是</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="ismember" value="0" <?php if(!$username) echo 'checked';?> onclick="Dh('d_member');Ds('d_guest');Dd('username').value='';" id="ismember_0"/><label for="ismember_0"> 否</label>
</td>
</tr>
<tbody id="d_member" style="display:<?php echo $username ? '' : 'none';?>">
<tr>
<td class="tl"><span class="f_red">*</span> 会员名</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[资料]</a> <span id="dusername" class="f_red"></span></td>
</tr>
</tbody>
<tbody id="d_guest" style="display:<?php echo $username ? 'none' : '';?>">
<tr>
<td class="tl"><span class="f_red">*</span> 公司名称</td>
<td class="tr"><input name="post[company]" type="text" id="company" size="50" value="<?php echo $company;?>" /> 个人请填姓名 例如：张三<br/><span id="dcompany" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 所在地区</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '请选择', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系人</td>
<td class="tr"><input name="post[truename]" type="text" id="truename" size="20" value="<?php echo $truename;?>" /> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系手机</td>
<td class="tr"><input name="post[mobile]" id="mobile" type="text" size="30" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 电子邮件</td>
<td class="tr"><input name="post[email]" id="email" type="text" size="30" value="<?php echo $email;?>" /> <span id="demail" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 联系电话</td>
<td class="tr"><input name="post[telephone]" id="telephone" type="text" size="30" value="<?php echo $telephone;?>"/> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 联系地址</td>
<td class="tr"><input name="post[address]" id="address" type="text" size="60" value="<?php echo $address;?>"/></td>
</tr>
<?php if($DT['im_qq']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td class="tr"><input name="post[qq]" id="qq" type="text" size="30" value="<?php echo $qq;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_wx']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 微信</td>
<td class="tr"><input name="post[wx]" id="wx" type="text" size="30" value="<?php echo $wx;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_ali']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 阿里旺旺</td>
<td class="tr"><input name="post[ali]" id="ali" type="text" size="30" value="<?php echo $ali;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_skype']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td class="tr"><input name="post[skype]" id="skype" type="text" size="30" value="<?php echo $skype;?>"/></td>
</tr>
<?php } ?>
</tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> 信息状态</td>
<td>
	<?php include_once load('buy.lang');?>
	<?php foreach($L['trade_status'] as $k => $v) {?>
		<input type="radio" name="post[status]" value="<?php echo $k;?>" <?php if($status==$k) echo 'checked';?>/> <?php echo $v;?><br>
	<?php }?>
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 拒绝理由</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加时间</td>
<td><?php echo dcalendar('post[addtime]', $addtime, '-', 1);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 浏览次数</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容收费</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('不填或填0表示继承模块设置价格，-1表示不收费<br/>大于0的数字表示具体收费价格');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容模板</td>
<td><?php echo tpl_select('show', $module, 'post[template]', '默认模板', $template, 'id="template"');?><?php tips('如果没有特殊需要，一般不需要选择<br/>系统会自动继承分类或模块设置');?></td>
</tr>
<?php if($MOD['show_html']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 自定义文件路径</td>
<td><input type="text" size="50" name="post[filepath]" value="<?php echo $filepath;?>" id="filepath"/>&nbsp;<input type="button" value="重名检测" onclick="ckpath(<?php echo $moduleid;?>, <?php echo $itemid;?>);" class="btn"/>&nbsp;<?php tips('可以包含目录和文件 例如 destoon/b2b.html<br/>请确保目录和文件名合法且可写入，否则可能生成失败');?>&nbsp; <span id="dfilepath" class="f_red"></span></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value="<?php echo $action == 'edit' ? '修 改' : '添 加';?>" class="btn-g"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="<?php echo $action == 'edit' ? '返 回' : '取 消';?>" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>');"/></div>
</form>
<?php load('clear.js'); ?>
<?php load('guest.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">单页采编</div>
<table cellspacing="0" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 目标网址</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" 获 取 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 管理规则 " class="btn" onclick="Dwidget('?file=fetch', '管理规则');"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function _p() {
	if(Dd('tag').value) {
		Ds('reccate');
	}
}
function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('请选择所属行业', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('标题最少2字，当前已输入'+l+'字', f);
		return false;
	}
	if(Dd('ismember_1').checked) {
		f = 'username';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写会员名', f);
			return false;
		}
	} else {
		f = 'company';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写公司名称', f);
			return false;
		}
		if(Dd('areaid_1').value == 0) {
			Dmsg('请选择所在地区', 'areaid');
			return false;
		}
		f = 'truename';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写联系人', f);
			return false;
		}
		f = 'mobile';
		l = Dd(f).value.length;
		if(l < 7) {
			Dmsg('请填写手机', f);
			return false;
		}
	}
	<?php echo $FD ? fields_js() : '';?>
	<?php echo $CP ? property_js() : '';?>
	return checkFiles();
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>