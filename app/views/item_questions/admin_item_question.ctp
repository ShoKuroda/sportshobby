<? //$paginator->options(array('url'=>array("category"=>$value_category)));?>
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
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > 商品の質問管理</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>アイテムID</th>
        <td><?=$form->text('item_id',array('value'=>$value[$TABLE_NAME]["item_id"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>名前</th>
        <td><?=$form->text('question_name',array('value'=>$value[$TABLE_NAME]["question_name"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td><?=$form->text('question_mail',array('value'=>$value[$TABLE_NAME]["question_mail"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>本文</th>
        <td><?=$form->textarea('question_detail',array('value'=>$value[$TABLE_NAME]["question_detail"],'class'=>'add_textarea'));?></td>
    </tr>
    <tr>
        <th>表示・非表示</th>
        <td><?=$form->select('permission',$permission,$value[$TABLE_NAME]["permission"],array('empty'=>'--'));?></td>
    </tr>
    </table>
    <? if(!empty($_GET["edit"])){?>
    	<p style="padding:10px 0; text-align:center;">
		<?=$form->submit('修正する',array('div'=>false,'name'=>'edit'));?>　　<?=$form->submit('削除する',array('div'=>false,'name'=>'del'));?>
        　　<a href="item_question?new_edit">新規登録する</a>
        </p>
    <? }else{?>
	    <p style="padding:10px 0; text-align:center;"><?=$form->submit('登録する',array('div'=>false,'name'=>'add'));?></p>
    <? }?>
    <?=$form->end();?>
</div>

<div class="search_box">
	<?=$form->create(array('type'=>'get','name'=>'search'));?>
    <? //$form->text('question_name',$question_name,"",array('empty'=>'カテゴリー'));?>
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
    <th>アイテムID</th>
    <th>質問の商品</th>
    <th>名前</th>
    <th>メールアドレス</th> 
    <th>質問内容</th>
    <th>表示・非表示</th>
    <th>回答</th>
</tr>
<? $i = 1 ?>
<? foreach($Info as $key=>$val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td><?=$val[$TABLE_NAME]["id"]?><a href="?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$val[$TABLE_NAME]["item_id"]?></td>
    <td><a href="/確認/item<?=str_replace(RAKUTEN_SHOPID,"",$val[$TABLE_NAME]["item_id"])?>" target="_blank">確認</a></td>
    <td><?=$val[$TABLE_NAME]["question_name"]?></td>
    <td><?=$val[$TABLE_NAME]["question_mail"]?></td>
    <td><?=$val[$TABLE_NAME]["question_detail"]?></td>
    <td><?=($val[$TABLE_NAME]["permission"])?$permission[$val[$TABLE_NAME]["permission"]]:"";?></td>
    <td><? if($val[0]["cnt"]){?><?=$val[0]["cnt"]."件"?><? }else{ ?>なし<? }?></td>
<? $i++ ?>
</tr>
<? }?>
</table>
