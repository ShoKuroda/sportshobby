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
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > ラジコン知恵袋 - 質問</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>カテゴリー</th>
        <td><?=$form->select('category',$category,$value[$TABLE_NAME]["category"],array('empty'=>'カテゴリー'));?></td>
    </tr>
    <tr>
        <th>ニックネーム</th>
        <td><?=$form->text('nick_name',array('value'=>$value[$TABLE_NAME]["nick_name"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>タイトル</th>
        <td><?=$form->text('question_title',array('value'=>$value[$TABLE_NAME]["question_title"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>質問内容</th>
        <td><?=$form->textarea('question_detail',array('value'=>$value[$TABLE_NAME]["question_detail"],'class'=>'add_textarea'));?></td>
    </tr>
    <tr>
        <th>表示・非表示</th>
        <td><?=$form->select('display',$display,$value[$TABLE_NAME]["display"],array('empty'=>'選択してください'));?></td>
    </tr>
    </table>
    <? if(!empty($_GET["edit"])){?>
    	<p style="padding:10px 0; text-align:center;">
		<?=$form->submit('修正する',array('div'=>false,'name'=>'edit'));?>　　<?=$form->submit('削除する',array('div'=>false,'name'=>'del'));?>
        　　<a href="./list?new_edit">新規登録する</a>
        </p>
    <? }else{?>
	    <p style="padding:10px 0; text-align:center;"><?=$form->submit('登録する',array('div'=>false,'name'=>'add'));?></p>
    <? }?>
    <?=$form->end();?>
</div>

<div class="search_box">
	<?=$form->create(array('type'=>'get','name'=>'search'));?>
    <?=$form->select('category',$category,"",array('empty'=>'カテゴリー'));?>
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
    <th>ニックネーム</th> 
    <th>質問タイトル</th>
    <th>質問内容</th>
    <th>表示・非表示</th>
    <th>回答</th>
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td><?=$val[$TABLE_NAME]["id"]?>　<a href="./list?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$category[$val[$TABLE_NAME]["category"]]?></td>
    <td><?=$val[$TABLE_NAME]["nick_name"]?></td>
    <td><?=$val[$TABLE_NAME]["question_title"]?></td>
    <td><?=$val[$TABLE_NAME]["question_detail"]?></td>
    <td><?=$display[$val[$TABLE_NAME]["display"]]?></td>
    <td>
	<?
	$answer_id = explode(",", $val[$TABLE_NAME]["answer_id"]);
	foreach($answer_id as $val){ ?>
    <a href="/admin/rc_answers/list?edit=<?=$val?>"><?=$val?></a> /
	<? } ?>
    </td>
<? $i++ ?>
</tr>
<? }?>
</table>
