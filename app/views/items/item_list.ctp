<?
$paginator->options(array('url'=>array("controller"=>$category,"action"=>"/")));
$this->set('title', $html->make_category_link($category,true));
$this->set('h1', "【".$html->last_category_haifun($category)."】 の商品一覧");
$this->set('keywords', $html->last_category_haifun($category));
$this->set('description', $html->last_category_haifun($category)."の商品一覧");
?>
<link rel="stylesheet" type="text/css" href="/css/item_list_detail.css" />
<h2 class="item"><?=$html->last_category_haifun($category)?></h2>
<p class="pankuzu"><a href="/">トップページ</a><?=$html->item_pankuzu($category)?></p>
<p class="paging"><?=$paginator->counter(array('format' => __('%page% / %pages% ページ,  全%count%件中%current%件, ( %start% から %end%）', true)));?></p>
<? if(count($item) != 0){?>
	<table border="0" cellspacing="0" cellpadding="0" class="item_list_sort">
	  <tr>
		<td>※画像をクリックすると商品詳細ページに移動します。</td>
		<td align="right">
		<!--
		<?=$form->create(array('type'=>'get'));?>
		<?=$form->select('sort_select',$sort_select,"",array('empty'=>'---並び替え---'));?>
		<?=$form->end();?>
		-->
		</td>
	  </tr>
	</table>
	<? foreach($item as $val){?>
	<table border="0" cellspacing="0" cellpadding="0" class="item_list_table">
	  <tr>
		<td valign="top" class="item_list_img">
		<a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>">
		<? if($val["Item"]["img_url"]){?>
		<img src="<?=$html->img_split($val["Item"]["img_url"],0)?>" width="197" class="img_border" />
		<? }else{ ?>
		<img src="/img/no_image.gif" width="197" class="img_border" />    
		<? }?>
		</a>
		</td>
		<td class="item_list_detail">
		<p class="pd_category"><span class="bg_category_cm bg_category_<?=$html->bg_category($val["Item"]["category"])?>"><?=$html->last_category($val["Item"]["category"])?></span></p>
		<p class="item_name_p"><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>"><?=$val["Item"]["item_name"]?></a></p>
		<p class="item_katch_copy"><?=$val["Item"]["pc_katch_copy"]?></p>
		<p class="btn_detail_item"><img src="/img/btn_detail.gif" width="111" /></p>
		<p class="item_price">価格　：　<span class="f18 art2"><?=number_format($val["Item"]["sell_price"])?>円</span></p>
		<form method="post" action="http://order.step.rakuten.co.jp/rms/mall/basket/vc" target="cart_window" onSubmit="window.open('', 'cart_window', 'width=900,height=600,menubar=yes,toolbar=yes,scrollbars=yes');"> 
		<input value="ES01_003_001" type="hidden" name="__event"> 
		<input value="243411" type="hidden" name="shop_bid"> 
		<input value="<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>" type="hidden" name="item_id"> 
		<input value="1" type="hidden" name="inventory_flag"> 
		<? /* if($val["Item"]["stock"] > 0){?>
		<table border="0" cellpadding="0" cellspacing="0" class="cart_box">
		  <tr>     	
			<td>       
			在庫数　：　
			<select name="units" id="units">
			<? for($i=1;$i<=$val["Item"]["stock"];$i++){ ?>
				<option value="<?=$i?>"><?=$i?>個</option>
			<? } ?>
			</select>
			</td>
			<td align="right">
			<input type="image" src="/img/btn_add_cart.gif" name="submit" /></td>
		  </tr>
		</table>
		<? }else{?>
		<table border="0" cellpadding="0" cellspacing="0" class="cart_box">
		  <tr>     	
			<td>       
			ネットショップには在庫がございません。
			</td>
			<td align="right">
			<a href="/stock_contact?id=<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>"><img src="/img/btn_stock_contact.gif" /></a>
			</td>
		  </tr>
		</table>    
		<? }*/?>
		</form>
		<div style="text-align:right; clear:both;">
			<a href="http://item.rakuten.co.jp/sportshobby/<?=$val["Item"]["item_url"]?>/" class="btn"><img src="/img/btn_add_rakuten.gif"/></a>
		</div>
		</td>
	  </tr>
	</table>

	
	<? }?>
	<div class="pagination">
		<ul>
			<li class="prev"><?=($paginator->params["paging"]["Item"]["prevPage"])?(str_replace("page:","",$paginator->prev('<<前へ'))):("");?></li>
			<?=str_replace("page:","",$paginator->numbers(array('separator' => '　','tag'=>"li")));?>
			<li class="next"><?=($paginator->params["paging"]["Item"]["nextPage"])?(str_replace("page:","",$paginator->next('次へ>>'))):("");?></li>
		</ul>
	</div>
<? }else{?>
	<p class="center f14">現在はまだ商品が登録されておりません。</p>
<? }?>