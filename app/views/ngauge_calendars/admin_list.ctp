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
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > GUNの辞書</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>年月</th>
        <td>
		<?=$form->select('year',$year,$value[$TABLE_NAME]["year"],array('empty'=>'選択してください'));?>年　
        <?=$form->select('month',$month,$value[$TABLE_NAME]["month"],array('empty'=>'選択してください'));?>月
        </td>
    </tr>    
    <tr>
        <th>tomix</th>
        <td><?=$form->textarea('tomix',array('value'=>$value[$TABLE_NAME]["tomix"],'class'=>'add_textarea'));?></td>
    </tr>
    <tr>
        <th>micro_ace</th>
        <td><?=$form->textarea('micro_ace',array('value'=>$value[$TABLE_NAME]["micro_ace"],'class'=>'add_textarea'));?></td>
    </tr>
    <tr>
        <th>kato</th>
        <td><?=$form->textarea('kato',array('value'=>$value[$TABLE_NAME]["kato"],'class'=>'add_textarea'));?></td>
    </tr>
    <tr>
        <th>その他</th>
        <td><?=$form->textarea('other',array('value'=>$value[$TABLE_NAME]["other"],'class'=>'add_textarea'));?></td>
    </tr>
    </table>
    <? if(!empty($_GET["edit"])){?>
    	<p style="padding:10px 0; text-align:center;">
		<?=$form->submit('修正する',array('div'=>false,'name'=>'edit'));?>　　<?=$form->submit('削除する',array('div'=>false,'name'=>'del'));?>
        　　<a href="../rc_dictionaries/list?new_edit">新規登録する</a>
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
    <th>年月</th>
    <th>TOMIX</th> 
    <th>MICRO ACE</th>
    <th>KATO</th>
    <th>その他</th>        
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td style="width:70px;"><?=$val[$TABLE_NAME]["id"]?><a href="../ngauge_calendars/list?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$year[$val[$TABLE_NAME]["year"]]?>年<?=$month[$val[$TABLE_NAME]["month"]]?>月</td>
    <td><?=$text->truncate($val[$TABLE_NAME]["tomix"],30,array('ending'=>'...'))?></td>
    <td><?=$text->truncate($val[$TABLE_NAME]["micro_ace"],30,array('ending'=>'...'))?></td>
    <td><?=$text->truncate($val[$TABLE_NAME]["kato"],30,array('ending'=>'...'))?></td>
    <td><?=$text->truncate($val[$TABLE_NAME]["other"],30,array('ending'=>'...'))?></td>
<? $i++ ?>
</tr>
<? }?>
</table>
