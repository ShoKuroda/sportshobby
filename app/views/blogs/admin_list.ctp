<? $paginator->options(array('url'=>array("category"=>$value_category)));?>
<?=$javascript->link('ckeditor/ckeditor');?>
<?=$javascript->link('ckfinder/ckfinder');?>
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
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > ブログ管理</p>
<p style="padding:0 0 10px 0;"><a href="#" id="change_disp">[新規作成]</a></p>
<div id="disp" style="display:none;">
	<?=$form->create(array('type'=>'post','name'=>'add_info','enctype'=>'multipart/form-data'));?>
    <?=$form->hidden('id',array('value'=>$value[$TABLE_NAME]["id"]))?>
    <table id="add_table">
    <tr>
        <th>カテゴリー</th>
        <td><?=$form->select('category',$other_category,$value[$TABLE_NAME]["category"],array('empty'=>'カテゴリー'));?></td>
    </tr>
    <tr>
    
        <th>タイトル</th>
        <td><?=$form->text('title',array('value'=>$value[$TABLE_NAME]["title"],'class'=>'add_text'));?></td>
    </tr>
    <tr>
        <th>本文</th>
        <td><?=$form->textarea('detail',array('value'=>$value[$TABLE_NAME]["detail"],'id'=>'detail','class'=>'add_textarea'));?>
		<script type="text/javascript">
        //<![CDATA[
            var editor = CKEDITOR.replace( 'detail' );
			CKEDITOR.config.height = '800px';
			CKFinder.setupCKEditor( editor, '/js/ckfinder/' );
        //]]>
        </script>
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
    <?=$form->select('category',$other_category,"",array('empty'=>'カテゴリー'));?>
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
</tr>
<? $i = 1 ?>
<? foreach($Info as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
    <td><?=$val[$TABLE_NAME]["id"]?><a href="?edit=<?=$val[$TABLE_NAME]["id"]?>">[編集]</a></td>
    <td><?=($val[$TABLE_NAME]["category"])?$other_category[$val[$TABLE_NAME]["category"]]:"";?></td>
    <td><?=$val[$TABLE_NAME]["title"]?></td>
    <td><?=mb_strimwidth(htmlspecialchars($val[$TABLE_NAME]["detail"]),0,200,'...');?></td>
<? $i++ ?>
</tr>
<? }?>
</table>
