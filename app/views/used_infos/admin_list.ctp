<? $paginator->options(array('url'=>array("category"=>$value_category)));?>
<script language="javascript"> 
$(function(){
	var url=document.URL;
	if(-1 != url.indexOf("edit") || -1 != url.indexOf("new_edit") ){
		$("#disp").css("display","block");
	}
	$("#change_disp").click(function(){
		$("#disp").css("display","block");
	});
});
</script> 
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > 中古入荷管理</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>タイトル</th>
        <td><?=$form->text('title',array('value'=>$value[$TABLE_NAME]["title"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>カテゴリー</th>
        <td><?=$form->select('category',$info_category,$value[$TABLE_NAME]["category"],array('empty'=>'カテゴリー'));?></td>
    </tr>
    <tr>
        <th>本文</th>
        <td><?=$form->textarea('text',array('value'=>$value[$TABLE_NAME]["text"],'class'=>'add_textarea'));?></td>
    </tr>
    <tr>
        <th>URL</th>
        <td><?=$form->text('url',array('value'=>$value[$TABLE_NAME]["url"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>画像1</th>
        <td>
		<? if($value[$TABLE_NAME]["img1"]){?>
		<?=$image->resize($value[$TABLE_NAME]["img1"], 60, 60, $IMG_DIR, true);?>
		<?=$form->checkbox('img1_del',array('value'=>$value[$TABLE_NAME]["img1"]));?>	削除
		<? }else{?>
		<?=$form->file('img1');?>
		<? }?>
        </td>
    </tr>
    <tr>
        <th>画像2</th>
        <td>
		<? if($value[$TABLE_NAME]["img2"]){?>
		<?=$image->resize($value[$TABLE_NAME]["img2"], 60, 60, $IMG_DIR, true);?>
		<?=$form->checkbox('img2_del',array('value'=>$value[$TABLE_NAME]["img2"]));?>	削除
		<? }else{?>
		<?=$form->file('img2');?>
		<? }?>
        </td>
    </tr>
    <tr>
        <th>画像3</th>
        <td>
		<? if($value[$TABLE_NAME]["img3"]){?>
		<?=$image->resize($value[$TABLE_NAME]["img3"], 60, 60, $IMG_DIR, true);?>
		<?=$form->checkbox('img3_del',array('value'=>$value[$TABLE_NAME]["img3"]));?>	削除
		<? }else{?>
		<?=$form->file('img3');?>
		<? }?>
        </td>
    </tr>
    </table>
    <? if(!empty($_GET["edit"])){?>
    	<p style="padding:10px 0; text-align:center;">
		<?=$form->submit('修正する',array('div'=>false,'name'=>'edit'));?>　　<?=$form->submit('削除する',array('div'=>false,'name'=>'del'));?>
        　　<a href="list?new_edit">新規登録する</a>
        </p>
    <? }else{?>
	    <p style="padding:10px 0; text-align:center;"><?=$form->submit('登録する',array('div'=>false,'name'=>'add'));?></p>
    <? }?>
    <?=$form->end();?>
</div>

<div class="search_box">
	<?=$form->create(array('type'=>'get','name'=>'search'));?>
    <?=$form->select('category',$info_category,"",array('empty'=>'カテゴリー'));?>
    <?=$form->submit('検索する',array('div'=>false));?>
    <?=$form->end();?>
</div>
<?=$paginator->counter(array('format' => __('%page% / %pages% ページ,  全%count%件中%current%件, ( %start% から %end%）', true)));?>

<div class="pagination">
    <ul>
        <li class="prev"><?=$paginator->prev('<<前へ');?></li>
        <?=$paginator->numbers(array('separator' => '　','tag'=>"li"));?>
        <li class="next"><?=$paginator->next('次へ>>');?></li>
    </ul>
</div>

<table id="list_table">
<tr>
    <th>id</th>
    <th>カテゴリー</th>
    <th>タイトル</th> 
    <th>本文</th>
    <th>URL</th>
    <th>画像1</th>
    <th>画像2</th>
    <th>画像3</th>
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td><?=$val[$TABLE_NAME]["id"]?><a href="?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$val[$TABLE_NAME]["title"]?></td>
    <td><?=$info_category[$val[$TABLE_NAME]["category"]]?></td>
    <td><?=mb_strimwidth($val[$TABLE_NAME]["text"],0,100,'...')?></td>
    <td><?=$val[$TABLE_NAME]["url"]?></td>
    <td><?=($val[$TABLE_NAME]["img1"])?$image->resize($val[$TABLE_NAME]["img1"], 200, 200, $IMG_DIR, true):"";?></td>
    <td><?=($val[$TABLE_NAME]["img2"])?$image->resize($val[$TABLE_NAME]["img2"], 200, 200, $IMG_DIR, true):"";?></td>
    <td><?=($val[$TABLE_NAME]["img3"])?$image->resize($val[$TABLE_NAME]["img3"], 200, 200, $IMG_DIR, true):"";?></td>    
<? $i++ ?>
</tr>
<? }?>
</table>
