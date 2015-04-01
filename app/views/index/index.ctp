<script type="text/javascript" src="/js/jquery.featureList.js"></script>
<script type="text/javascript" src="/js/main.js"></script>

<div id="feature_list">
    <ul id="output">
        <li><a href="http://www.youtube.com/channel/UCc3onIx8c_R8BcDc65yJrEA"><img src="img/main1.gif" width="555" height="285" /></a><p>スポーツホビーの動画をおとどけ！</p></li>
        <li><a href="/other/kaitori"><img src="img/main2.gif" width="555" height="285" /></a><p>中古買い取り強化してるからおいで！</p></li>
        <li><a href="/crawling/"><img src="img/main3.gif" width="555" height="285" /></a><p>クローラーがあっつあつ！！</p></li>
        <li><a href="http://www.rakuten.co.jp/sportshobby/"><img src="img/main4.gif" width="555" height="285" /></a><p>スポーツホビー楽天店</p></li>
    </ul>
    <table id="tabs" cellpadding="0" cellspacing="0">
        <tr><td id="tab1"><h2 class="feature_list">SPORTS HOBBY <br />CHANNEL</h2></td></tr>
        <tr><td id="tab2"><h2 class="feature_list">中古買い取り<br />強化中</h2></td></tr>
        <tr><td id="tab3"><h2 class="feature_list">クローラー</h2></td></tr>
        <tr><td id="tab4"><h2 class="feature_list">オンラインショップ<br />in 楽天</h2></td></tr>
    </table>
</div>

    <a href="/crawling/"><img src="img/isikiri.gif" width="380" height="150" class="float_left sp10" /></a>
    <a href="/other/anshin_rakuten"><img src="img/ansin.gif" width="380" height="150" class="float_right sp10" /></a>
    
<ul id="info">
    <li><img src="img/btn_sportshobby.gif" width="285" height="32" alt="スポーツホビーからのお知らせ" id="shk_info" style="border-bottom:#8dc70a solid 8px" /></li>
    <li><img src="img/btn_new.gif" width="156" height="32" alt="新着入荷速報" id="new_info" /></li>
    <li><img src="img/btn_used.gif" width="156" height="32" alt="イベント情報" id="used_info" /></li>
</ul>
<div id="bg_info">
    <ul class="info_title" id="shk_disp">
        <? foreach($new_info_s as $val){ ?>
        <li><span class="f10"><?=$html->df($val["NewInfo"]["created"])?></span> 
        <a href="/new_info/#<?=$val["NewInfo"]["id"]?>"><?=$val["NewInfo"]["title"]?></a> 
        <span class="f10">[<?=$val["OtherCategory"]["category_name"]?>]</span></li>
        <? }?>
    </ul>
    <ul class="info_title" id="new_disp" style="display:none;">
       <? foreach($new_item_s as $val){ ?>
        <li><span class="f10"><?=$html->df($val["Item"]["modified"])?></span> <a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>"><?=$val["Item"]["item_name"]?></a></li>
        <? }?>
    </ul>
    
    <ul class="info_title" id="used_disp" style="display:none;">
         <? foreach($used_info_s as $val){ ?>
        <li><span class="f10"><?=$html->df($val["UsedInfo"]["created"])?></span> 
        <a href="/used_info/#<?=$val["UsedInfo"]["id"]?>"><?=$val["UsedInfo"]["title"]?></a> 
        <span class="f10">[<?=$val["OtherCategory"]["category_name"]?>]</span></li>
        <? }?>
    </ul>
</div>
<img src="img/info_bottom.gif" width="766" height="15" class="v_top" />

<h3>スポーツホビーの商品カテゴリ一覧</h3>
<!--飛行機-->
<div id="air_box" class="category_box">
    <a href="/飛行機/"><img src="img/btn_air.gif" width="380" height="134" alt="手に入らない飛行機が手に入る！豊富な在庫量です！" class="v_bottom" /></a>
    <ul id="air_list" class="item_list">
    	<li class="item_list_new">飛行機の新着情報</li>
    	<? foreach($air_item_s as $val){ ?>
        	<li><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>" class="screenshot" rel="<?=$html->img_split($val["Item"]["img_url"],0)?>"><?=mb_strimwidth($val["Item"]["item_name"],0,50,"...");?></a> - <span class="f10"><?=$html->df2($val["Item"]["modified"])?></span></li>
        <? }?>
    </ul>
</div>
<!--ヘリ-->
<div id="heli_box" class="category_box category_box_right">
    <a href="/ヘリコプター/"><img src="img/btn_heli.gif" width="380" height="134" alt="初心者から上級者まで！幅広く取り揃えています！" class="v_bottom" /></a>
    <ul id="heli_list" class="item_list">
        <li class="item_list_new">ヘリコプターの新着情報</li>
        <? foreach($hili_item_s as $val){ ?>
        	<li><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>" class="screenshot" rel="<?=$html->img_split($val["Item"]["img_url"],0)?>"><?=mb_strimwidth($val["Item"]["item_name"],0,50,"...");?></a> - <span class="f10"><?=$html->df2($val["Item"]["modified"])?></span></li>
        <? }?>
    </ul>
</div>
<!--車-->
<div id="car_box" class="category_box">
    <a href="/ラジコンカー/"><img src="img/btn_car.gif" width="380" height="134" alt="必要なものがすべて揃っています！完成きっとからパーツ" class="v_bottom" /></a>
    <ul id="car_list" class="item_list">
        <li class="item_list_new">ラジコンカーの新着情報</li>
        <? foreach($car_item_s as $val){ ?>
        	<li><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>" class="screenshot" rel="<?=$html->img_split($val["Item"]["img_url"],0)?>"><?=mb_strimwidth($val["Item"]["item_name"],0,50,"...");?></a> - <span class="f10"><?=$html->df2($val["Item"]["modified"])?></span></li>
        <? }?>
    </ul>
</div>
<? /*
<!--鉄道模型-->
<div id="n_gauge_box" class="category_box category_box_right">
    <a href="#"><img src="img/btn_n.gif" width="380" height="134" alt="北海道車両がとっても豊富です！ジオラマパーツまである！" class="v_bottom" /></a>
    <ul id="n_gauge_list" class="item_list">
        <li class="item_list_new">鉄道模型(N-gauge)の新着情報</li>
        <? foreach($n_gauge_item_s as $val){ ?>
        	<li><a href="#" class="screenshot" rel="<?=$html->img_split($val["Item"]["img_url"],0)?>"><?=mb_strimwidth($val["Item"]["item_name"],0,50,"...");?></a></li>
        <? }?>
    </ul>
</div>
*/ ?>

<!--GUN-->
<div id="air_box" class="category_box category_box_right">
    <a href="/ガン/"><img src="img/btn_gun.gif" width="380" height="134" alt="電動からエアーまで、それにカスタムもできます！各種パーツがお得です" class="v_bottom" /></a>
  <ul id="gun_list" class="item_list">
        <li class="item_list_new">エアーガンの新着情報</li>
        <? foreach($gun_item_s as $val){ ?>
        	<li><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>" class="screenshot" rel="<?=$html->img_split($val["Item"]["img_url"],0)?>"><?=mb_strimwidth($val["Item"]["item_name"],0,50,"...");?></a> - <span class="f10"><?=$html->df2($val["Item"]["modified"])?></span></li>
        <? }?>
  </ul>
</div>
<!--雑貨-->
<div id="heli_box" class="category_box">
    <a href="/雑貨/"><img src="img/btn_zakka.gif" width="380" height="134" alt="手に入らない飛行機が手に入る！豊富な在庫量です！" class="v_bottom" /></a>
  <ul id="zakka_list" class="item_list">
        <li class="item_list_new">雑貨の新着情報</li>
        <? foreach($zakka_item_s as $val){ ?>
        	<li><a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>" class="screenshot" rel="<?=$html->img_split($val["Item"]["img_url"],0)?>"><?=mb_strimwidth($val["Item"]["item_name"],0,50,"...");?></a> - <span class="f10"><?=$html->df2($val["Item"]["modified"])?></span></li>
        <? }?>
  </ul>
</div>

<? if($reccomend_1 || $reccomend_2 || $reccomend_3){?>
<img src="img/recommend_top.gif" width="766" height="82" class="clear" />
<? }?>

<? if($reccomend_1){?>
	<!--店長-->
	<h4 class="top" id="recommend_h4">店長のオススメ商品はこちら</h4>
	<? foreach($reccomend_1 as $key=>$val){?>
	<? if($key % 3 == 0){?>
		<div class="recommend_box" id="osusume">
	<? }else{?>
		<div class="recommend_box left_space" id="osusume">
	<? }?>
	  <a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>">
	  <img src="<?=$html->img_split($val["Item"]["img_url"],0)?>" width="126" height="94" class="reccomend_img" alt="<?=$val["Item"]["item_name"]?>" /></a>
	  <div class="reccomend_right">
			<p class="reccomend_category"><?=$html->last_category($val["Item"]["category"])?><br /> 
			<span class="reccomend_price">\<?=$val["Item"]["sell_price"]?></span><br />
			<span class="recommend_catch"><?=$val["Item"]["pc_katch_copy"]?></span>
	  </div>
		<p class="reccomend_name"><?=$val["Item"]["item_name"]?></p>
	</div>
	<? }?>
<? }?>

<? if($reccomend_2){?>
	<!--流行り-->
	<span class="clear"></span>
	<h4 class="top" id="trend_h4">最近の流行りはこれ！！</h4>
	<? foreach($reccomend_2 as $key=>$val){?>
	<? if($key % 3 == 0){?>
		<div class="recommend_box" id="trend">
	<? }else{?>
		<div class="recommend_box left_space" id="trend">
	<? }?>
	  <a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>">
	  <img src="<?=$html->img_split($val["Item"]["img_url"],0)?>" width="126" height="94" class="reccomend_img" alt="<?=$val["Item"]["item_name"]?>" /></a>
	  <div class="reccomend_right">
			<p class="reccomend_category"><?=$html->last_category($val["Item"]["category"])?><br /> 
			<span class="reccomend_price">\<?=$val["Item"]["sell_price"]?></span><br />
			<span class="recommend_catch"><?=$val["Item"]["pc_katch_copy"]?></span>
	  </div>
		<p class="reccomend_name"><?=$val["Item"]["item_name"]?></p>
	</div>
	<? }?>
<? }?>

<? if($reccomend_3){?>
	<!--ディスカウント-->
	<span class="clear"></span>
	<h4 class="top" id="discount_h4">今だけの激安価格！</h4>
	<? foreach($reccomend_3 as $key=>$val){?>
	<? if($key % 3 == 0){?>
		<div class="recommend_box" id="discount">
	<? }else{?>
		<div class="recommend_box left_space" id="discount">
	<? }?>
	  <a href="/<?=$html->item_name_link($val["Item"]["item_name"])?>/item<?=str_replace(RAKUTEN_SHOPID,"",$val["Item"]["rac"])?>">
	  <img src="<?=$html->img_split($val["Item"]["img_url"],0)?>" width="126" height="94" class="reccomend_img" alt="<?=$val["Item"]["item_name"]?>" /></a>
	  <div class="reccomend_right">
			<p class="reccomend_category"><?=$html->last_category($val["Item"]["category"])?><br /> 
			<span class="reccomend_price">\<?=$val["Item"]["sell_price"]?></span><br />
			<span class="recommend_catch"><?=$val["Item"]["pc_katch_copy"]?></span>
	  </div>
		<p class="reccomend_name"><?=$val["Item"]["item_name"]?></p>
	</div>
	<? }?>
<? }?>
