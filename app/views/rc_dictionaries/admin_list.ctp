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
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > ラジコン用語集</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>索引</th>
        <td><?=$form->text('index',array('value'=>$value[$TABLE_NAME]["index"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>タイトル</th>
        <td><?=$form->text('title',array('value'=>$value[$TABLE_NAME]["title"],'class'=>'add_text'));?></td>
    </tr>    
    <tr>
        <th>本文</th>
        <td><?=$form->textarea('body',array('value'=>$value[$TABLE_NAME]["body"],'class'=>'add_textarea'));?></td>
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
    <th>索引</th>
    <th>タイトル</th> 
    <th>本文</th>
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td style="width:70px;"><?=$val[$TABLE_NAME]["id"]?><a href="../Copy of rc_dictionaries/?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$val[$TABLE_NAME]["index"]?></td>
    <td><?=$val[$TABLE_NAME]["title"]?></td>
    <td><?=$val[$TABLE_NAME]["body"]?></td>
<? $i++ ?>
</tr>
<? }?>
</table>
