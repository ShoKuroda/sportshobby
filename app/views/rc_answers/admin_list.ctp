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
	
	/*キーアップされたらイベント*/
	$("#RcAnswerQuestionId").keyup(function () {
		$.post('/rc_questions/ajax_question',
		{id: $("#RcAnswerQuestionId").val()},
		function(data,status){
			if(data != null){
				$("#q_title").text(data["question_title"]);
				$("#q_detail").text(data["question_detail"]);
			}else{
				$("#q_title").text("");
				$("#q_detail").text("");
			}
		},'json'
		);
	});
	/*読み込んだ時にイベント*/
	if($("#RcAnswerQuestionId").val() > 0){
		$.post('/rc_questions/ajax_question',
		{id: $("#RcAnswerQuestionId").val()},
		function(data,status){
			if(data != null){
				$("#q_title").text(data["question_title"]);
				$("#q_detail").text(data["question_detail"]);
			}
		},'json'
		)
	};
	
});

</script> 
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > ラジコン知恵袋 - 回答</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr class="q_display">
        <th style="background:#0066CC; color:#FFFFFF; border:none; padding:5px;">質問のタイトル</th>
        <td><span id="q_title"></span></td>
    </tr>
    <tr class="q_display">
        <th style="background:#0066CC; color:#FFFFFF; border:none; padding:5px;">質問の内容</th>
        <td><span id="q_detail"></span></td>
    </tr>
    <tr>
        <th>質問ID</th>
        <td><?=$form->text('question_id',array('value'=>$value[$TABLE_NAME]["question_id"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>回答</th>
        <td><?=$form->textarea('answer_detail',array('value'=>$value[$TABLE_NAME]["answer_detail"],'class'=>'add_textarea'));?></td>
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
    <th>質問ID</th>
    <th>回答</th> 
    <th>表示・非表示</th>
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td><?=$val[$TABLE_NAME]["id"]?>　<a href="./list?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=$val[$TABLE_NAME]["question_id"]?></td>
    <td><?=$val[$TABLE_NAME]["answer_detail"]?></td>
    <td><?=$display[$val[$TABLE_NAME]["display"]]?></td>
<? $i++ ?>
</tr>
<? }?>
</table>
