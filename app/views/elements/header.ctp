<h1><?=(isset($h1))?($h1):("ラジコンの販売・通販で25年。スポーツホビーがお客様に満足をお届けいたします！")?></h1>
<a href="/"><img src="/img/logo.gif" width="330" height="55" alt="ラジコンショップ｜スポーツホビー" id="logo" /></a>
<ul id="global_menu">
<form method="post" action="http://order.step.rakuten.co.jp/rms/mall/basket/vc" target="cart_window" onsubmit="window.open('', 'cart_window', 'width=900,height=600,menubar=yes,toolbar=yes,scrollbars=yes');"><input value="1" type="hidden" name="units" id="units"><input value="ES01_003_001" type="hidden" name="__event"><input value="243411" type="hidden" name="shop_bid"><!--
    --><li><a href="/"><img src="/img/menu1.gif" width="119" height="27" alt="トップページ" /></a></li><!--
    <? /*--><li><a href="/all_item/page1"><img src="/img/menu2.gif" width="129" height="27" alt="ラジコン一覧" /></a></li><!--*/ ?>
    --><li><a href="/rc_questions/"><img src="/img/menu3.gif" width="139" height="27" alt="ラジコン質問箱" /></a></li><!--
    --><li><a href="/other/carriage"><img src="/img/menu4.gif" width="149" height="27" alt="送料・支払い方法" /></a></li><!--
    --><li><a href="/other/company"><img src="/img/menu5.gif" width="103" height="27" alt="会社概要" /></a></li><!--
    --><li><a href="http://ameblo.jp/sportshobby/" target="_blank"><img src="/img/menu6.gif" width="140" height="27" alt="スタッフブログ" /></a></li><!--
    --><li><a href="/contact"><img src="/img/menu7.gif" width="140" height="27" alt="お問い合わせ" /></a></li><!--
    --><li><input type="image" src="/img/btn_cart.gif" name="submit" id="global_cart"></li>
</form>
</ul>
<?=$form->create('Items', array('action'=>'item_search','type'=>'get'));?>
<table id="search_pr_table" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/img/icon_search.gif" width="40" height="33" class="v_top" alt="検索" /></td>
    <td>
    <?=$form->select('search_select',select_category(),(isset($search_category))?($search_category):(null),array('empty'=>false,"id"=>"search_category","class"=>"search_select","name"=>"search_category"));?>
    <?=$form->text('search_text',array('value'=>(isset($search_text))?($search_text):(""),'id'=>'suggest','class'=>'search_text'));?>
    </td>
    <td>
    <?=$form->submit('/img/btn_search.gif')?>
    </td>
    <td class="pr_text">
    <strong>ラジコン</strong>の商品全て合わせて <span class="item_cnt">5000</span> 商品 掲載中！！
    </td>
  </tr>
</table>
<?=$form->end();?>
