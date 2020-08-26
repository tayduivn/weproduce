<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header','mall');?>
<style>
.m{
width: fit-content;
}
#mid_div{
width: fit-content;
cursor: default;
height: fit-content;
padding: 0;
}
#mid_pic{
width: 800px;
height: 640px;
}
.nav #next:hover, .nav #prev:hover{
cursor: default;
}
.nav{
width: 700px;
}
.m table td{
font-family: Arial, Helvetica, sans-serif;
color: var(--background-color);
}
.product-title{
font-size: 24px;
font-weight: 700;
}
.product-price{
font-size: 20px;
}
    #price{
        color: var(--background-color);
        font-size: 1rem;
        font-family: 'Dancing Script', serif;
    }
    #price a{
        color: var(--background-color);
        text-decoration: underline;
        font-family: 'Dancing Script';
    }
    .quickview-form{
        margin: 1rem 0;
        line-height: 200%;
    }
    .quickview-form *{
        margin: 1rem 0;
    }
    .quickview-form input{
        margin-top: 0;
        line-height: 2rem;
    }
    .quickview-form label{
        font-size: 1rem;
        font-family: 'Dancing Script', serif;
    }
    .f_optional{
        font-size: .8rem;
        font-family: 'Dancing Script', serif;
    }
    .quickview-form textarea{
        padding: .5rem .5rem;
        word-break: break-all;
        resize: none;
        margin: 0 0;
    }
    .quickview-form input[type="number"]{
        padding: 0 .5rem;
        width: 5rem;
    }
    .quickview-form button{
        font-family: Arial, Helvetica, sans-serif;
        background-color: rgb(220, 79, 62);
        width: 100%;
        border: 0rem;
        font-size: 1rem;
        padding: 1rem 0;
color: white;
    }
    .quickview-form button:hover{
        opacity: .5;
        cursor: pointer;
    }
    .text_len{
        font-family: 'Dancing Script', serif;
        font-size: 1rem;
        color: gray;
        padding: .5rem 1rem;
        margin: 0 0;
}
#next, #prev{
cursor: pointer;
}
</style>
<script type="text/javascript">
var module_id= <?php echo $moduleid;?>,item_id=<?php echo $itemid;?>,content_id='content';
</script>
<div class="main">
<div class="m">
<div class="nav">
<div>
<div id="next" class="<?php if($itemid!=1) { ?>clickable<?php } ?>
" <?php if($itemid != 1) { ?> onclick="location.href='?itemid=<?php echo $itemid-1;?>'" <?php } ?>
>
Next
<i>&#62;</i>
</div>
<div><i>|</i></div>
<div id="prev" class="<?php if(!($last)) { ?>clickable<?php } ?>
" onclick="location.href='?itemid=<?php if($last) { ?>1<?php } else { ?><?php echo $itemid+1;?><?php } ?>
'">
<i>&#60;</i>
Prev
</div>
</div>
<a href="<?php echo $MODULE['1']['linkurl'];?>">Home</a> <i>></i> 
<a href="<?php echo $MOD['linkurl'];?>">Shop</a> <i>></i> 
<span style="cursor: default;"><?php echo $title;?></span>
</div>
<div class="b20 bd-t"></div> 
</div>
<div class="m">
<div id="mid_div" onclick="PAlbum(Dd('mid_pic'));">
<img src="<?php echo $albums['0'];?>" alt="<?php echo $title;?>" id="mid_pic">
</div>
<div class="b10"></div>
<div style="margin: auto; width: fit-content;">
<?php if(is_array($thumbs)) { foreach($thumbs as $k => $v) { ?>
<img src="<?php echo $v;?>" width="60" height="60" onmouseover="if(this.src.indexOf('nopic60.gif')==-1)Album(<?php echo $k;?>, '<?php echo $albums[$k];?>');" class="<?php if($k) { ?>ab_im<?php } else { ?>ab_on<?php } ?>
" id="t_<?php echo $k;?>"/>
<?php } } ?>
</div>
<div class="b20"></div>
<div style="display: grid; grid-template-columns: 60% 40%; grid-template-areas: 'details form';">
<div style="grid-area: details;">
<table>
<tr><td class="product-title"><?php echo $title;?></td></tr>
<tr><td><div class="b20"></div></td></tr>
<tr><td><?php echo $content;?></td></tr>
</table>
</div>

<div style="grid-area: form;">
<div id="price">$<?php echo $p1;?></div>
<form style="margin-top: 0;" method="POST" class="quickview-form" action="<?php echo $MODULE['2']['linkurl'];?>cart.php?action=add">
<input type="hidden" name="itemid" value="<?php echo $itemid;?>">
<div style="display: grid; grid-template-columns: auto auto; grid-template-rows: auto auto auto; margin-top: 0;">
<!-- <label style="grid-area: 1 / 1 / 1 / 3;"for="bulk">Bulk Order <span class="f_optional">(Optional)</span></label>
<textarea style="grid-area: 2 / 1 / 4 / 3;" name="note" id="bulk" style="width: 100%;" maxlength="100" autocomplete="off" onkeyup="count(this)"></textarea>
<span style="grid-area: 3 / 2 / 4 / 3;justify-self: end;" class="text_len">100</span> -->
</div>
<label for="a">Quantity</label><br>
<input type="number" name="a" id="a" value="1" onchange="changeA()" onfocus="this.value=''" onblur="setA()" min="1"><br>
<button type="submit" name="submit" value="add">Add to Cart</button>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/album.js"></script>
<?php if($content) { ?><script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/content.js"></script><?php } ?>
<script type="text/javascript">
var mallurl = '<?php echo $MOD['linkurl'];?>';
var mallmid = <?php echo $moduleid;?>;
var mallid = <?php echo $itemid;?>;
var n_c = <?php echo $comments;?>;
var n_o = <?php echo $orders;?>;
var c_c = Dd('c_comment').innerHTML;
var c_o = Dd('c_order').innerHTML;
var s_s = {'1':0,'2':0,'3':0};
var m_l = {
no_comment:'Currently no comment',
no_order:'Currently no order histories',
no_goods:'Product is not available',
no_self:'No permission to add your own product',
lastone:''
};
var a;
function changeA(){
a = Dd('a').value;
}
function setA(){
Dd('a').value = a;
}
</script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/mall.js"></script>
<script type="text/javascript">
<?php if($P1) { ?>addE(1);<?php } ?>
<?php if($P2) { ?>addE(2);<?php } ?>
<?php if($P3) { ?>addE(3);<?php } ?>
if(window.location.href.indexOf('#') != -1) {
var t = window.location.href.split('#');
try {Mshow(t[1]);} catch(e) {
console.log('fail');
}
}
</script>
<?php include template('footer');?>