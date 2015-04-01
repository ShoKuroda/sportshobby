<?
$this->set('title', $item["Item"]["item_name"]);
$this->set('h1', $item["Item"]["item_name"]);
$this->set('keywords', $item["Item"]["item_name"]);
$this->set('description', $item["Item"]["item_name"]."の商品詳細");
?>
<style>
a.btn:hover	{
	top:1px;
	left:1px;
	position:relative;
}
</style>
<script language="javascript"> 
$(function(){
	/*質問の投稿*/
	$("#submit_question").click(function () {
		if($(".question_detail").val() == "この商品に対する疑問・質問があればぜひお書きください！\nスタッフよりご回答いたします！"){
			alert("質問の内容をお書きください。");
		}else{
			$.post('/item_questions/ajax_item_question',
				{
					item_id: "<?=$item["Item"]["rac"]?>",
					item_name: "<?=$item["Item"]["item_name"]?>",
					name: $(".question_name").val(),
					mail: $(".question_mail").val(),
					detail: $(".question_detail").val(),
				},
				function(data, status){
					// 通信成功時にデータを表示
					$("#add_question_box").fadeOut("fast");
					$("#fnish_add_question").fadeIn("fast");
				},"json"
			);
		}
	});	
});

function open_answer_box(obj){
	$("#add_answer_box_"+obj).slideDown();
}

function submit_answer(obj){
	if($("#answer_name_"+obj).val() == ""){
		alert("質問の内容をお書きください。");
	}else{
		$.post('/item_answers/ajax_item_answer',
			{
				question_id: $("#answer_question_id_"+obj).val(),
				answer_name: $("#answer_name_"+obj).val(),
				answer_detail: $("#answer_detail_"+obj).val(),
			},
			function(data, status){
				// 通信成功時にデータを表示
				$("#add_answer_box_"+obj).fadeOut("fast");
				$("#add_answer_title_"+obj).fadeOut("fast");
				$("#fnish_add_answer_"+obj).fadeIn("fast");
			},"json"
		);
	}
}

</script> 
<link rel="stylesheet" type="text/css" href="/css/item_list_detail.css" />
<h2 class="item"><?=$item["Item"]["item_name"]?></h2>
<p class="pankuzu"><a href="/">トップページ</a><?=$html->item_pankuzu($item["Item"]["category"])?>　>　商品詳細</p>
<table cellpadding="0" cellspacing="0" class="item_detail_table">
  <tr>
  	<td class="item_detail_img">
    <? if($item["Item"]["img_url"]){?>
        <img src="<?=$html->img_split($item["Item"]["img_url"],0)?>" width="397" class="img_border" />
		<? if($html->img_split($item["Item"]["img_url"],1)){?>
        <img src="<?=$html->img_split($item["Item"]["img_url"],1)?>" width="192" class="img_border froat_left" align="left" />
        <? }?>
        <? if($html->img_split($item["Item"]["img_url"],2)){?>
        <img src="<?=$html->img_split($item["Item"]["img_url"],2)?>" width="192" class="img_border float_right" align="right" />
        <? }?>
	<? }else{?>
        <img src="/img/no_image_big.gif" width="397" class="img_border" />
    <? }?>
    <img src="/img/zoom.gif" width="101" height="23" class="clear" style="padding:10px 0;" />
    </td>
    <td class="item_detail_detail" valign="top">
    <form method="post" action="http://order.step.rakuten.co.jp/rms/mall/basket/vc" target="cart_window" onSubmit="window.open('', 'cart_window', 'width=880,height=700,menubar=yes,toolbar=yes,scrollbars=yes');"> 
    <input value="ES01_003_001" type="hidden" name="__event"> 
    <input value="243411" type="hidden" name="shop_bid"> 
    <input value="<?=str_replace(RAKUTEN_SHOPID,"",$item["Item"]["rac"])?>" type="hidden" name="item_id"> 
    <input value="1" type="hidden" name="inventory_flag">
    <p class="pd_category">
    <span class="bg_category_cm bg_category_<?=$html->bg_category($item["Item"]["category"])?>"><?=$html->last_category($item["Item"]["category"])?></span>
    </p>
    <p>商品コード ： <?=$item["Item"]["item_url"]?></p>
    <p class="item_detail_name"><?=$item["Item"]["item_name"]?></p>
    <? if($item["Item"]["pc_katch_copy"]){?><p class="item_detail_katch_copy"><?=$item["Item"]["pc_katch_copy"]?></p><? }?>
    <? if($item["Item"]["disp_price"]){?>
		<p class="item_detail_disp_price">店頭価格 ： <span class="f14"><?=number_format($item["Item"]["disp_price"])?> 円</span></p>
	<? }?>
    <p class="item_detail_sell_price">販売価格 ： <span class="f16 art2"><?=number_format($item["Item"]["sell_price"])?> 円</span></p>
	<a href="http://item.rakuten.co.jp/sportshobby/<?=$item["Item"]["item_url"]?>/" class="btn"><img src="/img/btn_add_rakuten.gif"/></a>
	<? /*if($item["Item"]["stock"] > 0){?>
        個数 ： 
        <select name="units" id="units">
        <? for($i=1;$i<=$item["Item"]["stock"];$i++){ ?>
            <option value="<?=$i?>"><?=$i?>個</option>
        <? } ?>
        </select><br />
        
		<!--input type="image" src="/img/btn_add_cart.gif" name="submit" class="sp15" /-->
        <img src="/img/icon_nouki.gif" width="190" height="17" class="block" />
        </form>
    <? }else{?>
    	<a href="/stock_contact?id=<?=str_replace(RAKUTEN_SHOPID,"",$item["Item"]["rac"])?>"><img src="/img/btn_stock_contact.gif" /></a>
    <? }*/?>    
    </td>
  </tr>
</table>
<img src="/img/title_item_detail.gif" width="766" height="31" class="v_bottom" />
<p class="bg_item_detail_text"><?=nl2br($item["Item"]["pc_detail"])?></p>
<img src="/img/bottom_item_detail.gif" width="766" height="8" class="v_top" style="margin-bottom:20px;" />

<img src="/img/item_detail_question.gif" width="766" height="25" class="v_bottom" />
<div id="add_question_box">
    <table cellpadding="0" cellspacing="0" class="item_add_question">
        <tr>
        <th>お名前</th>
        <td><input type="text" name="question_name" class="question_name" /></td>
        </tr>
        <tr>
        <th>メールアドレス</th>
        <td><input type="text" name="question_mail" class="question_mail" /><p class="f10">※回答が投稿させた場合メールでお知らせいたします。</p></td>
        </tr>
        <tr>
        <th>質問内容</th>
        <td><textarea name="question_detail" class="question_detail" onfocus="if(this.value=='この商品に対する疑問・質問があればぜひお書きください！\nスタッフよりご回答いたします！') this.value = '';" onblur="if (this.value == '') this.value = 'この商品に対する疑問・質問があればぜひお書きください！\nスタッフよりご回答いたします！';">この商品に対する疑問・質問があればぜひお書きください！
スタッフよりご回答いたします！</textarea>
    <p class="f10">※質問内容によっては回答できない場合がございます。</p></td>
        </tr>
    </table>
    <div class="center sp10"><input type="submit" value="　質問を投稿する　" id="submit_question" /></div>
</div>
<div id="fnish_add_question" style="display:none;">
	<p>質問の投稿ありがとうございます！<span class="f10">※質問が承認されると下記に表示されます。</span>
    <br />メールアドレスを記入した場合、回答があるとメールでお知らせいたします。</p>
</div>

<? if($question){?>
	<h4 class="question_h4"><?=$item["Item"]["item_name"]?>の質問一覧</h4>
	<? foreach($question as $key=>$val){?>
        <dl class="question_dl" <?=($key == 0)?('style="border:none; margin-top:0px; padding-top:0px;"'):('');?>>
            <dt>質問　：　匿名<? //$val["ItemQuestion"]["question_name"]?></dt>
            <dd><?=$val["ItemQuestion"]["question_detail"]?></dd>
        </dl>
        
        <p class="add_anser" onClick="open_answer_box(<?=$val["ItemQuestion"]["id"]?>)" id="add_answer_title_<?=$val["ItemQuestion"]["id"]?>">▼▼　質問の回答をする　▼▼</p>
        <div id="add_answer_box_<?=$val["ItemQuestion"]["id"]?>" style="display:none;">
        	<input type="hidden" name="answer_question_id" id="answer_question_id_<?=$val["ItemQuestion"]["id"]?>" value="<?=$val["ItemQuestion"]["id"]?>" />
            <table cellpadding="0" cellspacing="0" class="item_add_question item_add_anser">
                <tr>
                <th>お名前</th>
                <td><input type="text" name="answer_name" class="question_name" id="answer_name_<?=$val["ItemQuestion"]["id"]?>" /></td>
                </tr>
                <tr>
                <th>回答</th>
                <td><textarea name="answer_detail" class="question_detail" id="answer_detail_<?=$val["ItemQuestion"]["id"]?>"></textarea></td>
                </tr>
            </table>
            <div class="center sp10"><input type="submit" value="　回答を投稿する　" onClick="submit_answer(<?=$val["ItemQuestion"]["id"]?>)" /></div>
        </div>
        <div id="fnish_add_answer_<?=$val["ItemQuestion"]["id"]?>" class="fnish_add_answer" style="display:none;">
            <p>質問の回答ありがとうございます！<span class="f10">※回答が承認されると下記に表示されます。</span></p>
        </div>
        
        <? foreach($answer[$val["ItemQuestion"]["id"]] as $ans_v){?>
        <div class="anser_p">
            <p><?=$ans_v["ItemAnswer"]["answer_detail"]?></p>
            <p class="anser_name">回答：<?=$ans_v["ItemAnswer"]["answer_name"]?></p>
        </div>
        <? } ?>
        
    <? }?>
<? }?>




