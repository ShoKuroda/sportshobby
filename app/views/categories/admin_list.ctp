<? $paginator->options(array('url'=>array("select_category"=>$value_select_category)));?>
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
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > カテゴリー管理</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>カテゴリーコード</th>
        <td><?=$form->text('category_cd',array('value'=>$value[$TABLE_NAME]["category_cd"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>カテゴリー</th>
        <td><?=$form->text('category',array('value'=>$value[$TABLE_NAME]["category"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>カテゴリー表示名</th>
        <td><?=$form->text('category_name',array('value'=>$value[$TABLE_NAME]["category_name"],'class'=>'add_text'));?></td>
    </tr>    
    <tr>
        <th>並び順</th>
        <td><?=$form->text('order',array('value'=>$value[$TABLE_NAME]["order"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>表示・非表示</th>
        <td><?=$form->select('display',$select_display,$value[$TABLE_NAME]["display"],array('empty'=>'選択してください。'));?></td>
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
    <?=$form->select('select_category',$select_category,"",array('empty'=>'カテゴリー'));?>
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
    <th>カテゴリーコード</th>
    <th>カテゴリー</th>
    <th>カテゴリー表示名</th> 
    <th>並び順</th>
    <th>表示・非表示</th>
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td style="width:70px;"><?=$val[$TABLE_NAME]["id"]?><a href="?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$val[$TABLE_NAME]["category_cd"]?></td>
    <td><?=$val[$TABLE_NAME]["category"]?></td>
    <td><?=$val[$TABLE_NAME]["category_name"]?></td>
    <td><?=$val[$TABLE_NAME]["order"]?></td>
    <td><?=$select_display[$val[$TABLE_NAME]["display"]]?></td>
<? $i++ ?>
</tr>
<? }?>
</table>
