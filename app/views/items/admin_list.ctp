<? $paginator->options(array('url'=>array("item_name"=>$value_item_name,"category"=>$value_category)));?>
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > 商品管理</p>
<div class="search_box">
	<?=$form->create(array('type'=>'get','name'=>'search'));?>
    <?=$form->text('item_name',array('value'=>$value_item_name));?>
    <?=$form->select('category',$Category,$value_category,array('empty'=>'カテゴリー'));?>
	<?=$form->select('reccomend',$reccomend_category,$value_reccomend,array('empty'=>'オススメ'));?>
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
    <th style="width:110px;">オススメ登録</th>
    <th>RAC番号</th> 
    <th>カテゴリー</th>
    <th>商品名</th>
    <th>販売価格</th> 
    <th>在庫</th>
    <th>画像</th>
</tr>
<? $i = 1 ?>
<? foreach($Item as $val){ ?>
<tr <?=($i%2)?"class=line":"";?>>
	<td>
	<?=$form->create(array('type'=>'post','name'=>'reccomend'));?>
    <?=$form->select('reccomend_category',$reccomend_category,$val["Item"]["reccomend"],array('empty'=>''));?>
	<?=$form->hidden('id',array('value'=>$val["Item"]["id"]));?>
	<?=$form->submit('登録',array('div'=>false));?>
    <?=$form->end();?>
    </td>
    <td><?=$val["Item"]["rac"]?></a></td>
    <td><?=$val["Item"]["category"]?></td>
    <td><?=$val["Item"]["item_name"]?></td>
    <td>\ <?=number_format($val["Item"]["sell_price"])?></td>
    <td><?=$val["Item"]["stock"]?></td>
    <? $item_url = split(' ',$val["Item"]["img_url"])?>
    <td><img src="<?=$item_url[0]?>" width="50" /></td>
<? $i++ ?>
</tr>
<? }?>
</table>
