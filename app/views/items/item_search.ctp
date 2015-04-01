<? $paginator->options(array('url'=>array("search_category"=>$search_category,"search_text"=>$search_text)));?>
<h2 class="item">検索結果</h2>
<p class="pankuzu"><a href="/">トップページ</a>　>　検索結果</p>
<p class="paging"><?=$paginator->counter(array('format' => __('%page% / %pages% ページ,  全%count%件中%current%件, ( %start% から %end%）', true)));?></p>
<script type="text/javascript">
$(function(){
    $(".search_item_table tr:even").addClass("even");
});
</script>
<table class="search_item_table">
	<tr>
    	<th>商品ID</th>
        <th>商品名</th>
        <th>カテゴリー</th>
        <th>定価</th>
        <th>在庫</th>
        <th>画像</th>
    </tr>
<? foreach($item as $val){?>
	<tr>
        <td><?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?></td>
        <td><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>"><?=$val["Item"]["item_name"]?></a></td>
        <td><?=$html->last_category($val["Item"]["category"])?></td>
        <td><?=$val["Item"]["sell_price"]?></td>
        <td><?=$val["Item"]["stock"]?></td>
        <td><img src="<?=$html->img_split($val["Item"]["img_url"],0)?>" height="50" /></td>
    </tr>
<? }?>
</table>

<div class="pagination">
    <ul>
        <li class="prev"><?=($paginator->params["paging"]["Item"]["prevPage"])?(str_replace("page:","",$paginator->prev('<<前へ'))):("");?></li>
        <?=str_replace("page:","",$paginator->numbers(array('separator' => '　','tag'=>"li")));?>
        <li class="next"><?=($paginator->params["paging"]["Item"]["nextPage"])?(str_replace("page:","",$paginator->next('次へ>>'))):("");?></li>
    </ul>
</div>



